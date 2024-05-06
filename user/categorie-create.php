<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0"> Ajouter une catégorie
            <a href="categorie.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST">

                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="">Nom de Categorie *</label>
                          <input type="text" name="namecategorie" required class="form-control"/>
                     </div>
                     
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" rows="3" ></textarea>
                     </div>
                    
                     <div class="col-md-6">
                        <label>Statut</label>
                        <br/>
                          <input type="checkbox" name="status" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="savecategorie" class="btn btn-primary">Ajouter catégorie</button>
                      </div>
                  </div>

                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>