<?php include('includes/header.php');?>

<?php
// Détails de la connexion à la base de données
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pfe";

// Connexion à la base de données
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des fichiers téléchargés depuis la base de données
$sql = "SELECT * FROM files";
$result = $conn->query($sql);
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Fichier Nécessaire
                <a href="inde.php" class="btn btn-primary float-end">Ajouter Fichier</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom de fichier</th>
                            <th>Type de fichier</th>
                            <th>Télécharger</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Affichage des fichiers téléchargés et des liens de téléchargement
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $file_path = "uploads/" . $row['filename']; // Chemin du fichier
                                ?>
                                <tr>
                                    <td><?php echo $row['filename']; ?></td>
                                    <td><?php echo $row['filetype']; ?></td>
                                    <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Télécharger</a></td>
                                    <td><a href="delete_file.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier?')">Supprimer</a></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3">Aucun fichier n'a été téléchargé pour le moment.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Fermeture de la connexion à la base de données
$conn->close();
?>
<?php include('includes/footer.php');?>
