<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
      <div class="card-header">
          <h4 class="mb-0">Modifier Produit
            <a href="produit.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST">

                <?php
                $paramValue = checkParamId('id');
                if(!is_numeric($paramValue)){
                     echo'<h5> L"ID n"est pas un entier</h5>';
                     return false;
                }
                  $produit = getById('produit', $paramValue);
                  if($produit){
                    if($produit['status'] == 200){
                ?>
                  <input type="hidden" name="produit_id" value="<?=$produit['data']['id'];?>"/>
                  <div class="row">
                  <div class="col-md-12 mb-3">
                     <label for="">Select Categorie *</label>
                    <select name="categorie_id" class="form-select">
                    <option value="">Select Categorie</option>
                    <?php
                    $categorie =getAll('categorie');
                    if($categorie){
                         if(mysqli_num_rows($categorie) > 0 ){
                             foreach($categorie as $item){
                                ?>
                                <option value="<?= $item['id'];?>"
                                <?= $produit['data']['categorie_id'] == $item['id'] ? 'selected':''; ?>
                                >
                                <?=$item['namecategorie'];?>
                                </option>;
                            <?php
                            }
                         }else{
                             echo'<option value="">Aucune catégorie trouvée</option>';
                         }}else{
                            echo'<option value="">Quelque chose s"est mal passé</option>';                          

                    }
                    ?>
                    </select>
                     </div>

                     <div class="col-md-6 mb-3">
                        <label for="">Nom Produit *</label>
                          <input type="text" name="nameproduit" value="<?= $produit['data']['nameproduit']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Reference Produit *</label>
                          <input type="number" name="reference" value="<?= $produit['data']['reference']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" value="<?= $produit['data']['description']; ?>"  rows="3" ></textarea>
                     </div>
                     
                     <div class="col-md-4 mb-3">
                     <label for="">Disponibilite De Produit *</label>
                     <select name="disponibilite" class="form-select" value="<?= $produit['data']['disponibilite']; ?>" >
                    <option value="">........................................................</option>
                    <option value="Besoin Achat Soustritant">Besoin Achat Soustritant</option>
                    <option value="Besoin Achat Import">Besoin Achat Import</option>
                    <option value="Besoin Achat Local">Besoin Achat Local</option>
                    </select>
                    </div>

                     <div class="col-md-4 mb-3">
                     <label for="">Prix *</label>
                          <input type="number" name="prix" value="<?= $produit['data']['prix']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-4 mb-3">
                     <label for="">Quantite *</label>
                          <input type="number" name="quantite" value="<?= $produit['data']['quantite']; ?>" required class="form-control"/>
                     </div> 
                     
                     

                     <div class="col-md-6">
                        <label>Status</label>
                        <br/>
                          <input type="checkbox" name="status"  value="<?= $produit['data']['status'] == true ? 'checked':'';?>"style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="updateproduit" class="btn btn-primary">Modifier Produit</button>
                      </div>
                  </div>
                   <?php
                   }else{
                    echo'<h5>'.$produit['message'].'</h5>';
                }
              }
                else{
                    echo'<h5>Quelque chose s"est mal passé</h5>';
                    return false;

                }
                   
                   ?>

                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>