<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
    <div class="card-header">
    <h4 class="mb-0">Catégorie
    <a href="categorie-create.php" class="btn btn-primary float-end">Ajouter une catégorie</a>
    </h4>    
 </div>
    <div class="card-body">

    <?php alertMessage(); ?>
    
    <?php
   $categorie =getAll('categorie');
   if(!$categorie){
   echo'<h4>Quelque chose s"est mal passé</h4>';
   return false;
}
if(mysqli_num_rows($categorie) > 0)
{
?>
     <div class="table-responsive">
      <table class="table table-striped table-bordered" >
    <thead>
   <tr>
      <th>ID</th>
      <th>Nom </th>
      <th>Description </th>
      <th>Statut</th>
      <th>Action</th>
   </tr>
    </thead>
    <tbody>

<?php foreach($categorie as $categorieitem):

    ?>
 <tr>

    <td><?=$categorieitem['id']?></td>
    <td><?=$categorieitem['namecategorie']?></td>
    <td><?=$categorieitem['description']?></td>
    <td>
   <?php
   if($categorieitem['status'] == 1){
      echo'<span class= "badge bg-primary">Disponiple</span>';
   }else{
      echo'<span class= "badge bg-danger">Indisponible</span>';
   }
   ?>
 </td>
      
   
    <td>
    <a href="categorie-edit.php?id=<?= $categorieitem['id']; ?> " class="btn btn-success btn-sm">Modifier</a>
     <a href="categorie-delete.php?id=<?= $categorieitem['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>

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

          <td class="mb-0"> Aucun enregistrement trouvé </td>
           </tr>
          <?php
     }
    ?>
    </div>

   </div>
    </div>
</div>
<?php include('includes/footer.php');?>