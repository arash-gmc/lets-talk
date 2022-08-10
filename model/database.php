<?php

$dsn = 'mysql:host =localhost ; dbname=lets_talk' ;
$username = 'arash';
$password = '3235962';

try{
	$db = new PDO($dsn,$username,$password);
}catch(PDOException $e){
	$error = 'Database Error: ';
	$error.= $e->getMessage();
	echo $error; 
	die();
		
}

?>