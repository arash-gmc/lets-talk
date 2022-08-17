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
	if ($num[0][0]==0){
		return null;
	}
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


function comment_check($user_id,$post_id){
	global $db;
	$query = 'SELECT user_id FROM comments WHERE post_id = :post_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':post_id', $post_id);
	$statment -> execute();
	$commenters = $statment -> fetchAll() ;
	foreach( $commenters as $commenter ){
		if ($commenter[0]==$user_id){
			return true;
		}
	}
	return false;

	
	
}



?>