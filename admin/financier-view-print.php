<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
          <h4 class="mb-0"> Imprimer
            <a href="financier.php" class="btn btn-danger btn-sm float-end">Retour</a>
          </h4>
          </div>
            <div class="card-body">
             <div id="myBillingArea">
             <?php 
                 if(isset($_GET['track'])){
                   $trackingNo = validate($_GET['track']);
                   if($trackingNo == ''){
                    ?>
                        <div class="text-center py-5">
                       <h5>Veuillez fournir le numéro de suivi</h5>
                      <div>
                        <a href="financier.php" class="btn btn-primary mt-4 w-25">Retourner à la section financière</a>
                      </div>
                    </div>
                 <?php
                   }
                   $financierQuery ="SELECT f.*, p.* FROM financier f , projet p WHERE p.id = f.projet_id AND tracking_no = '$trackingNo' LIMIT 1";
                   $financierQueryRes = mysqli_query($conn, $financierQuery);
                   if(!$financierQueryRes){
                    echo"<h5>Something.....</h5>";
                    return false;
                   }
                   if(mysqli_num_rows($financierQueryRes) > 0){
                    $financierDataRow = mysqli_fetch_assoc($financierQueryRes);
                   // print_r($financierDataRow) ;
                    ?>

                     <table style="width: 100%; margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" colspan="2">
                                      <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding: 0;">TM Real Buisness</h4>
                                      <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">Contact 94787806</p>
                                      <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;"> Fabriqué en Tunisie</p>
                                    </td>
                                </tr>
                                <tr>
                                  <td>
                                      <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Détail du projet</h5>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Nom De Projet:<?= $financierDataRow['nameprojet'] ?></p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Description :<?= $financierDataRow['description'] ?> </p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Reference :<?= $financierDataRow['reference'] ?> </p>
                                  </td>
                                   
                                  <td align="end">
                                      <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Détails de la facture</h5>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Numéro de facture:<?= $financierDataRow['invoice_no']; ?></p>
                                      <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Description :<?= date('d M Y'); ?> </p>
                                     
                                  </td>
                                </tr>
                            </tbody>
                        </table> 
                    <?php

                   }else{
                    echo"<h5>Aucune donnée trouvée</h5>";
                    return false;
                   }
                $financierItemQuery ="SELECT fi.quantite as financierItemQuantite, fi.prix as financierItemPrix, f.*, fi.*, p.*
                 FROM financier f, financier_items fi, produit p 
                WHERE fi.financier_id=f.id AND p.id=fi.produit_id AND f.tracking_no='$trackingNo' ";

                $financierItemQueryRes = mysqli_query($conn, $financierItemQuery);
                if($financierItemQueryRes){
                     if(mysqli_num_rows($financierItemQueryRes) > 0)
                     {
                        ?>
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
                         
                             foreach($financierItemQueryRes as $key => $row) :
                             
                        ?>
                        <tr>
                          <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['nameproduit']; ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['financierItemPrix'],0) ?></td>
                          <td style="border-bottom: 1px solid #ccc;"><?= $row['financierItemQuantite'] ?></td>
                          <td style="border-bottom: 1px solid #ccc;" class="fw-bold"><?= number_format($row['financierItemPrix'] * $row['financierItemQuantite'], 0) ?></td>
                        </tr>
                           <?php endforeach; ?>
                           <tr>

                           <td colspan="4" align="end" style="font-weight: bold;">Montant Final :</td>
                           <td colspan="1" style="font-weight: bold;"><?=number_format($row['total'], 0); ?></td>
                           </tr>
                           <tr>
                            <td colspan="5">Mode de paiement  : <?=$row['payment_mode'];?></td>
                           </tr>

                         </tbody>



                        </table>

                     </div>
                        <?php
                     }else{
                        echo'<h5>Aucune donnée trouvée</h5>';
                        return false;
                     }
                }else{
                    echo'<h5>Something went.....</h5>';
                    return false;
                }
                   
                 }else{
                  ?>
                   <div class="text-center py-5">
                       <h5>Aucun paramètre de numéro de suivi trouvé</h5>
                      <div>
                        <a href="financier.php" class="btn btn-primary mt-4 w-25">Retourner à la section financière</a>
                      </div>
                    </div>
                  <?php
                 }
             ?>
                
            </div>
            <div class="mt-4 text-end">
                <button class="btn btn-info px-4 mx-1" onclick="printMyBillingArea()">Print</button>
                <button class="btn btn-primary px-4 mx-1" onclick="downloadPDF('<?= $financierDataRow['invoice_no']; ?>')">Télècharger PDF</button>

            </div>
        </div>
      </div>
   </div>
<?php include('includes/footer.php'); ?>