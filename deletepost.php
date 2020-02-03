<?php
   require 'session_auth.php';
   require 'database.php';
    $username = $_SESSION["username"];
    $content = $_REQUEST["content"];
    $postid = $_REQUEST["postid"];
    $nocsrftoken = $_POST["nocsrftoken"];

    if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])){
            echo "<script>alert('Access denied: Unauthorized query');</script>";
            //header("Refresh:0; url=form.php");
            die();
    }     
?>
<?php 

	if(isset($postid)){
		//TODO: connect to database, execute sql 
		// echo htmlentities("DEBUG> got username=$username; newpassword=$newpassword");
		if(deletepost($postid)){
			echo "<h4>Post deleted!</h4>";
            header("Refresh:1; url=index.php");
		}else {
			echo "<h4>Could not delete post!</h4>";
		}
	}else{
		echo "Nothing to delete";
        // header("Refresh:0; url=index.php");
	}
	
 ?>
<a href="index.php">Home</a>  |  <a href="logout.php">Logout</a>
	
 