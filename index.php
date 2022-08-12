<?php require './model/database.php' ?>
<?php require './model/users.php' ?>
<?php require './model/posts.php' ?>


<?php include './view/header.php' ?>



<?php


$username  = filter_input(INPUT_GET,'username',FILTER_SANITIZE_STRING);
$password  = filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING);
$user_id  = filter_input(INPUT_GET,'user-id',FILTER_SANITIZE_STRING);
$post_text  = filter_input(INPUT_GET,'post-text',FILTER_SANITIZE_STRING);
$action  = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
if (!$action){
	$action  = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
}
$message = '';


session_start();

switch ($action) {
	case 'login':
		include './view/login.php';
		$user = login($username,$password);
		if (!$user){
			header("Location: .?action=login-failed");
		}else{
			if ($user['password']==$password){
				$_SESSION['username'] = $user['username'];
				$_SESSION['user_id'] = $user['ID'];
				header("Location: .?action=timeline");
			}else{
				header("Location: .?action=login-failed");
			}
		}
		break;

	case 'login-failed' :
		$message = 'Username or password is not correct!';
		include './view/login.php';
		break;

	case 'timeline':
		$posts = get_posts();
		include './view/timeline.php';		
		break;

	case 'post-send' :
		send_post($user_id,$post_text);
		header("Location: .?action=timeline");
		break;			

	case 'sign-up-page' :
		include './view/signup.php';


		break;

	case 'signing-up' :
		require './model/signup.php';
		break;


	default:
		include './view/login.php' ;
		break;
}


?>

<?php include './view/footer.php' ?>
