<?php
// logs out user by authorizing a logout and then sending the user to index.php
Auth::logout();
header("Location: index.php");
exit();

?>