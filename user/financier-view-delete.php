<?php
require '../configuration/function.php';
$paraRestultId= checkParamId('id');
if(is_numeric($paraRestultId))
 {
    $produitId = validate($paraRestultId);
    $financier =getById('financier', $produitId);

    if($financier['status'] == 200){

        $response = delete('financier', $produitId);

        if($response){

            redirect('financier.php','Projet supprimé avec succès');
        }else{
            redirect('financier.php','Quelque chose s"est mal passé');
        }
    }else{
    redirect('financier.php', $produit['message']);

}
 }else{
   redirect('financier.php','Quelque chose s"est mal passé');
}



?>