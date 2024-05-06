<?php
require '../configuration/function.php';
$paraRestultId= checkParamId('id');
if(is_numeric($paraRestultId))
 {
    $projetID = validate($paraRestultId);
    $projet =getById('projet',$projetID);

    if($projet['status'] == 200){

        $response = delete('projet',$projetID);

        if($response){

            redirect('projet.php','Projet supprimé avec succès');
        }else{
            redirect('projet.php','Quelque chose s"est mal passé');
        }
    }else{
    redirect('projet.php',$projet['message']);

}
 }else{
   redirect('projet.php','Quelque chose s"est mal passé');
}



?>