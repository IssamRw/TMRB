<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <!-- Titre de la carte -->
          <h4 class="mb-0"> Ajouter une Catégorie
            <!-- Bouton de retour -->
            <a href="categorie.php" class="btn btn-danger float-end">Retour</a>
          </h4>
      </div>
      <div class="card-body">
          <!-- Affichage des messages d'alerte -->
          <?php alertMessage(); ?>
          <!-- Formulaire d'ajout de catégorie -->
          <form action="code.php" method="POST">
              <div class="row">
                  <!-- Champ pour le nom de la catégorie -->
                  <div class="col-md-6 mb-3">
                      <label for="">Nom de Catégorie *</label>
                      <input type="text" name="namecategorie" required class="form-control"/>
                  </div>
                  <!-- Champ pour la description de la catégorie -->
                  <div class="col-md-12 mb-3">
                      <label for="">Description *</label>
                      <textarea name="description" class="form-control" rows="3" ></textarea>
                  </div>
                  <!-- Champ pour le statut de la catégorie (activé/désactivé) -->
                  <div class="col-md-6">
                      <label>Statut</label>
                      <br/>
                      <input type="checkbox" name="status" style="width:30px;height: 30px;"/>
                  </div>
                  <!-- Bouton de soumission du formulaire -->
                  <div class="col-md-12 mb-3 text-end">
                      <button type="submit" name="savecategorie" class="btn btn-primary">Ajouter une catégorie</button>
                  </div>
              </div>
          </form>
      </div>
   </div>
</div>

<?php include('includes/footer.php');?>
