

<style>
	#photo{
		width:250px;
		height: 250px;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		margin-left: 25px;

	}
	#title{
		font-size: 20px;
		margin-top: 10px;
		margin-left: 25px;
		font-family: "Consolas";

	}
	#description{
		font-size: 15px;
		margin-top: 5px;
		margin-left: 25px;
		font-family: "Consolas";
	}
	h1{
		margin-top: 150px;
		font-family: "Consolas";
	}


</style>
<?php
	$id = intval($_GET['show']);
			
	$categoryID = $id;
	$stmt = $dbh->prepare("SELECT id, title, description, photoFullName,category FROM PH_photos WHERE categoryID=:categoryID");
	$stmt -> execute([':categoryID'=>$categoryID]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>




<div class="container" style="margin-top:150px; text-align: center;">
	<h1><a href="/categories"><span style="color:black; font-size: 20px;">Powrót do listy kategorii</span></a></h1>
	<br>
	<br>
	<div class="row" style="margin-top: 10px;">
		<?php
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					print'
						<div>
						<a href="/photoEdit/edit/'.$row['id'].'">
						<div style="background-image: url(photoUploads/'.$row['photoFullName'].');" id="photo"></div>
						</a>
						<h1 id="title">'.$row['title'].'</h1>
						<p id="description">'.$row['description'].'</p>
						</div>
					';
				}
		?>
	</div>
</div>