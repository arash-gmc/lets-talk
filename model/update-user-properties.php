<?php 

$updating_value = filter_input(INPUT_POST,'value-to-update',FILTER_SANITIZE_STRING);
switch ($updating_value) {
	case 'username':
		$new_username = filter_input(INPUT_POST,'new-username',FILTER_SANITIZE_STRING);
		$result = update_user_info($user_id,'username',$new_username);
		if ($result){
			rename('./view/profile-pictures/'.$_SESSION['username'].'.jpg','./view/profile-pictures/'.$new_username.'.jpg');
			$_SESSION['username'] = $new_username;
		}

		break;

	case 'password':
		$current_password = filter_input(INPUT_POST,'current-password',FILTER_SANITIZE_STRING);
		$new_password = filter_input(INPUT_POST,'new-password',FILTER_SANITIZE_STRING);
		$new_password_2 = filter_input(INPUT_POST,'new-password-2',FILTER_SANITIZE_STRING);
		if($current_password!=get_password($user_id)){
			$message = 'Your password is not correct.';
			$result=false;
			break;
		}
		if ($new_password != $new_password_2){
			$message = 'Two passwords are not matched';
			$result=false;
			break;
		}
		if (strlen($new_password)<5){
			$message = 'Your password is too short.Minimum length is 5 characters.';
			$result=false;
			break;
		}
		$result = update_user_info($user_id,'password',$new_password);

		
		break;

	case 'avatar' :
		if(empty($_FILES['avatar']['name'])){
			$message = 'Plaese select a file and then click on Apply.';
			$result=false;
			break;
		}
		$new_file = $_FILES['avatar'] ;
		$file_chunks = explode('.',$new_file['name']);
		$file_ext = strtolower(end($file_chunks));
		if (!($file_ext=='jpg')){
			$message = 'file not supported. only jpg files is supported.';
			$result=false;
			break;
		}
		if ($new_file['size'] > 512000){
			$message = 'file is too big. maximum file size is 500 KB.';
			$result=false;
			break;
		}
		if (empty($new_file['tmp_name'])||$new_file['size']==0){
			$message = 'There was an error in uploading new file.';
			$result=false;
			break;
		} 
		move_uploaded_file($new_file['tmp_name'], "./view/profile-pictures/".find_username($user_id).'.jpg') ;
		$result = true ;

		break;		
	
	
}

if($result){
	$message = 'Your new changes have been modified sucsessfully.';
}else if ($message==''){
	$message = 'There was an error in appling new changes. Try with another values.';
}

include './view/navbar.php';
include './view/edit-profile.php';


?>		