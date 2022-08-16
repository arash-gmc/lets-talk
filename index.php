<?php require './model/database.php' ?>
<?php require './model/users.php' ?>
<?php require './model/posts.php' ?>
<?php require './model/comments.php' ?>


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
				$_SESSION['followings'] = $user['followings'];
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
		$posts = get_all_posts();
		include './view/timeline.php';		
		break;

	case 'following-timeline' :
		$followings = $_SESSION['followings'];
		$posts = get_selected_posts($followings);
		include './view/timeline.php';		
		break;

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

	case 'profile' :
		$profile_id  = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		$viewer_id = $_SESSION['user_id'];
		$username = find_username($profile_id);
		$posts = get_selected_posts($profile_id);
		include './view/profile.php';
		break;

	case 'following' :
		$following = $_SESSION['user_id'];
		$followed = filter_input(INPUT_GET,'followed',FILTER_SANITIZE_STRING);
		$_SESSION['followings'] = follow($following,$followed);
		header("Location: .?action=profile&profile_id=".$followed);	
		break;	

	case 'unfollowing' :
		$following = $_SESSION['user_id'];
		$followed = filter_input(INPUT_GET,'followed',FILTER_SANITIZE_STRING);
		$_SESSION['followings'] = unfollow($following,$followed);	
		header("Location: .?action=profile&profile_id=".$followed);
		break;

	case 'like' :
		$post_id = filter_input(INPUT_GET,'post',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		$user = $_SESSION['user_id'];
		like($post_id,$user);
		var_dump($profile_id);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;	

	case 'unlike' :
		$post_id = filter_input(INPUT_GET,'post',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		$user = $_SESSION['user_id'];
		unlike($post_id,$user);
		var_dump($profile_id);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;

	case 'add_comment':
		$user_id = $_SESSION['user_id'];
		$post_id = filter_input(INPUT_GET,'post_id',FILTER_SANITIZE_STRING);
		$post_text = filter_input(INPUT_GET,'post-text',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		add_comment($user_id,$post_id,$post_text);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;

	case 'test' :
		print_r($_SERVER['PHP_SELF']);
		break;						


	default:
		include './view/login.php';	
		break;
}


?>

<?php include './view/footer.php' ?>
