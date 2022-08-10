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



?>