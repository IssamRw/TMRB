<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0">Ajouter Produit
            <a href="produit.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">

                  <div class="row">
                  <div class="col-md-12 mb-3">
                     <label for="">Sélectionner une catégorie *</label>
                    <select name="categorie_id" class="form-select">
                    <option value="">Sélectionner une catégorie</option>
                    <?php
                    $categorie =getAll('categorie');
                    if($categorie){
                         if(mysqli_num_rows($categorie) > 0 ){
                             foreach($categorie as $item){
                                echo'<option value="'.$item['id'].'">'.$item['namecategorie'].'</option>';
                             }
                         }else{
                             echo'<option value=""> Aucune catégorie trouvée</option>';
                         }}else{
                            echo'<option value=""> Quelque chose s"est mal passé</option>';                          

                    }
                    ?>
                    </select>
                     </div>

                     <div class="col-md-6 mb-3">
                        <label for="">Nom Produit *</label>
                          <input type="text" name="nameproduit" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Reference Produit *</label>
                          <input type="number" name="reference" required class="form-control"/>
                     </div>
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" rows="3" ></textarea>
                     </div>
                     
                     <div class="col-md-4 mb-3">
                     <label for="">Disponibilite De Produit *</label>
                     <select name="disponibilite" class="form-select">
                    <option value="">........................................................</option>
                    <option value="Besoin Achat Soustritant">Besoin Achat Soustritant</option>
                    <option value="Besoin Achat Import">Besoin Achat Import</option>
                    <option value="Besoin Achat Local">Besoin Achat Local</option>
                    </select>
                    </div>

                     <div class="col-md-4 mb-3">
                     <label for="">Prix *</label>
                          <input type="number" name="prix" required class="form-control"/>
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="">Quantite *</label>
                          <input type="number" name="quantite" required class="form-control"/>
                     </div>
                     <div class="col-md-6">
                        <label>Statut</label>
                        <br/>
                          <input type="checkbox" name="status" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="saveproduit" class="btn btn-primary">Ajouter Produit</button>
                      </div>
                  </div>

                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>