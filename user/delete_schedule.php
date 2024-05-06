<?php 
require_once('db-connect.php');
if(!isset($_GET['id'])){
    echo "<script> alert('ID de planification non défini.'); location.replace('calander.php') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `schedule_list` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('Lévénement a été supprimé avec succès.'); location.replace('calander.php') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();

?>