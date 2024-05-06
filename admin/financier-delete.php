<?php  
  require '../configuration/function.php';

$paramResult = checkParamId('index');
if(is_numeric($paramResult)){

    $indexValue= validate($paramResult);
 
    if(isset($_SESSION['produitItems']) && isset($_SESSION['produitItemId'])){

    unset($_SESSION['produitItems'][$indexValue]);
    unset($_SESSION['produitItemId'][$indexValue]);

    redirect('financier-create.php', 'Article supprimé');

 }else{
    redirect('financier-create.php', 'Il n"y a aucun article');
 }

}else{
    redirect('financier-create.php', 'Paramètre non numérique');
}
 


?>