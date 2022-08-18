<?php require './model/database.php' ?>
<?php require './model/users.php' ?>
<?php require './model/posts.php' ?>
<?php require './model/comments.php' ?>
<?php require './model/notifications.php' ?>
<?php require './model/messages.php' ?>


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


$viewer_id = $_SESSION['user_id'];
$unseen_notification = count_unseen_notification($viewer_id);
$unseen_messages = check_all_unseen_messages($viewer_id);

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
		$unseen_notification = count_unseen_notification($viewer_id);
		$unseen_messages = check_all_unseen_messages($viewer_id);
		include './view/navbar.php';
		include './view/profile.php';
		break;

	case 'following' :
		$following = $_SESSION['user_id'];
		$followed = filter_input(INPUT_GET,'followed',FILTER_SANITIZE_STRING);
		$_SESSION['followings'] = follow($following,$followed);
		$notification_text = find_username($following).' strated to follow you.';
		make_notification($following,$followed,$notification_text);
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
		$post_author = find_post_author($post_id);
		$notification_text = $_SESSION['username'].' liked your <a href="#">post</a>';
		make_notification($_SESSION['user_id'],$post_author,$notification_text);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;	

	case 'unlike' :
		$post_id = filter_input(INPUT_GET,'post',FILTER_SANITIZE_STRING);
		$last_page = filter_input(INPUT_GET,'lastpage',FILTER_SANITIZE_STRING);
		$profile_id = filter_input(INPUT_GET,'profile_id',FILTER_SANITIZE_STRING);
		$user = $_SESSION['user_id'];
		unlike($post_id,$user);
		header("Location: .?action=".$last_page.'&profile_id='.$profile_id."#post-".$post_id);
		break;

	case 'add_comment':
		$user_id = $_SESSION['user_id'];
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
		$viewer = $_SESSION['user_id'];
		$notifications = get_notifications($viewer);
		make_notifications_seen($viewer);
		include 'view/notifications.php';
		break;

	case 'chat-page' :
		$viewer = $_SESSION['user_id'];
		$contact = filter_input(INPUT_GET,'contact',FILTER_SANITIZE_STRING);
		$messages = get_messages($viewer,$contact);
		make_seen_messages($viewer,$contact);
		include 'view/direct-message.php';
		

		break;

	case 'add-message' :
		$viewer = $_SESSION['user_id'];
		$contact = filter_input(INPUT_GET,'receiver',FILTER_SANITIZE_STRING);
		$text = filter_input(INPUT_GET,'new_message',FILTER_SANITIZE_STRING);
		send_message($viewer,$contact,$text);
		$messages = get_messages($viewer,$contact);
		header("Location: .?action=chat-page&contact=".$contact."#message1");


		break;

	case 'inbox' :
		$viewer = $_SESSION['user_id'];
		$contacts = get_contacts($viewer) ;
		include './view/massages-box.php' ;

		break;									


	default:
		include './view/login.php';	
		break;
}


?>

<?php include './view/footer.php' ?>
