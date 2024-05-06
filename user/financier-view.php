<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
           <h4 class="mb-0"> Vue Financière
              <a href="financier-view-print.php?track=<?= $_GET['track'] ?>" class="btn btn-info mx-2 btn-sm float-end">Imprimer</a>
              <a href="financier.php" class="btn btn-danger mx-2 btn-sm float-end">Retour</a>
              </h4>
          </div>
            <div class="card-body">
                <?php alertMessage(); ?>
                <?php 
                 if(isset($_GET['track'])){

                    if($_GET['track'] == ''){

                        ?>
                    <div class="text-center py-5">
                       <h5>Aucun numéro de suivi trouvé</h5>
                      <div>
                        <a href="financier.php" class="btn btn-primary mt-4 w-25">Retourner à la section financière</a>
                      </div>
                    </div>
                    <?php
                        return false;
                    }
                    $trackingNo = validate($_GET['track']);

                    $query = "SELECT f.*, p.* FROM financier f, projet p WHERE p.id = f.projet_id AND tracking_no ='$trackingNo' ORDER BY p.id DESC";

                    $financier = mysqli_query($conn, $query);
                    if($financier){
                        if(mysqli_num_rows($financier) > 0){
                    $financierData = mysqli_fetch_assoc($financier);
                    $financierId = $financierData['id'];
                     ?>
                      <div class="card card-body shadow border-1 mb-4">
                        <div class="row">
                          <div class="col-md-6">
                            <h4>Financier Details</h4>
                            <label class="mb-1">
                            Numéro de suivi:
                                <span class="fw-bold"><?= $financierData['tracking_no']; ?></span>
                            </label>
                            <br/>
                            <label class="mb-1">
                                Financier Date:
                                <span class="fw-bold"><?= $financierData['financier_date']; ?></span>
                            </label>
                            <br/>
                            <label class="mb-1">
                                Financier Statut:
                                <span class="fw-bold"><?= $financierData['financier_status']; ?></span>
                            </label>
                            <br/>
                            <label class="mb-1">
                            Mode de paiement
                                <span class="fw-bold"><?= $financierData['payment_mode']; ?></span>
                            </label>
                            <br/>
                          </div>
                       <div class="col md-6">
                       <h4>Projet Details</h4>
                            <label class="mb-1">
                            Nom complet :
                                <span class="fw-bold"><?= $financierData['nameprojet']; ?></span>
                            </label>
                            <br/>
                           
                            <label class="mb-1">
                                Description:
                                <span class="fw-bold"><?= $financierData['description']; ?></span>
                            </label>
                            <br/>
                            <label class="mb-1">
                                Reference:
                                <span class="fw-bold"><?= $financierData['reference']; ?></span>
                            </label>
                            <br/>
                      </div>
                   </div>
               </div>
                 <?php 
                 $financierItemQuery = "SELECT fi.quantite as financierItemQuantite, fi.prix as financierItemPrix, f.*, fi.*, p.*
                  FROM financier as f, financier_items as fi, produit as p
                  WHERE fi.financier_id = f.id AND p.id = fi.produit_id AND f.tracking_no ='$trackingNo'";  
                  $financierItemRes = mysqli_query($conn, $financierItemQuery);
                      if($financierItemRes){
                         if(mysqli_num_rows($financierItemRes) > 0){
                          ?>
                          <h4>Financier Item Detail</h4>
                          <table class="table table-bordered table-striped">
                            <thead>
                                 <tr>
                                   <th>Produit</th>
                                   <th>Prix</th>
                                   <th>Quantite</th>
                                   <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($financierItemRes as $financierItemRow) : ?>
                                     <tr>
                                     <td style="width:40px;height:40px;" class="fw-bold text-center">
                                        <?= $financierItemRow['nameproduit']; ?>
                                       </td>
                                       <td width="15%" class="fw-bold text-center">
                                        <?= number_format($financierItemRow['financierItemPrix'],0) ?>
                                       </td>
                                       <td width="15%" class="fw-bold text-center">
                                        <?= $financierItemRow['financierItemQuantite']; ?>
                                       </td>
                                       <td width="15%" class="fw-bold text-center">
                                        <?= number_format($financierItemRow['financierItemPrix'] * $financierItemRow['financierItemQuantite'],0) ?>
                                       </td>
                                    </tr>


                                <?php endforeach; ?>
                                     <tr>
                                        <td class="text-end fw-bold">Montant Total :</td>
                                        <td colspan="3" class="text-end fw-bold">Rs: <?= number_format($financierItemRow['total'],0); ?></td>

                                     </tr>

                            </tbody>

                          </table>
                          <?php
                         }else{
                            echo'<h5>Quelque chose s"est mal passé</h5>';
                        return false;
                         }
                      }else{
                        echo'<h5>Quelque chose s"est mal passé</h5>';
                        return false;
                      }
                ?>

                     <?php
                        }else{
                            echo'<h5>Aucun enregistrement trouvé</h5>';
                            return false;
                        }
                    }else{
                        echo'<h5>Quelque chose s"est mal passé</h5>';
                    }
             }
                else{
                    ?>
                    <div class="text-center py-5">
                       <h5>Aucun numéro de suivi trouvé</h5>
                      <div>
                        <a href="financier.php" class="btn btn-primary mt-4 w-25">Retourner à la section financière</a>
                      </div>
                    </div>
                    <?php
                }

                ?>


            </div>
      </div>

   </div>
<?php include('includes/footer.php'); ?>