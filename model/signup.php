<?php

$username  = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$email  = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
$password  = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
$password2  = filter_input(INPUT_POST,'password2',FILTER_SANITIZE_STRING);

$is_avatar = !empty($_FILES['avatar']['name']);
if ($is_avatar){
	$tmp_avatar = $_FILES['avatar']['tmp_name'];
	$size_avatar = $_FILES['avatar']['size'];
	$name_avatar = $_FILES['avatar']['name'];
}

if ($password!=$password2){
	$message = 'Passwords are not matched.';
	include './view/signup.php';
	die();
}

if(strlen($password)<5){
	$message = 'Passwords is too short.';
	include './view/signup.php';
	die();
}

if ($is_avatar){
	$file_chunks = explode('.',$name_avatar);
	$file_ext = strtolower(end($file_chunks));
	if (!($file_ext=='jpg')){
		$message = 'file not supported. only jpg files is supported.';
		include './view/signup.php';
		die();
	}

	if ($size_avatar > 512000){
		$message = 'file is too big. maximum file size is 500 KB.';
		include './view/signup.php';
		die();
	}

	
}

$result = add_user($username,$password);
if ($result){
	if ($is_avatar){move_uploaded_file($tmp_avatar, "./view/profile-pictures/".$username.'.jpg');};
	$g=true;
	$message = 'Your account created sucsessfully.'.PHP_EOL.'Now you can sign in with your new account.';
	include 'view/login.php';
}else{
	$message = 'Error: Can not add a new account by this values';
	include './view/signup.php';
}


?>