<?php
   require 'session_auth.php';
   require 'database.php';
   $rand = bin2hex(openssl_random_pseudo_bytes(16));
   $_SESSION["nocsrftoken"] = $rand;
?>
<html>
      <h1>ProjectFB</h1>
      <h4>Delete Post</h4>
<?php

    //check session
    if(!isset($_SESSION["username"]) or isset($_SESSION["logged"]) != TRUE){
            echo "<script>alert('Please login first!');</script>";
            header("Refresh:0; url=form.php");
            die();
    }     
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Access denied, Please login');</script>";
        header("Refresh:0; url=form.php");
        die();
    }

  //some code here
echo "Current time: " . date("Y-m-d h:i:sa");
$postid = $_REQUEST["postid"];

  echo "<br>";
// getpost($postid);
 // getpostcontent($postid);
 $sessionuser = $_SESSION["username"];
 

 // echo "<br>DEBUG: SessionUser: $sessionuser; PostUser: ";


 if (htmlentities($sessionuser) != getpostedy($postid)){
    echo "<script>alert('Unauthorized Request!');</script>";
    header("Refresh:0; url=index.php");
 }
  
?>
          <form action="deletepost.php" method="POST" class="form">
                <br>
                <?php echo htmlentities($sessionuser); ?>
                <p>Are you sure you want to delete this post?</p>
                <p><b><?php echo htmlentities(getpostcontent($postid)); ?></b></p>
                <!-- <textarea name="content" disabled><?php getpost($postid); ?></textarea><br> -->
                <input type="hidden" name="postid" value="<?php echo htmlentities("$postid"); ?>">
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"></input>
                <button class="button" type="submit">
                  Delete
                </button>
                
          </form>
          <a href="index.php">Cancel</a> <form action="index.php" method="POST" class="form">
<!--             <button class="button" type="submit">
                  
                </button>  -->
          </form>
                
  </html>