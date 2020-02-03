<?php 
	session_start();
	//checks the session

	if(!isset($_SESSION["username"]) or isset($_SESSION["logged"]) != TRUE){
            echo "<script>alert('Please login first!');</script>";
            header("Refresh:0; url=form.php");
            die();
    }     

    //checks for session hijack
    
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Session hijecking detected!');</script>";
        header("Refresh:0; url=form.php");
        die();
    }


 ?>