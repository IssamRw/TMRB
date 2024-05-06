<?php include('includes/header.php');?>
<?php
//database connection details

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pfe";

 $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


 if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

 //Fetch the uploaded files from the database

 $sql = "SELECT *FROM files";
 $result = $conn->query($sql);

?>
<div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
    <div class="card-header">
    <h4 class="mb-0">Fichier Necessaire
    <a href="inde.php" class="btn btn-primary float-end">Ajouter Fichier</a>
    </h4>    
 </div>
    <div class="card-body">
    <?php alertMessage(); ?>
<div class="table-responsive">
      <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>Nom du fichier</th>
                    <th>Type de fichier</th>
                    <th>Télécharger</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display the uploaded files and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                        ?>
                        <tr> 
                            <td><?php echo $row['filename']; ?></td>
                            <td><?php echo $row['filetype']; ?></td>
                            <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Télécharger</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">Aucun fichier téléchargé pour le moment</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
  
    </div></div></div>
    
<?php
$conn->close();
?>
<?php include('includes/footer.php');?>