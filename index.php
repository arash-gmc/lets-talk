<?php require './model/database.php' ?>
<?php require './model/users.php' ?>


<?php include './view/header.php' ?>



<?php

$action  = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
$username  = filter_input(INPUT_GET,'username',FILTER_SANITIZE_STRING);
$password  = filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING);
$login_message = '';



switch ($action) {
	case 'login':
		include './view/login.php';
		$user = login($username,$password);
		if (!$user){
			header("Location: .?action=login-failed");
		}else{
			if ($user['password']==$password){
				session_start();
				$_SESSION['username'] = $user['username'];
				header("Location: .?action=timeline");
			}else{
				header("Location: .?action=login-failed");
			}
		}
		break;

	case 'login-failed' :
		$login_message = 'Username or password is not correct!';
		include './view/login.php';

		break;

	case 'timeline':
		session_start();
		include './view/timeline.php';		
		break;		
	
	default:
		include './view/login.php' ;
		break;
}


?>

<?php include './view/footer.php' ?>
