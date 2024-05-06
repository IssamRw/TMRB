<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
         <!-- Titre de la page avec un lien pour ajouter un nouvel administrateur -->
         <h4 class="mb-0">Administrateurs
            <a href="admins-create.php" class="btn btn-primary float-end">Ajouter un Administrateur</a>
         </h4>    
      </div>
      <div class="card-body">
         <?php alertMessage();?> <!-- Affichage des messages d'alerte -->
         <?php
            // Récupération de tous les administrateurs
            $admins = getAll('admins');
            // Vérification si la récupération des administrateurs a réussi
            if(!$admins){
               echo'<h4>Quelque chose s\'est mal passé</h4>'; // Affichage d'un message d'erreur si la récupération a échoué
               return false;
            }
            // Vérification s'il y a des administrateurs à afficher
            if(mysqli_num_rows($admins) > 0)
            {
         ?>
         <div class="table-responsive">
            <table class="table -stritableped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Nom</th>
                     <th>CIN</th>
                     <th>Numero de Telephone</th>
                     <th>Email</th>
                     <th>Type</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($admins as $adminItem): ?>
                  <tr>
                     <!-- Affichage des détails de chaque administrateur -->
                     <td><?=$adminItem['id']?></td>
                     <td><?=$adminItem['name']?></td>
                     <td><?=$adminItem['cin']?></td>
                     <td><?=$adminItem['phone']?></td>
                     <td><?=$adminItem['email']?></td>
                     <td><?=$adminItem['usertype']?></td>
                     <td>
                        <?php
                           // Affichage du statut de l'administrateur (banni ou actif)
                           if($adminItem['is_ban'] == 1){
                              echo'<span class= "badge bg-danger">Banned</span>';
                           }else{
                              echo'<span class= "badge bg-primary">Active</span>';
                           }
                           ?>
                     </td>
                     <td>
                        <!-- Liens pour modifier et supprimer chaque administrateur -->
                        <a href="admins-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-success btn-sm">Modifier</a>
                        <a href="admins-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         <?php
            }else{
            ?>
         <tr>
            <!-- Message affiché s'il n'y a aucun enregistrement trouvé -->
            <td class="mb-0"> Aucun enregistrement trouvé </td>
         </tr>
         <?php
            }
            ?>
      </div>
   </div>
</div>
<?php include('includes/footer.php');?>
