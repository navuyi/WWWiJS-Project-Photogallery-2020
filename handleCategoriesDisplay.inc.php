

<style>
	td{
		text-align: center;
		width: 100%;
		height: 50px;

	}
	.button{
		margin-right: 20px;
	}
	
	

</style>



<?php 
		//handle deleting  specified category
		if(isset($_GET['delete'])){
			$id = $_GET['delete'];
			$stmt = $dbh->prepare("SELECT id, ip, category FROM PH_categories WHERE id= :id");
			$stmt->execute([':id'=>$id]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			

				//Handling deleting categories from database
				if($_SERVER['REMOTE_ADDR'] == $row['ip'])
				{
					$stmt = $dbh->prepare("DELETE FROM PH_categories WHERE id=:id");
					$stmt->execute([':id'=>$id]);
				}
		}


		//Getting all categories from database and displaying them in table
		$stmt = $dbh->prepare("SELECT id, ip, category FROM PH_categories");
		$stmt -> execute();

		//displaying categories in table
		//hiding delete button for users who did not createt specified category
		//category can be deleted only by user that created that category (checking IP) 
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			
				if($_SERVER['REMOTE_ADDR']==$row['ip'])
				{
					print'
					<tr>
						<td><a href="/category/show/'.$row['id'].'"><span style="color:white;">	'.$row['category'].'	</span></a></td>
						<td><a class="button btn btn-light" href="/categories/delete/'.$row['id'].'"><span style="color:black;">Usuń</span></a></td>
					</tr>
					';
				}
				else{
					print'
					<tr>
						<td><a href="/category/show/'.$row['id'].'"><span style="color:white;">	'.$row['category'].'	</span></a></td>
						<td><a class="button btn btn-light" style="display:none;" href="/categories/delete/'.$row['id'].'"><span style="color:black; display: none">Usuń</span></a></td>
					</tr>
					';
				}
			}
			
			
									

	

	




 