<?php
require '../configuration/function.php';
$paraRestultId= checkParamId('id');
if(is_numeric($paraRestultId))
 {
    $produitId = validate($paraRestultId);
    $produit =getById('produit', $produitId);

    if($produit['status'] == 200){

        $response = delete('produit', $produitId);

        if($response){

            redirect('produit.php','Projet supprimé avec succès');
        }else{
            redirect('produit.php','Quelque chose s"est mal passé');
        }
    }else{
    redirect('produit.php', $produit['message']);

}
 }else{
   redirect('produit.php','Quelque chose s"est mal passé');
}



?>