<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0">Ajouter Projet
            <a href="projet.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST" >

                  <div class="row">

                     <div class="col-md-6 mb-3">
                        <label for="">Nom *</label>
                          <input type="text" name="nameprojet" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Reference *</label>
                          <input type="number" name="reference" required class="form-control"/>
                     </div>
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" rows="3" ></textarea>
                     </div>
                     <div class="col-md-6 mb-3">
                     <label for="">Date Début *</label>
                     <input name="datedebut" class="form-control" type="date" ></input>
                     </div>
                     <div class="col-md-6 mb-3">
                     <label for="">Date Fin *</label>
                     <input name="datefin" class="form-control" type="date" ></input>
                     </div>
                  
                     <div class="col-md-6">
                        <label>Statut</label>
                        <br/>
                          <input type="checkbox" name="status" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="saveprojet" class="btn btn-primary">Ajouter Project</button>
                      </div>
                  </div>

                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>

