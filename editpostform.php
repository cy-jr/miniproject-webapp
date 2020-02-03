<?php
//editpostform.php
   require 'session_auth.php';
   require 'database.php';
   
   $postid = $_REQUEST["postid"];

   $rand = bin2hex(openssl_random_pseudo_bytes(16));
   $_SESSION["nocsrftoken"] = $rand;

?>
<html>
      <h1>MiniFB</h1>
      <h4>Edit Post</h4>
<?php
  
echo "Current time: " . date("Y-m-d h:i:sa");


?>
          <form action="updatepost.php" method="POST" class="form">
                <br>
                <textarea name="content"><?php getpost($postid); ?></textarea><br>
                <input type="hidden" name="postid" value="<?php echo $postid; ?>">
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"></input>
                <button class="button" type="submit">
                  Post
                </button>
          </form> 
  </html>
