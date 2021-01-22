

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
	body{
		height: 100%;
	}
	


</style>


<div class="container" style="margin-top:150px;">
	<div class="row">
		<?php
			$stmt = $dbh->prepare("SELECT id, title, description, photoFullName FROM PH_photos");
			$stmt -> execute();
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

<!-- Footer -->
<footer class="page-footer font-small bg-dark	" id="footer">
	<div class="footer-copyright text-center py-3"><span style="color: white"> © 2020 Copyright: </span>
   		<span style="color: white">Rafał Figlus</span>
 	</div>
</footer>
<!-- Footer -->