<?php
	//handling adding new categories
	if(isset($_POST['category']) and isset($_POST['addCategory']))
	{

		try{
			$category = $_POST['category'];
			$ip = $_SERVER['REMOTE_ADDR'];

			if(mb_strlen($category) >= 1)
			{
				$stmt = $dbh->prepare("INSERT INTO PH_categories (category,ip,created) VALUES (:category, :ip, NOW())");
				$stmt -> execute([':category'=>$category, ':ip'=>$ip]);
			}
			else{
				print '<span style="color: red;">Pole nie może być puste</span>';
			}

			
		}
		catch (PDOException $e){
			if($_POST['category']=="" or $_POST['category']==" ")
			{

			}
			else
			{
				print '<span style="color: red;">Podana kategoria już istnieje</span>';
			}
			
		}
			
	}

?>		