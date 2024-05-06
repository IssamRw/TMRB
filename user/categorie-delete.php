<?php
require '../configuration/function.php';
$paraRestultId= checkParamId('id');
if(is_numeric($paraRestultId))
 {
    $categorieId = validate($paraRestultId);
    $categorie =getById('categorie',$categorieId);

    if($categorie['status'] == 200){

        $response = delete('categorie',$categorieId);

        if($response){

            redirect('categorie.php','Projet supprimé avec succès');
        }else{
            redirect('categorie.php','Quelque chose s"est mal passé');
        }
    }else{
    redirect('categorie.php',$categorie['message']);

}
 }else{
   redirect('categorie.php','Quelque chose s"est mal passé');
}



?>