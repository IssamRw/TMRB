<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
    <div class="card-header">
    <h4 class="mb-0">Produit
    <a href="produit-add.php" class="btn btn-primary float-end">Ajouter Produit</a>
    </h4>    
 </div>
    <div class="card-body">

    <?php alertMessage(); ?>
    
    <?php
   $produit =getAll('produit');
   if(!$produit){
   echo'<h4>Quelque chose s"est mal passé</h4>';
   return false;
}
if(mysqli_num_rows($produit) > 0)
{
?>
     <div class="table-responsive">
      <table class="table table-striped table-bordered" >
    <thead>
   <tr>
      <th>ID</th>
      <th>Nom </th>
      <th>Reference</th>
      <th>CategorieID</th>
      <th>Description </th>
      <th>Disponibilite </th>

      <th>Prix</th>
      <th>Statut</th>
      <th>Action</th>
   </tr>
    </thead>
    <tbody>

<?php foreach($produit as $item):

    ?>
 <tr>

    <td><?=$item['id']?></td>
    <td><?=$item['nameproduit']?></td>
    <td><?=$item['reference']?></td>
    <td><?=$item['categorie_id']?></td>
    <td><?=$item['description']?></td>
    <td><?=$item['disponibilite']?></td>
    <td><?=$item['prix']?></td>
    
    <td>
   <?php
   if($item['status'] == 1){
      echo'<span class= "badge bg-primary">Disponible</span>';
   }else{
      echo'<span class= "badge bg-danger">Indisponible</span>';
   }
   ?>
 </td>
      
   
    <td>
    <a href="produit-edit.php?id=<?= $item['id']; ?> " class="btn btn-success btn-sm">Modifier</a>
     <a href="produit-delete.php?id=<?= $item['id']; ?>"
      class="btn btn-danger btn-sm"
      onclick="return confirm('Are you sure you want to delete this produit')"
      
      >Supprimer</a>

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

          <td class="mb-0"> Aucun enregistrement trouvé</td>
           </tr>
          <?php
     }
    ?>
    </div>

   </div>
    </div>
</div>
<?php include('includes/footer.php');?>