


<?php	
	//filling select element with accessible categories
	$stmt = $dbh->prepare("SELECT id, category FROM PH_categories");
	$stmt -> execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		print'
		<option value="'.$row['category'].'">'.$row['category'].'</option>
		';
	}
?>