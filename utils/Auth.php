<?php

require 'Log.php';

class Auth{
	public static $password = "2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm";
	public static $username = "guest";

	public static function attempt($username, $password){
		$log = new Log();
		$passwordIsValid = password_verify($password, self::$password);
		$usernameIsValid = ($username == self::$username);

		if ($usernameIsValid && $passwordIsValid) {
			$_SESSION['LOGGED_IN_USER'] = $username;
			$log->info($username . 'logged in');
		} elseif ($username != ''){
			$log->error($username . ' failed to login!');
		}
	}
	public static function check(){
		return isset($_SESSION['LOGGED_IN_USER']);
	}
	public static function user(){
		return $_SESSION['LOGGED_IN_USER'];
	}
	public static function logout(){
		session_destroy();
	}

}