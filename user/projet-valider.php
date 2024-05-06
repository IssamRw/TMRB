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
   $projet = getAll('projet');
   if(!$projet){
   echo'<h4>Something Went Wrong</h4>';
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
      <th>Status</th>
      <th>Acceptation</th>
      <th>Action</th>
   </tr>
    </thead>
    <tbody>

<?php foreach($projet as $categorieitem):
      // Check if the project status is "Complet" (1)
      if($categorieitem['status'] == 1):
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
 <td>
    <!-- Toggle between "Refuser" and "Acceptation" -->
    <?php
    if($categorieitem['acceptation'] == 1){
        echo '<span class="badge bg-primary accept-reject-toggle">Accepter</span>';
    }else{
        echo '<span class="badge bg-danger accept-reject-toggle">Refuser</span>';
    }
    ?>
 </td>
   
    <td>
    <a href="projet-vd-demarche.php?id=<?= $categorieitem['id']; ?> " class="btn btn-success btn-sm">View</a>
    </td>
  </tr>
 <?php 
     endif; // End of condition for status "Complet"
   endforeach; ?>
  
    </tbody>
      </table>
     </div>
     <?php
             }else{
             ?>
              <tr>

          <td class="mb-0">Aucun enregistrement trouvé </td>
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
    // Toggle between "Refuser" and "Acceptation" and change color to green
    $(document).ready(function(){
        $('.accept-reject-toggle').click(function(){
            var $badge = $(this);
            var status = $badge.text().trim();
            if(status === "Refuser"){
            
            } else {
                $badge.removeClass("bg-primary").addClass("bg-success").text("Accepter");
            }
        });
    });
</script>
