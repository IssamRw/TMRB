<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0"> Modifier la catégorie
            <a href="categorie.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST">
                 
                 <?php
                 $paramValue = checkParamId('id');
                  if(!is_numeric($paramValue)){
                    echo '<h5>'.$paramValue.'</h5>';
                    return false;
                  }
                  $categorie =getById('categorie',$paramValue);
                  if($categorie['status'] == 200){

                 ?>

                 <input type="hidden" name="categorieId" value="<?= $categorie['data']['id']; ?>" />
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="">Nom *</label>
                          <input type="text" name="namecategorie" value="<?= $categorie['data']['namecategorie']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" rows="3" value="<?= $categorie['data']['description']; ?>" ></textarea>
                     </div>
  
                     <div class="col-md-6">
                        <label>Statut</label>
                        <br/>
                          <input type="checkbox" name="status" value="<?= $adminData['data']['status'] == true ? 'checked':'';?>" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="updateCategorie" class="btn btn-primary">Modifier</button>
                      </div>
                  </div>
                  <?php
                  }
                  else{
                         echo'<h5>'.$categorie['message'].'</h5>';
                  }
                  ?>
                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>