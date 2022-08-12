<?php 

if (isset($_POST['upload-sbm'])){

	$allowed_ext = ['png','jpg','jpeg','bmt','gif'];
	$uploaded_file = $_FILES["upload-handler"];
	print_r($_FILES);
	
	//print_r($uploaded_file);
	if (!empty($uploaded_file['name'])){
		$file_chunks = explode('.',$uploaded_file['name']);
		$file_ext = strtolower(end($file_chunks));
		if (in_array($file_ext, $allowed_ext)){		
			if ($uploaded_file['size']<2000000){

				$target_dir = 'uploads/'.$uploaded_file['name'];		
				move_uploaded_file($uploaded_file['tmp_name'], $target_dir);
				$message = "The file uplaoded sucsessfully.";
				$img_src = $target_dir;
			}else{
				$message = 'The file is too big.';
			};
		}else{
			$message = "The file's type is not supported ";
		};		
	}else{
			$message = 'Plaese upload the file frist.';
	};	
};
?>


<!DOCTYPE html>
<html>
<head>
	<title>test</title>

</head>

<body>


	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="upload-handler">
		<input type="submit" name="upload-sbm" value='upload'>
	</form>
	<h3 style="color:red">
		<?php echo $message ?? null; ?>
	</h3>

	<img src="<?php echo $img_src ?? nul; ?>" alt='' style='width: 200px;'>
</body>
</html>