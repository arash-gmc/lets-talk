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