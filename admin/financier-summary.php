<?php  

include('includes/header.php');

// Vérifie si aucun produit n'a été ajouté à la session, redirige vers la page pour créer un dossier financier
if(!isset($_SESSION['produitItems'])){
     echo'<script> window.location.href = "financier-create.php"; </script>';
}

?>

<!-- Modal de succès pour le dossier financier -->
<div class="modal fade" id="financierSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body">
        <!-- Message de succès -->
        <div class="mb-3">
          <h5 id="financierPlaceSuccessMessage"></h5>
        </div>
        <!-- Boutons pour fermer, imprimer et télécharger le PDF -->
        <a href="financier.php" class="btn btn-secondary">Fermer</a>
        <button type="button"  onclick="printMyBillingArea()" class="btn btn-danger Print">Imprimer</button>
        <button type="button" onclick="downloadPDF('<?= $_SESSION['invoice_no']; ?>')" class="btn btn-danger Print">Télécharger PDF</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
   <div class="row">
     <div class="col-md-12">
       <div class="card mt-4">
          <div class="card-header">
             <h4 class="mb-0">Financier Dossier
                <!-- Bouton pour retourner à la création d'un dossier financier -->
                <a href="financier-create.php" class="btn btn-danger float-end">Retour pour créer</a>
            </h4>
          </div>
          <div class="card-body">
            <?php alertMessage(); ?>

            <div id="myBillingArea">
                <?php
                // Vérifie si une référence de projet est définie dans la session
                if(isset($_SESSION['preference'])){
                    $reference = validate($_SESSION['preference']);
                    $invoiceNo = validate($_SESSION['invoice_no']);
                    $projetQuery = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference ='$reference' LIMIT 1");

                    if($projetQuery){
                        if(mysqli_num_rows($projetQuery) > 0){
                            $cRowData = mysqli_fetch_assoc($projetQuery);
                            ?>
                            <!-- Affichage des détails du projet et de la facture -->
                            <table style="width: 100%; margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" colspan="2">
                                      <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding: 0;">TM Real Buisness</h4>
                                      <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">Contact 94787806</p>
                                      <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">Fabriqué en Tunisie</p>
                                    </td>
                                </tr>
                                <tr>
                                  <td>
                                      <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Détails du projet</h5>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Nom De Projet:<?= $cRowData['nameprojet'] ?></p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Description :<?= $cRowData['description'] ?> </p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Reference :<?= $cRowData['reference'] ?> </p>
                                  </td>
                                   
                                  <td align="end">
                                      <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Détails de la facture</h5>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Numéro de facture:<?= $invoiceNo; ?></p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Description :<?= date('d M Y'); ?> </p>
                                     
                                  </td>
                                </tr>
                            </tbody>
                        </table> 
                            <?php
                        }else{
                            echo "<h5>Aucun projet trouvé</h5>";
                            return;
                        }
                    }
                }
                ?>

                <?php
                  // Vérifie si des produits ont été ajoutés à la session
                  if(isset($_SESSION['produitItems'])){
                    $sessionProduit = $_SESSION['produitItems'];
                    ?>
                     <!-- Tableau des produits -->
                     <div class="table-responsive mb-3">
                        <table style="width: 100%;" cellpadding="5">
                          <thead>
                             <tr>
                               <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">Id</th>
                               <th align="start" style="border-bottom: 1px solid #ccc;">Produit</th>
                               <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Prix</th>
                               <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantite</th>
                               <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total</th>
                             </tr>
                         </thead>
                          <tbody>
                        <?php
                             $i = 1;
                             $total = 0;
                             foreach($sessionProduit as $key => $row) :
                                $total += $row['prix'] * $row['quantite']
                        ?>
                        <tr>
                          <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['nameproduit']; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['prix'],0) ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['quantite'] ?></td>
                          <td style="border-bottom: 1px solid #ccc;" class="fw-bold"><?= number_format($row['prix'] * $row['quantite'], 0) ?></td>
                        </tr>
                           <?php endforeach; ?>
                           <!-- Total -->
                           <tr>
                            <td colspan="4" align="end" style="font-weight: bold;">Montant Final :</td>
                            <td colspan="1" style="font-weight: bold;"><?=number_format($total, 0); ?></td>
                           </tr>
                           <!-- Mode de paiement -->
                           <tr>
                            <td colspan="5">Mode de paiement : <?=$_SESSION['payment_mode'];?></td>
                           </tr>

                         </tbody>
                        </table>

                     </div>
                    <?php
                  }else{
                    // Aucun article ajouté
                    echo '<h5 class="text-center">Aucun article ajouté</h5>';
                  }
                   ?>

            </div>
            <!-- Boutons pour enregistrer, imprimer et télécharger le PDF -->
            <?php if(isset($_SESSION['produitItems'])) : ?>
              <div class="mt-4 text-end">
                <button type="button" class="btn btn-primary px-4 mx-1" id="saveFinancier">Enregistrer</button>
                <button class="btn btn-info px-4 mx-1" onclick="printMyBillingArea()">Imprimer</button>
                <button class="btn btn-warning px-4 mx-1" onclick="downloadPDF('<?= $_SESSION['invoice_no']; ?>')">Télécharger PDF</button>
              </div>
              <?php endif; ?>
          </div>
       </div>
     </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>
