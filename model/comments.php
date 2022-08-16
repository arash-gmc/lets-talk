<?php

function add_comment($user_id,$post_id,$comment_text){
	global $db;
	$query = 'INSERT INTO comments (user_id,post_id,`text`) VALUES (:user_id , :post_id , :mytext)';
	$statement = $db->prepare($query);
	$statement->bindValue(':user_id',$user_id);
	$statement->bindValue(':post_id',$post_id);
	$statement->bindValue(':mytext',$comment_text);
	$statement->execute();
	$statement->closeCursor();
}

function comments_count($post_id){
	global $db;
	$query = 'SELECT count(ID) FROM comments WHERE post_id = :post_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':post_id',$post_id);
	$statement->execute();
	$num = $statement -> fetchAll();
	$statement->closeCursor();
	return $num[0][0];
}

function get_some_comments($post_id){
	global $db;
	$query = 'SELECT * FROM comments WHERE post_id = :post_id ORDER BY date_time DESC LIMIT 2';
	$statement = $db->prepare($query);
	$statement->bindValue(':post_id',$post_id);
	$statement->execute();
	$comments = $statement -> fetchAll();
	$statement->closeCursor();
	return $comments;
}



?>