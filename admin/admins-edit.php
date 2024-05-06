<?php include('includes/header.php');?>

<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <!-- Titre de la page avec un lien de retour -->
          <h4 class="mb-0"> Modifier l'administrateur
            <a href="admins.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>

                <form action="code.php" method="POST">
                <?php 
                    // Vérification de la présence de l'ID de l'administrateur dans les paramètres de l'URL
                    if(isset($_GET['id']))
                    {
                        if($_GET['id'] != ''){
                            $adminId = $_GET['id'];
                        }else{
                            echo'<h5>Aucun identifiant trouvé</h5>'; // Affichage d'un message d'erreur si aucun ID n'est trouvé
                            return false;
                        }
                    }else{
                        echo'<h5> Aucun ID donné dans les paramètres</h5>'; // Affichage d'un message d'erreur si aucun ID n'est présent dans les paramètres de l'URL
                        return false;
                    }
                    // Récupération des données de l'administrateur à partir de l'ID
                    $adminData = getById('admins', $adminId);
                    if($adminData){
                        if($adminData['status'] == 200)
                        {
                           ?>
                           <!-- Champ caché pour l'ID de l'administrateur -->
                           <input type="hidden" name="adminId" value="<?= $adminData['data']['id']; ?>" />
                            <div class="row">
                                <!-- Champ de saisie pour le nom de l'administrateur -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" required value="<?= $adminData['data']['name']; ?>"  class="form-control"/>
                                </div>
                                <!-- Champ de saisie pour le numéro CIN de l'administrateur -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Num CIN *</label>
                                    <input type="number" name="cin" required value="<?= $adminData['data']['cin']; ?>" class="form-control" />
                                </div>
                                <!-- Champ de saisie pour l'email de l'administrateur -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Email *</label>
                                    <input type="email" name="email" required value="<?= $adminData['data']['email']; ?>" class="form-control"/>
                                </div>
                                <!-- Champ de saisie pour le mot de passe de l'administrateur -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Mot de passe *</label>
                                    <input type="password" name="password" class="form-control" required value="<?= $adminData['data']['password']; ?>"/>
                                </div>
                                <!-- Champ de saisie pour le numéro de téléphone de l'administrateur -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Numéro de Téléphone *</label>
                                    <input type="number" name="phone" value="<?= $adminData['data']['phone'];?>" class="form-control"/>
                                </div>
                                <!-- Sélection du type de l'administrateur -->
                                <div class="col-md-4 mb-3">
                                    <label for="">Type</label>
                                    <select name="usertype" class="form-select">
                                        <option value="admin">Administrateur</option>
                                        <option value="user">Responsable</option>
                                    </select>
                                </div>
                                <!-- Case à cocher pour indiquer si l'administrateur est banni -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Is Ban *</label>
                                    <br/>
                                    <input type="checkbox" name="is_ban" value="<?= $adminData['data']['is_ban'] == true ? 'checked':'';?>" style="width:30px;height: 30px;"/>
                                </div>
                                <!-- Bouton pour soumettre le formulaire de mise à jour -->
                                <div class="col-md-12 mb-3 text-end">
                                    <button type="submit" name="updateAdmin" class="btn btn-primary">Actualiser</button>
                                </div>
                            </div>
                  <?php
                       }else{
                        echo '<h5>'.$adminData['message'].'</h5>'; // Affichage d'un message d'erreur si les données de l'administrateur ne sont pas disponibles
                       }
                    }else{
                        echo'Quelque chose s"est mal passé'; // Affichage d'un message d'erreur générique
                        return false;
                    }
                    ?>
                </form>
        </div>
     </div>
 </div>
 
<?php include('includes/footer.php');?>
