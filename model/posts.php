<?php

function send_post($user_id,$post_text){
	global $db;
	$query = "INSERT INTO `posts` (`user-id`, `post`) VALUES (:user_id, :post);";
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id',$user_id);
	$statment -> bindValue (':post',$post_text);	
	$statment -> execute();
	$statment -> closeCursor();
	
}


function get_all_posts(){
	global $db;
	$query = "SELECT posts.* , users.username FROM posts 
	JOIN users ON posts.`user-id` = users.`ID`
	ORDER BY `date-time` DESC";
	$statment = $db->prepare($query);
	$statment -> execute();
	$posts = $statment->fetchAll();
	$statment -> closeCursor();
	return $posts;
}


function get_posts_from_one_user($user_id){
	global $db;
	$query = "SELECT * FROM posts 
	WHERE `user-id`= :user_id
	ORDER BY `date-time` DESC";
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id',$user_id);
	$statment -> execute();
	$posts = $statment->fetchAll();
	$statment -> closeCursor();
	return $posts;
}

function get_selected_posts($selected_ids){
	global $db;
	$selected_ids = '('.$selected_ids.')';
	$query = "SELECT posts.* , users.username FROM posts 
	JOIN users ON posts.`user-id` = users.ID
	WHERE users.ID IN :following
	ORDER BY `date-time` DESC";
	$query = str_replace(':following', $selected_ids, $query);
	$statment = $db->prepare($query);
	$statment -> execute();
	$posts = $statment->fetchAll();
	$statment -> closeCursor();
	return $posts;
}

function like($post_id,$user_id){
	global $db;
	$query = 'SELECT likes FROM posts WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> execute();
	$likers = ($statment -> fetch())[0] ;
	$likers = explode(',', $likers);
	if(!(in_array($user_id, $likers))){
		array_push($likers, $user_id);
	}
	$likers = implode(',',$likers);
	if(substr($likers,0,1)==','){$likers = substr($likers,1,strlen($likers));}
	$query = 'UPDATE posts SET likes = :likers WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> bindValue (':likers', $likers);
	$statment -> execute();
	$statment -> closeCursor();
}

function unlike($post_id,$user_id){
	global $db;
	$query = 'SELECT likes FROM posts WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> execute();
	$likers = ($statment -> fetch())[0] ;
	$likers = explode(',', $likers);
	if(in_array($user_id, $likers)){
		$key = array_search($user_id, $likers);
		unset($likers[$key]);
	}
	$likers = implode(',',$likers);
	if(substr($likers,0,1)==','){$likers = substr($likers,1,strlen($likers));}
	$query = 'UPDATE posts SET likes = :likers WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> bindValue (':likers', $likers);
	$statment -> execute();
	$statment -> closeCursor();
}

function like_check($user_id,$post_id){
	global $db;
	$query = 'SELECT likes FROM posts WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> execute();
	$likers = ($statment -> fetch())[0] ;
	$statment -> closeCursor();
	$likers = explode(',', $likers);
	if(in_array($user_id, $likers)){
		return true ;
	}else{
		return false ;
	}
	
	
}


function like_count($post_id){
	global $db;
	$query = 'SELECT likes FROM posts WHERE ID = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> execute();
	$likers = ($statment -> fetch())[0] ;
	$statment -> closeCursor();
	$likers = explode(',', $likers);

	if (count($likers)==1){
		if ($likers[0]==''){
			return null;
		}
	}
	$like_count = count($likers);
	if ($like_count == 0){
		return null;
	}else{
	return $like_count;
	} 
	

}	



function posts_count($user_id){
	global $db;
	$query = 'SELECT count(ID) FROM posts WHERE `user-id` = :user_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':user_id',$user_id);
	$statement->execute();
	$num = $statement -> fetchAll();
	$statement->closeCursor();
	return $num[0][0];
}