<?php
   require 'session_auth.php';
   require 'database.php';
   $rand = bin2hex(openssl_random_pseudo_bytes(16));
   $_SESSION["nocsrftoken"] = $rand;
?>
<html>
      <h1>MiniFB</h1>
      <h4>Create New Post</h4>
<?php
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
        echo "<script>alert('Access denied, Please login');</script>";
        header("Refresh:0; url=form.php");
        die();
    }

  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa");
  
?>
          <form action="addnewpost.php" method="POST" class="form">
                <?php echo htmlentities($_SESSION["username"]); ?>
                <br>
                <textarea name="content" placeholder="What's on your mind?"></textarea><br>
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"></input>
                <button class="button" type="submit">
                  Post
                </button>
          </form> <!-- <a href="registrationform.php">New User? Register</a> -->
  </html>

