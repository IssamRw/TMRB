<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$fichier_administratif = implode(",", $_POST["fichier_administratif"]);
	$data = array(
		':projet_id'						=>	$_POST["projet_id"],
		':reference'						=>	$_POST["reference"],
		':fichier_administratif'	=>	$fichier_administratif
	);
	$query = '';
	if($_POST["action"] == "insert")
	{
		$query = "INSERT INTO tbl_name (projet_id, reference, fichier_administratif) VALUES (:projet_id, :reference, :fichier_administratif)";
	}
	if($_POST["action"] == "edit")
	{
		$query = "
		UPDATE tbl_name 
		SET projet_id = :projet_id AND reference = :reference, 
		fichier_administratif = :fichier_administratif 
		WHERE id = '".$_POST['hidden_id']."'
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute($data);
}


?>