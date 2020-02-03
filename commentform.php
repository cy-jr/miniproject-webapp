<?php
//commentform.php
   require 'session_auth.php';
   require 'database.php';
   // $username = $_SESSION["username"];
   $postid = $_REQUEST["postid"];

   $rand = bin2hex(openssl_random_pseudo_bytes(16));
   $_SESSION["nocsrftoken"] = $rand;
?>
<html>
      <h1>ProjectFB</h1>
      <h4>Add Comment</h4>
<?php

  //some code here
  echo "" . date("Y-m-d h:i:sa");
  
  $postid = $_REQUEST["postid"];
  echo "<br><br>";

          getpostcontent($postid);

?>
          <form action="addcomment.php" method="REQUEST" class="form">
                <!-- <?php echo htmlentities($_SESSION["username"]); ?> -->
                <br>
                <textarea name="comment" placeholder="Enter comment"></textarea>
                  
                <br>

                <input type="hidden" name="username" value="<?php echo htmlentities($_SESSION["username"]); ?>"></input>
                <input type="hidden" name="postid" value="<?php echo htmlentities($postid); ?>"></input>
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"></input>
                
                <button class="button" type="submit">
                  Post
                </button>
          </form> 
  </html>

