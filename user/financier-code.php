<?php
include('../configuration/function.php');

if(!isset($_SESSION['produitItems'])){
    $_SESSION['produitItems'] = [];
}
if(!isset($_SESSION['produitItemId'])){
    $_SESSION['produitItemId'] = [];
}

if(isset($_POST['addItem']))
{
      $produitId = validate($_POST['produit_id']);
      $quantite = validate($_POST['quantite']);

      $checkProduit = mysqli_query($conn, "SELECT * FROM `produit` WHERE id='$produitId' LIMIT 1");
      if($checkProduit){
                
        if(mysqli_num_rows($checkProduit) > 0){
           
         $row = mysqli_fetch_assoc($checkProduit);
         if($row['quantite'] < $quantite){
            redirect('financier-create.php','Only' .$row['quantite']. 'quantite avarilable');
 
         }
         $produitData = [
            'produit_id' => $row['id'],
            'nameproduit' => $row['nameproduit'],
            'prix' => $row['prix'],
            'quantite' => $quantite,
         ];

         if(!in_array($row['id'], $_SESSION['produitItemId'])){

            array_push($_SESSION['produitItemId'], $row['id']);
            array_push($_SESSION['produitItems'], $produitData);
         }else{
               foreach($_SESSION['produitItems'] as $key => $prodSessionItem){
                if($prodSessionItem['produit_id'] == $row['id']){

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
            redirect('financier-create.php','Item added'.$row['nameproduit']);

        }else{
            redirect('financier-create.php','Aucun produit de ce type trouvé');
        }
      }else{
        redirect('financier-create.php','Quelque chose s"est mal passé');
      }
}

if(isset($_POST['produitIncDec'])){
    $produitId = validate($_POST['produit_id']);
    $quantite = validate($_POST['quantite']);

     $flag = false;
    foreach($_SESSION['produitItems'] as $key => $item){
        if($item['produit_id'] == $produitId){
           
            $flag = true;
            $_SESSION['produitItems'][$key]['quantite'] = $quantite;
        }
    }
    if($flag){

        jsonResponse(200, 'success', 'Quantité mise à jour');
    }else{
        jsonResponse(500, 'error', 'Quelque chose s"est mal passé.please refresh');
    }

}

if(isset($_POST['proceedToPlace'])){

    $reference = validate($_POST['preference']);
    $payment_mode = validate($_POST['payment_mode']);

    //checking for projet
    $checkProjet = mysqli_query($conn,"SELECT * FROM `projet` WHERE reference='$reference' LIMIT 1");
    if($checkProjet){
        if(mysqli_num_rows($checkProjet) > 0){
            $_SESSION['invoice_no'] = "INV-".rand(111111,999999);
            $_SESSION['preference'] = $reference;
            $_SESSION['payment_mode'] = $payment_mode;

            jsonResponse(200, 'Succès', 'Projet found....');
        }else{
            $_SESSION['preference'] = $reference;
            jsonResponse(404, 'error', 'projet no found....');
        }
    }else{
        jsonResponse(500, 'error', 'Quelque chose s"est mal passé');
    }
}
if(isset($_POST['saveProjetbtn'])){
    $nameprojet = validate($_POST['nameprojet']);
    $description = validate($_POST['description']);
    $reference = validate($_POST['reference']);

    if($nameprojet != '' && $reference != ''){
        $data = [
           'nameprojet' => $nameprojet,
           'description' => $description,
           'reference' => $reference,
        ];
        $result = insert('projet', $data);
        if($result){
            jsonResponse(200, 'Succès', 'Veuillez remplir les champs requis');
        }else{
            jsonResponse(500, 'error',  'Quelque chose s"est mal passé');
        }
    }else{
        jsonResponse(422, 'warning', 'Veuillez remplir les champs requis');
    }
}

if(isset($_POST['saveFinancier'])){
   $reference = validate($_SESSION['preference']);
   $invoice_no = validate($_SESSION['invoice_no']);
   $payment_mode = validate($_SESSION['payment_mode']);
   $financier_placed_by_id = $_SESSION['loggedInUser']['user_id'];

   $checkProjet = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference' LIMIT 1");
   if(!$checkProjet){
    jsonResponse(500,'error', 'Quelque chose s"est mal passé');
   }

   if(mysqli_num_rows($checkProjet) > 0){

    $projetData = mysqli_fetch_assoc($checkProjet);
  
    if(!isset($_SESSION['produitItems'])){
        jsonResponse(404,'warning', 'No Items to place');
    }
   
    $sessionProduit = $_SESSION['produitItems'];
    $total = 0;
    foreach($sessionProduit as $amtItem){
        $total += $amtItem['prix'] * $amtItem['quantite'];
    }
     
  $data = [
    'projet_id' => $projetData['id'],
    'tracking_no' => rand(11111,99999),
    'invoice_no' => $invoice_no,
    'total' => $total,
    'financier_date' => date('Y-m-d'),
    'financier_status' => 'Terminer',
    'payment_mode' => $payment_mode,
    'financier_placed_by_id' => $financier_placed_by_id
  ];
  $result = insert('financier', $data);
  $lastOrderId = mysqli_insert_id($conn);
   
  foreach($sessionProduit as $prodItem){
    $produitId = $prodItem['produit_id'];
    $prix = $prodItem['prix'];
    $quantite = $prodItem['quantite'];

    //inserting financier items
    $dataFinancierItem = [
       'financier_id' => $lastOrderId,
       'produit_id' => $produitId,
       'prix' => $prix,
       'quantite' => $quantite,
    ];
    $financierItemQuery = insert('financier_items', $dataFinancierItem);
     //checking for the books quantite and decreasing quantite and making total qte
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
}else{
    jsonResponse(404, 'werning', 'Aucun projet trouvé');
}

}

?>