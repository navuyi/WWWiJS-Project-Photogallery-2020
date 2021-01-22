
<style>
	#photo{
		width:400px;
		height: 400px;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
	#title{
		font-size: 20px;
		margin-top: 10px;
		font-family: "Consolas";

	}
	#description{
		font-size: 15px;
		margin-top: 5px;
		font-family: "Consolas";
	}
	#photoDiv{
		display: inline-block;
	}
	input{
		text-align: center;
		margin-top: -5px;
	}	
	button{
		margin-top: 5px;
	}
	span{
		font-family: "Consolas";
	}

</style>

<?php
	//handling editing photo title
	if(isset($_POST['editTitle']) and isset($_POST['editPhoto']))
	{

		$id = intval($_GET['edit']);
		$title = $_POST['editTitle'];
		if(strlen($title)<=20)	//checking if given title is too long
		{
			$stmt = $dbh->prepare("UPDATE PH_photos SET title=:title WHERE id=:id");
			$stmt -> execute([':title'=>$title, ':id'=>$id]);
		}
	}
	//handling editing photo description
	if(isset($_POST['editDesc']) and isset($_POST['editPhoto']))
	{
		$id = intval($_GET['edit']);
		$description = $_POST['editDesc'];
		if(strlen($description)<=20) //checking if given description is too long
		{
			$stmt = $dbh->prepare("UPDATE PH_photos SET description=:description WHERE id=:id");
			$stmt -> execute([':description'=> $description, ':id' =>$id]);
		}
	}
	//getting informations about photo with pointed id
	$id = intval($_GET['edit']);
	$stmt = $dbh->prepare("SELECT id, title, description, photoFullName,category FROM PH_photos WHERE id=:id");
	$stmt -> execute([':id'=>$id]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<div class="container" style="margin-top: 150px; margin-bottom: 150px; text-align: center; ">
	<h1><a href="#"><span style="color:black; font-size: 20px;">Powrót do strony głównej</span></a></h1>
	<div class="row">
		<div class="col-md-2">

		</div>
		<div class="col-md-8">
			<div class="card bg-dark">
				<div class="card-header">
					<a><span style="color:white;">Edytuj zdjęcie</span></a>
				</div>
				<div class="card-body">
					<div class="container" style="text-align: center;">
					<?php
						print'
						<div class="container" style="text-align: center;" id="photoDiv">
						<a href="/photoEdit/edit/'.$row['id'].'">
						<div style="background-image: url(photoUploads/'.$row['photoFullName'].'); display: inline-block;" id="photo"></div>
						</a>
						<h1 id="title"><span style="color:white;">'.$row['title'].'</span></h1>
						<p id="description"><span style="color:white;">'.$row['description'].'</span></p>
						</div>';
						?>
					</div>

					<div style="margin-top: 15px;">
						<?php //fields for title and description are filled with already existing values 
						 print'
						<div class="container" style="text-align: center;">
							<form  method="POST" style="display: inline-block;">    
								<label for="editTitle"><span style="color:white; font-size: 20px;">Tytuł</span></label>
								<input class="form-control" style="width: 450px;" type="textarea" name="editTitle" id="editTitle" placeholder="Zmień tytuł" value="'.$row['title'].'">
								<br>


								<label for="editDesc"><span style="color:white; font-size: 20px;">Opis </span></label>
								<input class="form-control" style="width: 450px;" type="textarea" name="editDesc" id="editDesc" placeholder="Zmień opis" value="'.$row['description'].'">
								<br>
								
								<button type="submit" name="editPhoto" class="btn btn-light"> Edytuj </button><br>
							</form>
						</div>';  ?>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-md-2">

		</div>
	</div>
</div>



