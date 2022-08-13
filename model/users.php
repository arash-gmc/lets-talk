<?php

function find_username($user_id){
	global $db;
	$query = 'SELECT username FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id',$user_id);
	$statment -> execute();
	$user = $statment -> fetch();
	$statment -> closeCursor();
	return $user;
}

function login($username,$password){
	global $db;
	$query = 'SELECT * FROM users WHERE username = :username';
	$statment = $db->prepare($query);
	$statment -> bindValue (':username',$username);
	$statment -> execute();
	$user = $statment -> fetch();
	$statment -> closeCursor();
	return $user;
	
}

function add_user($username,$password){
	global $db;
	$query = 'INSERT INTO users (username,password) VALUES (:username,:password)';
	$statment = $db->prepare($query);
	$statment -> bindValue (':username',$username);
	$statment -> bindValue (':password',$password);
	$done = $statment -> execute();
	$statment -> closeCursor();
	return $done;
}

function follow($following_id,$followed_id){
	var_dump($following_id);
	global $db;
	$query = 'SELECT followings FROM users WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> execute();
	$followings = ($statment -> fetch())[0] ;
	$followings = explode(',', $followings);
	if(!(in_array($followed_id, $followings))){
		array_push($followings, $followed_id);
	}
	$followings = implode(',',$followings);
	$query = 'UPDATE users SET followings = :followings WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> bindValue (':followings', $followings);
	$statment -> execute();
	$statment -> closeCursor();
	
	
}

function unfollow($following_id,$followed_id){
	global $db;
	$query = 'SELECT followings FROM users WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> execute();
	$followings = ($statment -> fetch())[0] ;
	$followings = explode(',', $followings);
	if(in_array($followed_id, $followings)){
		$key = array_search($followed_id, $followings);
		unset($followings[$key]);
	}
	$followings = implode(',',$followings);
	$query = 'UPDATE users SET followings = :followings WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> bindValue (':followings', $followings);
	$statment -> execute();
	$statment -> closeCursor();
	
	
}

function follow_check($following_id,$followed_id){
	global $db;
	$query = 'SELECT followings FROM users WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> execute();
	$followings = ($statment -> fetch())[0] ;
	$followings = explode(',', $followings);
	if(in_array($followed_id, $followings)){
		return true ;
	}else{
		return false ;
	}
	
	
}






?>