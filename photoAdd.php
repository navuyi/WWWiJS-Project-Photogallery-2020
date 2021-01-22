

<style>
	
	input{
		margin-top: -10px;
		width: 450px;
	}
	button{
		margin-top: 5px;
	}
	select{
		
		width: 450px;
		height: 30px;
	}
	.dropzone{
		text-align: center;
		background-color: #cccccc;
		border: solid black 3px;
	}
	
</style>




<div class="container" style="margin-top: 150px; margin-bottom: 150px;">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header bg-dark">
					<a><span style="color:white; font-size: 20px;">Dodaj nową kategorię</span></a>
				</div>	
				<div class="card-body bg-dark" style="text-align: center;">
					<form action="/photoAdd" method="POST" style="text-align: center;">

						<input class="form-control" type="textarea" name="category" placeholder="Dodaj nową kategorię" style="width: 100%">
						
						<button type="submit" name="addCategory" class="btn btn-light"> Dodaj </button>
					</form>

					<?php 
						//importing external php function that handles adding new categories
						//did it for esthetic reasons
						include("handleAddingCategories.inc.php")
					?>
				</div>
			</div>
			<div class="card" style="margin-top: 100px;">
				<div class="card-header bg-dark">
					<a><span style="color:white; font-size: 20px;">Dodaj zdjęcie</span></a>
				</div>
				<div class="card-body bg-dark" style="text-align: center;">
					<div class="container" style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
						<form action="/photoAdd" method="POST" enctype="multipart/form-data" style="display: inline-block;">

							<input class="form-control" type="text" name="photoName" placeholder="Nazwa pliku"><br>
							<input class="form-control" type="text" name="photoTitle" placeholder="Tytuł zdjęcia"><br>
							<input class="form-control" type="text" name="photoDesc" placeholder="Opis zdjęcia"><br>
							<select class="form-control" id='category' name='photoCategory'>
								<?php
								//importing external php file that will handle displaying scrollable category picker
								include("handleCategoryPicker.inc.php");
								?>
							</select><br>
							<!--<div class="dropzone" id="myDropzone"> </div>  -->
							<br>
							
							<input type="file"  name="file" class="dropzone" id="browse">
							
							
							<br>
							<button type="submit" name="photoAdd" class="btn btn-light"> Dodaj </button>
						</form>
					</div>
					<?php
						include('handlePhotoUpload.inc.php'); //handling file upload
					?>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
</div>

