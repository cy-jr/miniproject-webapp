<?php
   require 'session_auth.php';
   require 'database.php';
         if(isset($_POST["username"]) and isset($_POST["password"])){
        if (securechecklogin($_POST["username"],$_POST["password"])) {
                $_SESSION["logged"] = TRUE;
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
        }else{
            echo "<script>alert('Invalid username/password');</script>";
            unset($_SESSION["logged"]);
            header("Refresh:0; url=form.php");
            die();
        }        
    }
    //check session
    if(!isset($_SESSION["username"]) or isset($_SESSION["logged"]) != TRUE){
            echo "<script>alert('Please login first!');</script>";
            header("Refresh:0; url=form.php");
            die();
    }     
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Access denied, please login!');</script>";
        header("Refresh:0; url=form.php");
        die();
    }
?>
<?php

	$nocsrftoken = $_POST["nocsrftoken"];
 	
	$comment = $_REQUEST["comment"];

	$postid = $_REQUEST["postid"];

	$postedby = $_SESSION["username"];

	// echo "DEBUG> got Content = $comment; Postedby = $postedby; PostID = $postid";
	
	// addnewpost($content, $postedby);
	if(addcomment($comment, $postedby, $postid)){
		echo "New comment Added!";
		header("Refresh:1; url=index.php");
	}else{
		echo "Error adding post!";
	}
?>

<a href="index.php">Home</a>