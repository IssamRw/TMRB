<?php

//select.php

include('database_connection.php');

if(isset($_POST["id"]))
{
	$query = "SELECT * FROM tbl_name WHERE id='".$_POST["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$fichier_administratif = '';
	$reference = '';
	$projet_id = '';
	foreach($result as $row)
	{
		$projet_id = $row["projet_id"];
		$reference = $row["reference"];
		$language_array = explode(",", $row["fichier_administratif"]);
		$count = 1;
		foreach($language_array as $language)
		{
			$button = '';
			if($count > 1)
			{
				$button = '<button type="button" name="remove" id="'.$count.'" class="btn btn-danger btn-xs remove">x</button>';
			}
			else
			{
				$button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
			}
			$fichier_administratif .= '
				<tr id="row'.$count.'">
					<td><input type="text" name="fichier_administratif[]" placeholder="Add fichier_administratif" class="form-control name_list" value="'.$language.'" /></td>
					<td align="center">'.$button.'</td>
				</tr>
			';
			$count++;
		}
	}
	$output = array(
		'projet_id'					=>	$projet_id,
		'reference'					=>	$reference,
		'fichier_administratif'	=>	$fichier_administratif
	);
	echo json_encode($output);
}


?>