<?php include('includes/header.php');?>

<div class="modal fade" id="addProjetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Projet</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Entrez le nom du projet</label>
          <input type="text" class="form-control" id="c_name" />
        </div>
     
        <div class="mb-3">
          <label>Entrez la description</label>
          <textarea id="c_description" name="description" class="form-control" rows="3" ></textarea>
        </div>

        <div class="mb-3">
          <label>Entrez la référence</label>
          <input type="text" class="form-control" id="c_reference" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary saveProjet">Enregistrer</button>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
          <h4 class="mb-0"> Créer un dossier
            <a href="financier.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="financier-code.php" method="POST">

                  <div class="row">
                     <div class="col-md-3 mb-3">
                        <label for="">Sélectionner un Produit</label>
                          <select name="produit_id" class="form-select mySelect2">
                            <option value="">--Sélectionner un Produit--</option>
                              <?php
                               $produit = getAll('produit');
                               if($produit){
                                  if(mysqli_num_rows($produit) > 0){
                                       foreach($produit as $prodItem){
                                        ?>
                                        <option value="<?= $prodItem['id']; ?>"><?= $prodItem['nameproduit']; ?></option>
                                        <?php
                                       }
                                  }else{
                                    echo'<option value="">Aucun produit trouvé</option>';
                                  }
                               }else{
                                echo'<option value="">Quelque chose s"est mal passé</option>';
                               }
                              ?>

                          </select>
                     </div>
                     
                     <div class="col-md-2 mb-3">
                     <label for="">Quantite</label>
                     <input type="number" name="quantite" value="1" class="form-control" />
                     </div>
                   
                      <div class="col-md-6 mb-3 text-end">
                        <br/>
                           <button type="submit" name="addItem" class="btn btn-primary">Ajouter un produit</button>
                      </div>
                  </div>

                </form>
        </div>
     </div>
      <div class="card mt3">
        <div class="card-header">
            <h4 class="mb-0">Produit</h4>
        </div>
        <div class="card-body" id="produitArea">
           <?php
           if(isset($_SESSION['produitItems']))
           {

            $sessionProduit = $_SESSION['produitItems'];
               if(empty($sessionProduit)){
                unset($_SESSION['produitItemId']);
                unset($_SESSION['produitItems']);
               }
              ?>
              <div class="table-responsive mb-3" id="produitContent">
                 <table class="table table-bordered table-striped">
                   <thead>
                      <tr>
                        <th>Id</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantite</th>
                        <th>Total</th>
                        <th>Supprimer</th>
                      </tr>
                   </thead>
                   <tbody>
                     <?php
                     $i = 1;
                     foreach($sessionProduit as $key => $item) : 
                        ?>
                      <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $item['nameproduit']; ?></td>
                      <td><?= $item['prix']; ?></td>
                      <td>
                        <div class="input-group qtyBox">
                            <input type="hidden" value="<?= $item['produit_id']; ?>" class="prodId" />
                           <button class="input-group-text decrement">-</button>
                           <input type="text" value="<?= $item['quantite']; ?>" class="qty quantiteInput"/>
                           <button class="input-group-text increment">+</button>
                        </div>
                      </td>
                      <td><?= number_format($item['prix'] * $item['quantite'], 0); ?></td>
                      <td>
                        <a href="financier-delete.php?index=<?= $key; ?>" class="btn btn-danger">
                        Remove
                      </a>
                      </td>
                      </tr>
                      <?php endforeach; ?>
                   </tbody>
                 </table>

              </div>
               <div class="mt-2">
                 <hr>
                  <div class="row">
                      <div class="col-md-4">
                        <label for="">Reference Projet</label>
                          <input type="number" id="preference" class="form-control" value="" />
                     </div>
                     <div class="col-md-4">
                     <label>Sélectionner le mode de paiement</label>
                          <select id="payment_mode" class="form-select">
                          <option value="">--Sélectionner le mode de paiement--</option>
                            <option value="BH">Banque de l’Habitat « BH »</option>
                            <option value="STB ">Société Tunisienne de Banque « STB »</option>
                            <option value="BNA">Banque Nationale Agricole « BNA »</option>
                            <option value="BFPME">Banque de Financement des Petites et Moyennes entreprises « BFPME »</option>
                            <option value="BTS">Banque Tunisienne de Solidarité « BTS »</option>
                            <option value="BTE">Banque de Tunisie et des Emirats « BTE »</option>
                            <option value=" BTL">Banque Tuniso-Libyenne « BTL »</option>
                            <option value="TSB">Tunisian Saudi Bank « TSB »</option>
                            <option value="Zitouna">Banque Zitouna</option>
                            <option value="Baraka">Al Baraka Bank</option>
                            <option value="International">Al Wifak International Bank</option>
                         </select>
                      </div>
                      <div class="col-md-4">
                        <br/>
                           <button  type="button" class="btn btn-warning w-100 proceedToPlace">Procéder à passer la commande</button> 
                        
                      </div>

                 </div>
               </div>
              <?php
           }else{
            echo '<h5>No item Added</h5>';
           }
           ?>

        </div>
      </div>

   </div>
<?php include('includes/footer.php'); ?>