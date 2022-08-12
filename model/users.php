<?php

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


?>