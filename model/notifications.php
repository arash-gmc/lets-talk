<?php

function make_notification($from_id,$to_id,$text){
	if ($from_id==$to_id){
		return ;
	}
	global $db;
	$query = 'INSERT INTO notifications (from_id,to_id,`text`) VALUES (:from_id,:to_id,:my_text)';
	$statement = $db->prepare($query);
	$statement->bindValue(':from_id',$from_id);
	$statement->bindValue(':to_id',$to_id);
	$statement->bindValue(':my_text',$text);
	$statement->execute();
	$statement->closeCursor();
}

function get_notifications($viewer_id){
	global $db;
	$query = 'SELECT * FROM notifications WHERE to_id = :viewer ORDER BY time_date DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->execute();
	$notifications = $statement -> fetchAll() ;
	return $notifications;

}

function make_notifications_seen($viewer_id){
	global $db;
	$query = 'UPDATE notifications SET seen = 1 WHERE to_id = :viewer ';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->execute();
	$statement->closeCursor();

}

function count_unseen_notification($viewer_id){
	global $db;
	$query = 'SELECT count(ID) FROM notifications WHERE to_id = :viewer  AND `seen` IS NULL ' ;
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->execute();
	$result = $statement -> fetch();
	$statement->closeCursor();
	$count = $result[0][0];
	return $count;

}


?>