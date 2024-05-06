<?php
include('../configuration/function.php');

// Vérification et initialisation des sessions pour les produits
if (!isset($_SESSION['produitItems'])) {
    $_SESSION['produitItems'] = [];
}
if (!isset($_SESSION['produitItemId'])) {
    $_SESSION['produitItemId'] = [];
}

// Ajout d'un article au panier
if (isset($_POST['addItem'])) {
    $produitId = validate($_POST['produit_id']);
    $quantite = validate($_POST['quantite']);

    $checkProduit = mysqli_query($conn, "SELECT * FROM `produit` WHERE id='$produitId' LIMIT 1");
    if ($checkProduit) {
        if (mysqli_num_rows($checkProduit) > 0) {

            $row = mysqli_fetch_assoc($checkProduit);
            if ($row['quantite'] < $quantite) {
                redirect('financier-create.php', 'Seulement ' . $row['quantite'] . ' quantité disponible');
            }

            $produitData = [
                'produit_id' => $row['id'],
                'nameproduit' => $row['nameproduit'],
                'prix' => $row['prix'],
                'quantite' => $quantite,
            ];

            if (!in_array($row['id'], $_SESSION['produitItemId'])) {

                array_push($_SESSION['produitItemId'], $row['id']);
                array_push($_SESSION['produitItems'], $produitData);
            } else {
                foreach ($_SESSION['produitItems'] as $key => $prodSessionItem) {
                    if ($prodSessionItem['produit_id'] == $row['id']) {

                        $newQuantite = $prodSessionItem['quantite'] + $quantite;

                        $produitData = [
                            'produit_id' => $row['id'],
                            'nameproduit' => $row['nameproduit'],
                            'prix' => $row['prix'],
                            'quantite' => $newQuantite,
                        ];
                        $_SESSION['produitItems'][$key] = $produitData;
                    }
                }
            }
            redirect('financier-create.php', 'Article ajouté ' . $row['nameproduit']);
        } else {
            redirect('financier-create.php', 'Aucun tel produit trouvé');
        }
    } else {
        redirect('financier-create.php', 'Quelque chose s"est mal passé');
    }
}

// Mise à jour de la quantité d'un produit dans le panier
if (isset($_POST['produitIncDec'])) {
    $produitId = validate($_POST['produit_id']);
    $quantite = validate($_POST['quantite']);

    $flag = false;
    foreach ($_SESSION['produitItems'] as $key => $item) {
        if ($item['produit_id'] == $produitId) {
            $flag = true;
            $_SESSION['produitItems'][$key]['quantite'] = $quantite;
        }
    }
    if ($flag) {
        jsonResponse(200, 'success', 'Quantité mise à jour');
    } else {
        jsonResponse(500, 'error', 'Une erreur s"est produite. Veuillez rafraîchir la page');
    }
}

// Procéder à la création d'une commande
if (isset($_POST['proceedToPlace'])) {
    $reference = validate($_POST['preference']);
    $payment_mode = validate($_POST['payment_mode']);

    // Vérification de l'existence du projet
    $checkProjet = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference' LIMIT 1");
    if ($checkProjet) {
        if (mysqli_num_rows($checkProjet) > 0) {
            $_SESSION['invoice_no'] = "INV-" . rand(111111, 999999);
            $_SESSION['preference'] = $reference;
            $_SESSION['payment_mode'] = $payment_mode;

            jsonResponse(200, 'success', 'Projet trouvé....');
        } else {
            $_SESSION['preference'] = $reference;
            jsonResponse(404, 'error', 'Projet non trouvé....');
        }
    } else {
        jsonResponse(500, 'error', 'Quelque chose....');
    }
}

// Enregistrer un nouveau projet
if (isset($_POST['saveProjetbtn'])) {
    $nameprojet = validate($_POST['nameprojet']);
    $description = validate($_POST['description']);
    $reference = validate($_POST['reference']);

    if ($nameprojet != '' && $reference != '') {
        $data = [
            'nameprojet' => $nameprojet,
            'description' => $description,
            'reference' => $reference,
        ];
        $result = insert('projet', $data);
        if ($result) {
            jsonResponse(200, 'success', 'Veuillez remplir les champs obligatoires');
        } else {
            jsonResponse(500, 'error',  'Quelque chose s"est mal passé');
        }
    } else {
        jsonResponse(422, 'warning', 'Veuillez remplir les champs obligatoires');
    }
}

// Enregistrer le financier
if (isset($_POST['saveFinancier'])) {
    $reference = validate($_SESSION['preference']);
    $invoice_no = validate($_SESSION['invoice_no']);
    $payment_mode = validate($_SESSION['payment_mode']);
    $financier_placed_by_id = $_SESSION['loggedInUser']['user_id'];

    $checkProjet = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference' LIMIT 1");
    if (!$checkProjet) {
        jsonResponse(500, 'error', 'Quelque chose a mal tourné');
    }

    if (mysqli_num_rows($checkProjet) > 0) {

        $projetData = mysqli_fetch_assoc($checkProjet);

        if (!isset($_SESSION['produitItems'])) {
            jsonResponse(404, 'warning', 'Aucun article à placer');
        }

        $sessionProduit = $_SESSION['produitItems'];
        $total = 0;
        foreach ($sessionProduit as $amtItem) {
            $total += $amtItem['prix'] * $amtItem['quantite'];
        }

        $data = [
            'projet_id' => $projetData['id'],
            'tracking_no' => rand(11111, 99999),
            'invoice_no' => $invoice_no,
            'total' => $total,
            'financier_date' => date('Y-m-d'),
            'financier_status' => 'Terminer',
            'payment_mode' => $payment_mode,
            'financier_placed_by_id' => $financier_placed_by_id
        ];
        $result = insert('financier', $data);
        $lastOrderId = mysqli_insert_id($conn);

        foreach ($sessionProduit as $prodItem) {
            $produitId = $prodItem['produit_id'];
            $prix = $prodItem['prix'];
            $quantite = $prodItem['quantite'];

            // Insertion des articles financiers
            $dataFinancierItem = [
                'financier_id' => $lastOrderId,
                'produit_id' => $produitId,
                'prix' => $prix,
                'quantite' => $quantite,
            ];
            $financierItemQuery = insert('financier_items', $dataFinancierItem);
            // Vérification de la quantité des produits et diminution de la quantité et création du total de la quantité
            $checkProduitQuantiteQuery = mysqli_query($conn, "SELECT * FROM produit WHERE id='$produitId'");
            $produitQteData = mysqli_fetch_assoc($checkProduitQuantiteQuery);
            $totalProduitQuantite = $produitQteData['quantite'] - $quantite;

            $dataUpdate = [
                'quantite' => $totalProduitQuantite
            ];
            $updateProduitQte = update('produit', $produitId, $dataUpdate);
        }
        unset($_SESSION['produitItemId']);
        unset($_SESSION['produitItems']);
        unset($_SESSION['preference']);
        unset($_SESSION['payment_mode']);
        unset($_SESSION['invoice_no']);

        jsonResponse(200, 'success', 'Financier placé avec succès');
    } else {
        jsonResponse(404, 'werning', 'Aucun projet trouvé');
    }
}
?>
