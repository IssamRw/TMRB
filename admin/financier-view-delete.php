<?php
require '../configuration/function.php';

$paraRestultId = checkParamId('id');

if(is_numeric($paraRestultId)) {
    $financierid = validate($paraRestultId);
    $financier = getById('financier', $financierid);

    if($financier['status'] == 200){
        $response = delete('financier', $financierid);
        
        if($response){
            redirect('financier.php', 'Fichier supprimé avec succès.');
        } else {
            redirect('financier.php', 'Quelque chose s\'est mal passé lors de la suppression.');
        }
    } else {
        redirect('financier.php', $financier['message']);
    }
} else {
    redirect('financier.php', 'Quelque chose s\'est mal passé. L\'ID fourni n\'est pas valide.');
}
?>
