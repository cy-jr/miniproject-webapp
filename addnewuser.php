<?php
 require 'database.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	// echo "DEBUG> got Username = $username; Password = $password";

		if(addnewuser($username, $password)){
				echo "<h4>" . htmlentities("New User '$username' has been added!") . "</h4>";
				header("Refresh:1; url=index.php");
			} else {
				echo htmlentities("<h4>Could not add $username </h4>");
			}
?>

<a href="index.php">Home</a>