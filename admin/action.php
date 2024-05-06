<?php

// Inclusion du fichier de connexion à la base de données
include('database_connection.php');

// Vérification si une action est définie dans les données POST
if(isset($_POST["action"]))
{
	// Conversion du tableau des fichiers administratifs en une chaîne séparée par des virgules
	$fichier_administratif = implode(",", $_POST["fichier_administratif"]);

	// Création d'un tableau de données à insérer ou à mettre à jour dans la base de données
	$data = array(
		':projet_id' => $_POST["projet_id"],
		':reference' => $_POST["reference"],
		':fichier_administratif' => $fichier_administratif
	);

	$query = ''; // Initialisation de la requête SQL

	// Condition pour déterminer l'action à effectuer (insertion ou modification)
	if($_POST["action"] == "insert")
	{
		// Requête SQL pour l'insertion des données dans la table
		$query = "INSERT INTO tbl_name (projet_id, reference, fichier_administratif) VALUES (:projet_id, :reference, :fichier_administratif)";
	}

	if($_POST["action"] == "edit")
	{
		// Requête SQL pour la mise à jour des données dans la table
		$query = "
		UPDATE tbl_name 
		SET projet_id = :projet_id AND reference = :reference, 
		fichier_administratif = :fichier_administratif 
		WHERE id = '".$_POST['hidden_id']."'
		";
	}

	// Préparation de la requête SQL
	$statement = $connect->prepare($query);

	// Exécution de la requête SQL avec les données fournies
	$statement->execute($data);
}

?>
