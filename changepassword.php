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
	$username = $_SESSION["username"];
	$newpassword = $_REQUEST["newpassword"];
	$nocsrftoken = $_POST["nocsrftoken"];
	// echo "DEBUG> got Username=$username; Pass=$newpassword";

	if(!isset($nocsrftoken) or ($nocsrftoken !=$_SESSION['nocsrftoken'])){
		echo "<script> alert('Cross-site request forgery is detected!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	}
	
	if(isset($newpassword)){
		//TODO: connect to database, execute sql 
		// echo htmlentities("DEBUG> got username=$username; newpassword=$newpassword");
		if(changepassword($username, $newpassword)){
			echo "<h4>Changed Password Successfully!</h4>";
		}else {
			echo "<h4>Could not change</h4>";
		}
	}else{
		echo "Nothing provided";
		die();
	}
	
 ?>
<a href="index.php">Home</a>  |  <a href="logout.php">Logout</a>
	
 