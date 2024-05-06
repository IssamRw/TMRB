
<?php

//fetch.php

include('database_connection.php');

$query = "SELECT * FROM tbl_name ORDER BY id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_rows = $statement->rowCount();

$output = '
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<tr>
		<th>Id-Projet</th>
			<th>Reference</th>
			<th>Les Fichier</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
';

if($total_rows > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
		<td>'.$row["projet_id"].'</td>
			<td>'.$row["reference"].'</td>
			<td>'.$row["fichier_administratif"].'</td>
			<td><button type="button" name="edit" id="'.$row["id"].'" class="btn btn-warning btn-xs edit">Modifier</button></td>
			<td><button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Supprimer</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4">Aucune donnée trouvée</td>
	</tr>
	';
}
$output .= '</table></div>';

echo $output;

?>
