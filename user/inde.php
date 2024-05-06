<?php include('includes/header.php');?>
<div class="container-fluid px-4">
   <div class="card">
      <div class="card-header">
          <h4 class="mb-0">Ajouter Fichier
            <a href="download-file.php" class="btn btn-danger float-end">Retour</a>
            </h4>
          </div>
            <div class="card-body">
            <?php alertMessage(); ?>
                <form action="upload.php" method="POST"  enctype="multipart/form-data" >

                  <div class="row">
                     <div class="col-md-12 mb-3">
					 <div class="mb-3">
				<label for="file" class="form-label">Choisir Fichier</label>
				<input type="file" class="form-control" name="file" id = "file">
			</div>
                     </div>
			<button type="submit" class="btn btn-primary">Modifier un fichier
</button>
	
	</div>
				</form>
			</div>
		</div>
	</div>
	<?php include('includes/footer.php');?>

