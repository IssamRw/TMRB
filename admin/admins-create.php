<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0"> Ajouter un administrateur
            <a href="admins.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST">

                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="">Nom *</label>
                          <input type="text" name="name" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Numéro de CIN *</label>
                          <input type="number" name="cin" required class="form-control" />
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                          <input type="email" name="email" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Mot de passe *</label>
                          <input type="password" name="password" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Numéro de téléphone *</label>
                          <input type="number" name="phone" required class="form-control"/>
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="">Type</label>
                     <select name="usertype" class="form-select">
                    <option value="admin">Administrateur</option>
                    <option value="user">Responsable</option>
                    </select>
                    </div>


                     <div class="col-md-6 mb-3">
                        <label for="">Is Ban *</label>
                        <br/>
                          <input type="checkbox" name="is_ban" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="saveAdmin" class="btn btn-primary">Enregistrer</button>
                      </div>
                  </div>

                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>