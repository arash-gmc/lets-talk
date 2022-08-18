<?php require './model/database.php' ?>
<?php require './model/users.php' ?>
<?php require './model/posts.php' ?>
<?php require './model/comments.php' ?>
<?php require './model/notifications.php' ?>
<?php require './model/messages.php' ?>

<?php include './view/header.php' ?>

<?php

$action  = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
if (!$action){
	$action  = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
}
$message = '';

session_start();

if (isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
}else{
	if($action!='login' and $action!='login-failed' and $action!='sign-up-page' and $action !='signing-up'){
		include 'view/login.php';
		die();
	}	
}

switch ($action) {
	case 'login':
		$username  = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
		$password  = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
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

	case 'sign-up-page' :
		include './view/signup.php';
		break;

	case 'signing-up' :
		require './model/signup.php';
		break;	

	case 'timeline':
		$posts = get_all_posts();
		include './view/navbar.php';
		include './view/timeline.php';		
		break;

	case 'following-timeline' :
		$followings = $_SESSION['followings'];
		$posts = get_selected_posts($followings);
		include './view/timeline.php';		
		break;

		break;	

	case 'post-send' :
		$post_text  = filter_input(INPUT_POST,'post-text',FILTER_SANITIZE_STRING);
		send_post($user_id,$post_text);
		header("Location: .?action=timeline");
		break;			

	case 'profile' :
		$profile_id  = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		$username = find_username($profile_id);
		$posts = get_selected_posts($profile_id);
		$unseen_notification = count_unseen_notification($user_id);
		$unseen_messages = check_all_unseen_messages($user_id);
		include './view/navbar.php';
		include './view/profile.php';
		break;

	case 'following' :
		$followed = filter_input(INPUT_GET,'followed',FILTER_SANITIZE_STRING);
		$_SESSION['followings'] = follow($user_id,$followed);
		$notification_text = find_username($user_id).' strated to follow you.';
		make_notification($user_id,$followed,$notification_text);
		header("Location: .?action=profile&profile_id=".$followed);	
		break;	

	case 'unfollowing' :
		$followed = filter_input(INPUT_GET,'followed',FILTER_SANITIZE_STRING);
		$_SESSION['followings'] = unfollow($user_id,$followed);	
		header("Location: .?action=profile&profile_id=".$followed);
		break;

	case 'like' :
		$post_id = filter_input(INPUT_GET,'post',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		like($post_id,$user_id);
		$post_author = find_post_author($post_id);
		$notification_text = $_SESSION['username'].' liked your <a href="#">post</a>';
		make_notification($user_id,$post_author,$notification_text);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;	

	case 'unlike' :
		$post_id = filter_input(INPUT_GET,'post',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		unlike($post_id,$user_id);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;

	case 'add_comment':
		$post_id = filter_input(INPUT_GET,'post_id',FILTER_SANITIZE_STRING);
		$post_text = filter_input(INPUT_GET,'post-text',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		add_comment($user_id,$post_id,$post_text);
		$notification_text = $_SESSION['username'].' add a comment bellow your <a href="#">post</a>'; 
		make_notification($user_id,find_post_author($post_id),$notification_text);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;

	case 'notifications' :
		$notifications = get_notifications($user_id);
		make_notifications_seen($user_id);
		include 'view/notifications.php';
		break;

	case 'chat-page' :
		$contact = filter_input(INPUT_GET,'contact',FILTER_SANITIZE_STRING);
		$messages = get_messages($user_id,$contact);
		make_seen_messages($user_id,$contact);
		include 'view/direct-message.php';
		break;

	case 'add-message' :
		$contact = filter_input(INPUT_GET,'receiver',FILTER_SANITIZE_STRING);
		$text = filter_input(INPUT_GET,'new_message',FILTER_SANITIZE_STRING);
		send_message($user_id,$contact,$text);
		$messages = get_messages($user_id,$contact);
		header("Location: .?action=chat-page&contact=".$contact."#message1");
		break;

	case 'inbox' :
		$contacts = get_contacts($user_id) ;
		include './view/massages-box.php' ;
		break;

	case 'logout' :
		unset($_SESSION['username']);
		unset($_SESSION['user_id']);
		unset($_SESSION['followings']);
		include './view/login.php';


		break;										


	default:
		if (isset($_SESSION['user_id'])){
			header("Location: .?action=timeline");
		}else{
			include './view/login.php';
		}
		break;
}


?>

<?php include './view/footer.php' ?>
