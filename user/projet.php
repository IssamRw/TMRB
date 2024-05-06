<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
    <div class="card-header">
    <h4 class="mb-0">Projets
    </h4>    
 </div>
    <div class="card-body">

    <?php alertMessage(); ?>
    
    <?php
   $projet =getAll('projet');
   if(!$projet){
   echo'<h4>Quelque chose s"est mal passé</h4>';
   return false;
}

if(mysqli_num_rows($projet) > 0)
{
?>
     <div class="table-responsive">
      <table class="table table-striped table-bordered" >
    <thead>
   <tr>
      <th>ID</th>
      <th>Nom </th>
      <th>Reference</th>
      <th>Description </th>
      <th>Date Début</th>
      <th>Date Fin</th>
      <th>Statut</th>
   </tr>
    </thead>
    <tbody>

<?php foreach($projet as $categorieitem):

    ?>
 <tr>

    <td><?=$categorieitem['id']?></td>
    <td><?=$categorieitem['nameprojet']?></td>
    <td><?=$categorieitem['reference']?></td>
    <td><?=$categorieitem['description']?></td>
    <td><?=$categorieitem['datedebut']?></td>
    <td><?=$categorieitem['datefin']?></td>
    <td>
   <?php
   if($categorieitem['status'] == 1){
      echo'<span class= "badge bg-primary">Complet</span>';
   }else{
      echo'<span class= "badge bg-danger">Incomplet</span>';
   }
   ?>
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

<script>
    // Vérification de la date de fin ne dépasse pas la date de début
    document.addEventListener('DOMContentLoaded', function() {
        var rows = document.querySelectorAll('table tbody tr');
        rows.forEach(function(row) {
            var debut = row.cells[4].textContent;
            var fin = row.cells[5].textContent;
            if (Date.parse(fin) < Date.parse(debut)) {
                row.style.backgroundColor = '#ffcccc'; // Mettre en évidence les lignes avec des dates invalides
                alert('La date de fin ne peut pas être antérieure à la date de début pour le projet: ' + row.cells[1].textContent);
            }
        });
    });
</script>