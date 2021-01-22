<?php


if(isset($_POST['photoAdd']) and isset($_POST['photoTitle']) and isset($_POST['photoDesc'])){

	$newPhotoName = $_POST['photoName']; 	//assigning photo name provided in upload form
	if(empty($_POST['photoName']))			//if photoName is empty we will assign default name="photogallery"
	{
		$newPhotoName = "photogallery";
	}
	else{
		$newPhotoName = strtolower(str_replace(" ", "_", $newPhotoName));	//in case photo name includes blank spaces we will replace them with "_"
	}
	if(empty($_POST['photoTitle']))		//checking for input photo title if there is no input assign default value
	{
		$photoTitle = 'Default title';
	}
	else{
		$photoTitle = $_POST['photoTitle'];
	}
	if(empty($_POST['photoDesc']))		//checking for input photo description, if there is no input assign default value
	{
		$photoDesc = 'Default description';
	}
	else{
		$photoDesc = $_POST['photoDesc'];
	}

	$photoCategory = $_POST['photoCategory'];
	$category = $photoCategory;
	
	$stmt = $dbh->prepare("SELECT id FROM PH_categories WHERE category = :category");
	$stmt -> execute([':category'=>$category]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$categoryID = $row['id'];



	$file = $_FILES['file'];			//getting file array
	$photoName = $file["name"];			//getting photo name
	$photoType = $file["type"];			//getting photo type (png,jpeg,jpg,...)
	$photoTempName = $file["tmp_name"];	//getting temp (temporary file path, before uploading)
	$photoError = $file["error"];		//getting error code
	$photoSize = $file["size"];			//getting size of photo we try to upload

	$photoExtension = explode(".", $photoName); //getting photo extension .jpg, .png etc.

	$photoActualExtension = strtolower(end($photoExtension)); //getting only extension in lowercase jpg, png etc.
	

	$allowedExtensions = array("jpg", "jpeg", "png", "ico");		//array containing allowed file extensions

	if(in_array($photoActualExtension, $allowedExtensions)){		//checking if provided file has correct extension
		if($photoError === 0){										//checking for any upload errors
			if($photoSize < 300000){								//size in kB
				$photoFullName = $newPhotoName . "." . uniqid("", true). "." . $photoActualExtension;	//creating full photo name that will be unique 
				$photoDestination = 'photoUploads/' . $photoFullName;

				//handling upload informations from form to database
				if(empty($photoTitle) || empty($photoDesc)){
					exit(); //ending script if any field is empty
				}
				else{
					//actual adding data to the database
					$title = $photoTitle;
					$description = $photoDesc;
					$photoFullName = $photoFullName;
					$category = $photoCategory;
					$categoryID = $categoryID;
					$ip = $_SERVER['REMOTE_ADDR'];

					$stmt = $dbh->prepare("INSERT INTO PH_photos (title, description, photoFullName, category, ip, created, categoryID) VALUES (:title, :description, :photoFullName, :category, :ip, NOW(), :categoryID)");
					$stmt -> execute([':title'=>$title, ':description'=>$description, ':photoFullName'=>$photoFullName, ':category'=>$category, ':ip'=>$ip, ':categoryID'=>$categoryID]);

					move_uploaded_file($photoTempName, $photoDestination);
					print '<span style="color: green;">Operacja przebiegła pomyślnie.</span>';
				}
			}
			else{
				print '<span style="color: red;">Plik jest za duży.</span>';
				exit();
			}
	}
	else{
		echo "Błąd przy załączaniu pliku.";
		echo $photoError;
		exit();
	}
	
		}
		else{
		print '<span style="color: red;">Plik jest nie prawidłowy lub nie został podany.</span>';//in case user provides wrong file we print warning and exit script
		exit();																					//exiting script 
	}


}
