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


function get_posts(){
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