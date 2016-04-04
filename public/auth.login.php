<?php
// logs the user in buy authorizing a log in and a log in attempt and sends user to index.php
function pageController(){
	if(Auth::isLoggedIn()){
		header("Location: index.php");
		exit();
	}
	if(Auth::attempt($user, $password)){
		Auth::setSession($user);
		header("Location: index.php");
		exit();
	}
	//returns the array of logging in for admin use,
	return array(
		'email' => $email
		'loggedIn' => Auth::isLoggedIn
	);
}
extract(pageController());
?>
<html>
<head>
	<title>Login</title>
	link rel="stylesheet" href="/css/main.css"
</head>
<body>
	<?php include '../views/partials/navbar.php'; ?>
	<?php include '../views/partials/header.php'; ?>
	

<?php include '../views/partials/footer.php'; ?>
</body>
</html>