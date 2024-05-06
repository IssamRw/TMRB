<?php include('includes/header.php');?>
  <body>


  <div class="container-fluid px-4">
   <div class="card mt-4 shadow-sm">
    <div class="card-header">
    <h4 class="mb-0"> Dossier Administratif
    <button type="button" name="add" id="add" class="btn btn-primary float-end">Ajouter</button>
    </h4>    
   </div>
    <div id="result"></div>
		
		
	</body>
     </html>

  <div id="dynamic_field_modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="add_name" action="code.php"enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Ajouter des détails</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
                     <label for="">Sélectionnez un projet *</label>
                    <select name="projet_id" class="form-select">
                    <option value="">Sélectionnez un projet</option>
                    <?php
                    $projet =getAll('projet');
                    if($projet){
                         if(mysqli_num_rows($projet) > 0 ){
                             foreach($projet as $item){
                                echo'<option value="'.$item['id'].'">'.$item['nameprojet'].'</option>';
                             }
                         }else{
                             echo'<option value=""> Aucun projet trouvé</option>';
                         }}else{
                            echo'<option value=""> Quelque chose s"est mal passé</option>';                          

                    }
                    ?>
                    </select>
                     </div>
			
					<div class="form-group">
		      			<input type="text" name="reference" id="reference" class="form-control" placeholder="Enter your Reference" />
		      		</div>
		      		<div class="table-responsive">
		      			<table class="table" id="dynamic_field">

		      			</table>
		      		</div>
				</div>
				<div class="modal-footer">
					
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
				
				</div>
				
			</form>
		</div>
	</div>

</div>


<script>
$(document).ready(function(){

	load_data();

	var count = 1;

	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#result').html(data);
			}
		})
	}

	function add_dynamic_input_field(count)
	{
		var button = '';
		if(count > 1)
		{
			button = '<button type="button" name="remove" id="'+count+'" class="btn btn-danger btn-xs remove">x</button>';
		}
		else
		{
			button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
		}
		output = '<tr id="row'+count+'">';
		output += '<td><input type="text" name="fichier_administratif[]" placeholder="Ajouter un fichier administratif" class="form-control name_list" /></td>';
		output += '<td align="center">'+button+'</td></tr>';
		$('#dynamic_field').append(output);
	}

	$('#add').click(function(){
		$('#dynamic_field').html('');
		add_dynamic_input_field(1);
		$('.modal-title').text('Ajouter Details');
		$('#action').val("insert");
		$('#submit').val('Submit');
		$('#add_name')[0].reset();
		$('#dynamic_field_modal').modal('show');
	});

	$(document).on('click', '#add_more', function(){
		count = count + 1;
		add_dynamic_input_field(count);
	});

	$(document).on('click', '.remove', function(){
		var row_id = $(this).attr("id");
		$('#row'+row_id).remove();
	});

	$('#add_name').on('submit', function(event){
		event.preventDefault();
		if($('#projet_id').val() == '')
		{
			alert("Enter Your Projet");
			return false;
		}
		var total_languages = 0;
		$('.name_list').each(function(){
			if($(this).val() != '')
			{
				total_languages = total_languages + 1;
			}
		});

		if(total_languages > 0)
		{
			var form_data = $(this).serialize();

			var action = $('#action').val();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					if(action == 'insert')
					{
						alert("Data Inserted");
					}
					if(action == 'edit')
					{
						alert("Data Edited");
					}
					add_dynamic_input_field(1);
					load_data();
					$('#add_name')[0].reset();
					$('#dynamic_field_modal').modal('hide');
				}
			});
		}
		else
		{
			alert("Veuillez entrer au moins un fichier administratif");
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr("id");
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{id:id},
			dataType:"JSON",
			success:function(data)
			{
				$('#projet_id').val(data.projet_id);
				$('#reference').val(data.reference);
				$('#dynamic_field').html(data.fichier_administratif);
				$('#action').val('edit');
				$('.modal-title').text("Modifier Details");
				$('#submit').val("Edit");
				$('#hidden_id').val(id);
				$('#dynamic_field_modal').modal('show');
			}
		});
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		if(confirm("Êtes-vous sûr de vouloir supprimer ces données ?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id:id},
				success:function(data)
				{
					load_data();
					alert("Données supprimées");
				}
			})
		}
	});

});
</script>

<?php include('includes/footer.php'); ?>