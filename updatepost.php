<?php
//updatepost.php
   require 'session_auth.php';
   require 'database.php';
       
    //check sessio
?>
<?php 
	$username = $_SESSION["username"];
	$content = $_REQUEST["content"];
    $postid = $_REQUEST["postid"];
    $nocsrftoken = $_POST["nocsrftoken"];

    if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])){
            echo "<script>alert('Access denied: Unauthorized query');</script>";
            header("Refresh:0; url=form.php");
            die();
    }     
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Access denied, please login!');</script>";
        header("Refresh:0; url=form.php");
        die();
    }
	
	
	if(isset($content)){
		//TODO: connect to database, execute sql 
		// echo htmlentities("DEBUG> got username=$username; newpassword=$newpassword");
		if(updatepost($content, $postid)){
			echo "<h4>Post updated!</h4>";
            header("Refresh:1; url=index.php");
		}else {
			echo "<h4>Error updating post!</h4>";
            header("Refresh:1; url=index.php");
		}
	}else{
		echo "Nothing provided";
		die();
	}
	
 ?>
<a href="index.php">Home</a>  |  <a href="logout.php">Logout</a>
	
 
