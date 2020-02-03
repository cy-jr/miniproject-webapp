<?php
 require 'database.php';
 require 'session_auth.php';

 	$nocsrftoken = $_POST["nocsrftoken"];
	$content = $_POST["content"];
	$postedby = $_SESSION["username"];

    if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])){
            echo "<script>alert('ERROR CODE: CSRF Detected');</script>";
            header("Refresh:0; url=form.php");
            die();
    }     
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Access denied, please login!');</script>";
        header("Refresh:0; url=form.php");
        die();
    }

	if(addnewpost($content, $postedby)){
		echo "New Post Added!";
		header("Refresh:1; url=index.php");
	}else{
		echo "Error adding post!";
	}
?>

<a href="index.php">Home</a>