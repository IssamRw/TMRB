<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0">Modifier Projet
            <a href="projet.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="code.php" method="POST" >
                <?php
                  $paramValue = checkParamId('id');
                  if(!is_numeric($paramValue)){
                    echo '<h5>'.$paramValue.'</h5>';
                    return false;
                  }
                  $projet = getById('projet', $paramValue); 
                  if($projet['status'] == 200){

                    ?>
                     <input type="hidden" name="projetId" value="<?= $projet['data']['id']; ?>" />
                 <div class="row">
                  <div class="col-md-12 mb-3">
                  
                    </select>
                     </div>

                     <div class="col-md-6 mb-3">
                        <label for="">Nom *</label>
                          <input type="text" name="nameprojet" value="<?= $projet['data']['nameprojet']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Reference *</label>
                          <input type="number" name="reference" value="<?= $projet['data']['reference']; ?>" required class="form-control"/>
                     </div>
                     <div class="col-md-12 mb-3">
                     <label for="">Description *</label>
                     <textarea name="description" class="form-control" value="<?= $projet['data']['description']; ?>" rows="3" ></textarea>
                     </div>

  
                     <div class="col-md-6 mb-3">
                     <label for="">Date Début *</label>
                     <input name="datedebut" class="form-control" type="date" value="<?= $projet['data']['datedebut']; ?>"></input>
                     </div>
                     <div class="col-md-6 mb-3">
                     <label for="">Date Fin *</label>
                     <input name="datefin" class="form-control" type="date" value="<?= $projet['data']['datefin']; ?>" ></input>
                     </div>
                    
                     <div class="col-md-6">
                        <label>Statut</label>
                        <br/>
                          <input type="checkbox" name="status" value="<?= $projet['data']['status'] == true ? 'checked':'';?>" style="width:30px;height: 30px;"/>
                     </div>
                      <div class="col-md-12 mb-3 text-end">
                           <button type="submit" name="updateprojet" class="btn btn-primary">Modifier Project</button>
                      </div>
                  </div>
                    <?php
                  }else{
                    echo'<h5>'.$projet['message'].'</h5>';
                    return false; 
                }
                ?>
                
                </form>
        </div>
     </div>
 </div>
<?php include('includes/footer.php');?>

