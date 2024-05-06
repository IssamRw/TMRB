<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
          <h4 class="mb-0"> Financier
          <a href="financier-create.php" class="btn btn-primary float-end">Ajouter</a>
          </h4>
          </div>
            <div class="card-body">
              
        <?php
        $query = "SELECT f.*, p.* FROM financier f, projet p WHERE p.id = f.projet_id ORDER BY p.id DESC";
        $financier = mysqli_query($conn, $query);
        if($financier){
            if(mysqli_num_rows($financier) > 0){
                ?>
                <table class="table tablestriped table-bordered align-items-center justify-content-center">
              <thead>

              <tr>
                <th>Numéro de facture.</th>
                <th>C Nom</th>
                <th>Numero de Télephone</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Mode de paiement</th>
                <th>Action</th>
              </tr>
            </thead>
               <tbody>
                 <?php foreach($financier as $financierItem) : ?>
                    <tr>
                       <td class="fw-bold"><?= $financierItem['tracking_no']; ?></td>
                       <td><?= $financierItem['nameprojet']; ?></td>
                       <td><?= $financierItem['reference']; ?></td>
                       <td><?= date('d M, Y', strtotime($financierItem['financier_date']))?></td>
                       <td><?= $financierItem['financier_status']; ?></td>
                       <td><?= $financierItem['payment_mode']; ?></td>
                       <td>
                        <a href="financier-view.php?track=<?= $financierItem['tracking_no']; ?>" class="btn btn-info mb-0 px-2 btn-sm">Afficher</a>
                        <a href="financier-view-print.php?track=<?= $financierItem['tracking_no']; ?>" class="btn btn-primary mb-0 px-2 btn-sm">Imprimer</a>
                      <!--  <a href="financier-view-delete.php?id=
      class="btn btn-danger btn-sm"
      onclick="return confirm('Are you sure you want to delete this produit')"
      
      >Delete</a>-->
                       </td>
                    </tr>
                    <?php endforeach; ?>
               </tbody>
                </table>
                <?php

            }else{
                echo '<h5>Aucun enregistrement disponible</h5>';
            }
        }else{
            echo '<h5>Quelque chose s"est mal passé</h5>';
        }
       
       
       
       ?>


            </div>
      </div>

   </div>
<?php include('includes/footer.php'); ?>