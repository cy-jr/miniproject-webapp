<?php 
   $rand = bin2hex(openssl_random_pseudo_bytes(16));
   $_SESSION["nocsrftoken"] = $rand;
 ?>
<html>
      <h1>Login</h1>
<?php
  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa")
?>
          <form action="index.php" method="POST" class="form login">
                Username:<input type="text" class="text_field" name="username" maxlength="16" required/> <br>
                Password: <input type="password" class="text_field" name="password" minlength="" ="8" required="this is required"/> <br>
                <input type="hidden" name="nocsrftoken" value=" <?php echo $rand; ?> ">
                <button class="button" type="submit">
                  Login
                </button>
          <a href="registrationform.php">Create Account</a>      
          </form> 
          

  </html>

