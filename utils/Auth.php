<?php

class Auth{

	public static function attempt($username, $password, $hashedpass){
		$passwordIsValid = password_verify($password, $hashedpass);

		if ($passwordIsValid) {
			$_SESSION['user'] = $username;
			$_SESSION['is_logged_in'] = true;
		} elseif ($username != ''){
			$_SESSION['is_logged_in'] = false;
		}
	}
	public static function check(){
		return isset($_SESSION['LOGGED_IN_USER']);
	}
	public static function user(){
		return $_SESSION['is_logged_in'];
	}
	public static function logout(){
		session_destroy();
	}

}