<?php

function find_username($user_id){
	global $db;
	$query = 'SELECT username FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id',$user_id);
	$statment -> execute();
	$user = $statment -> fetch();
	$statment -> closeCursor();
	return $user[0];
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


function update_user_info($user_id,$property_to_update,$new_value){
	global $db;
	$query = "UPDATE users SET :property = :new_value WHERE ID = :user_id";
	$query = str_replace(':property', $property_to_update, $query);
	$statment = $db->prepare($query);
	$statment -> bindValue (':new_value',$new_value);
	$statment -> bindValue (':user_id',$user_id);
	$done = $statment -> execute();
	$statment -> closeCursor();
	return $done;
}

function get_password($user_id){
	global $db;
	$query = 'SELECT password FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id',$user_id);
	$statment -> execute();
	$password = $statment -> fetch();
	$statment -> closeCursor();
	return $password[0];
}

function follow($following_id,$followed_id){
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
	if(substr($followings,0,1)==','){$followings = substr($followings,1,strlen($followings));}
	$query = 'UPDATE users SET followings = :followings WHERE ID = :following_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':following_id', $following_id);
	$statment -> bindValue (':followings', $followings);
	$statment -> execute();


	$query = 'SELECT followers FROM users WHERE ID = :followed_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':followed_id', $followed_id);
	$statment -> execute();
	$followers = ($statment -> fetch())[0] ;
	$followers = explode(',', $followers);
	if(!(in_array($following_id, $followers))){
		array_push($followers, $following_id);
	}
	$followers = implode(',',$followers);
	if(substr($followers,0,1)==','){$followers = substr($followers,1,strlen($followers));}
	$query = 'UPDATE users SET followers = :followers WHERE ID = :followed_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':followed_id', $followed_id);
	$statment -> bindValue (':followers', $followers);
	$statment -> execute();


	$statment -> closeCursor();
	return $followings;
	
	
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


	$query = 'SELECT followers FROM users WHERE ID = :followed_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':followed_id', $followed_id);
	$statment -> execute();
	$followers = ($statment -> fetch())[0] ;
	$followers = explode(',', $followers);
	if(in_array($following_id, $followers)){
		$key = array_search($following_id, $followers);
		unset($followers[$key]);
	}
	$followers = implode(',',$followers);
	$query = 'UPDATE users SET followers = :followers WHERE ID = :followed_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':followed_id', $followed_id);
	$statment -> bindValue (':followers', $followers);
	$statment -> execute();


	$statment -> closeCursor();
	return $followings;
	
	
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

function followings_count($profile_id){
	global $db;
	$query = 'SELECT followings FROM users WHERE ID = :profile_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':profile_id', $profile_id);
	$statment -> execute();
	$followings = ($statment -> fetch())[0] ;
	$followings = explode(',', $followings);
	if (count($followings)==1){
		if ($followings[0]==''){
			return 0;
		}
	}	
	
	$count = count($followings);
	return $count;
 
}

function followers_count($profile_id){
	global $db;
	$query = 'SELECT followers FROM users WHERE ID = :profile_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':profile_id', $profile_id);
	$statment -> execute();
	$followers = ($statment -> fetch())[0] ;
	$followers = explode(',', $followers);
	if (count($followers)==1){
		if ($followers[0]==''){
			return 0;
		}
	}	
	
	$count = count($followers);
	return $count;
 
}

function get_followings($profile_id){
	global $db;
	$query = 'SELECT followings FROM users WHERE ID = :profile_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':profile_id', $profile_id);
	$statment -> execute();
	$followings = ($statment -> fetch())[0] ;
	$followings = explode(',', $followings);
	if (count($followings)==1){
		if ($followings[0]==''){
			return 0;
		}
	}	
	
	return $followings;
 
}

function get_followers($profile_id){
	global $db;
	$query = 'SELECT followers FROM users WHERE ID = :profile_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':profile_id', $profile_id);
	$statment -> execute();
	$followers = ($statment -> fetch())[0] ;
	$followers = explode(',', $followers);
	if (count($followers)==1){
		if ($followers[0]==''){
			return null;
		}
	}	
	return $followers;
 
}


function add_to_favourites($user_id,$post_id){
	global $db;
	$query = 'SELECT favourites FROM users WHERE ID = :user';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user', $user_id);
	$statment -> execute();
	$favourites = ($statment -> fetch())[0] ;
	$favourites = explode(',', $favourites);
	if(!(in_array($post_id, $favourites))){
		array_push($favourites, $post_id);
	}
	$favourites = implode(',',$favourites);
	if(substr($favourites,0,1)==','){$favourites = substr($favourites,1,strlen($favourites));}
	$query = 'UPDATE users SET favourites = :favourites WHERE ID = :user';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user', $user_id);
	$statment -> bindValue (':favourites', $favourites);
	$statment -> execute();

}


function remove_from_favourites($user_id,$post_id){
	global $db;
	$query = 'SELECT favourites FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id', $user_id);
	$statment -> execute();
	$favourites = ($statment -> fetch())[0] ;
	$favourites = explode(',', $favourites);
	if(in_array($post_id, $favourites)){
		$key = array_search($post_id, $favourites);
		unset($favourites[$key]);
	}
	$favourites = implode(',',$favourites);
	$query = 'UPDATE users SET favourites = :favourites WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id', $user_id);
	$statment -> bindValue (':favourites', $favourites);
	$statment -> execute();

}

function favourites_check($user_id,$post_id){
	global $db;
	$query = 'SELECT favourites FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id', $user_id);
	$statment -> execute();
	$favourites = ($statment -> fetch())[0] ;
	$favourites = explode(',', $favourites);
	if(in_array($post_id, $favourites)){
		return true ;
	}else{
		return false ;
	}
}

function get_favourites($user_id){
	global $db;
	$query = 'SELECT favourites FROM users WHERE ID = :user_id';
	$statment = $db->prepare($query);
	$statment -> bindValue (':user_id', $user_id);
	$statment -> execute();
	$favourites = ($statment -> fetch())[0] ;
	return $favourites;
}


?>