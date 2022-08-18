<?php


function send_message($from_id,$to_id,$text){
	global $db;
	$query = 'INSERT INTO messages (from_id,to_id,`text`) VALUES (:from_id,:to_id,:my_text)';
	$statement = $db->prepare($query);
	$statement->bindValue(':from_id',$from_id);
	$statement->bindValue(':to_id',$to_id);
	$statement->bindValue(':my_text',$text);
	$statement->execute();
	$statement->closeCursor();
}


function get_messages($viewer_id,$sender_id){
	global $db;
	$query = 'SELECT * FROM messages WHERE ( to_id = :viewer AND from_id = :sender ) OR ( to_id = :sender AND from_id = :viewer ) ORDER BY time_date DESC LIMIT 50';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->bindValue(':sender',$sender_id);
	$statement->execute();
	$messages = $statement -> fetchAll() ;
	return $messages;

}

function get_contacts($viewer_id){
	global $db;
	$query = 'SELECT from_id,to_id FROM messages WHERE to_id = :viewer OR from_id = :viewer ORDER BY time_date DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->execute();
	$results = $statement -> fetchAll() ;
	$contacts = [];
	foreach ($results as $rr ) {
		foreach ($rr as $r) {
			if ($r==$viewer_id){
				continue;
			}else if(!in_array($r, $contacts)){
				array_push($contacts, $r);
			}
		}
	}
	return $contacts;
}

function get_last_message($viewer_id,$contact_id){
	global $db;
	$query = 'SELECT `text` FROM messages WHERE ( to_id = :viewer AND from_id = :sender ) OR ( to_id = :sender AND from_id = :viewer ) ORDER BY time_date DESC LIMIT 1';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->bindValue(':sender',$contact_id);
	$statement->execute();
	$results = $statement -> fetch() ;
	return $results[0];
}


function check_unseen_messages($viewer_id,$contact_id){
	global $db;
	$query = 'SELECT COUNT(ID) FROM messages WHERE to_id = :viewer AND from_id = :sender AND seen = 0 ORDER BY time_date DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->bindValue(':sender',$contact_id);
	$statement->execute();
	$results = $statement -> fetch() ;
	return $results[0];
}

function make_seen_messages($viewer_id,$contact_id){
	global $db;
	$query = 'UPDATE messages SET seen = 1 WHERE from_id = :contact AND to_id = :viewer';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->bindValue(':contact',$contact_id);
	$statement->execute();
	
}


function check_all_unseen_messages($viewer_id){
	global $db;
	$query = 'SELECT from_id FROM messages WHERE to_id = :viewer AND seen = 0 GROUP BY from_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':viewer',$viewer_id);
	$statement->execute();
	$results = $statement -> fetchAll() ;
	return count($results);
}

?>

