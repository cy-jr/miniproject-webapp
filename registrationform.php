
<html>
      <h1>Create Acccount</h1>
<?php
  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa")
?>
          <form action="addnewuser.php" method="POST" class="form login">
                Username:<input type="text" class="text_field" name="username" /> <br>
                Password: <input type="password" class="text_field" name="password" /> <br>
                <button class="button" type="submit">
                  Submit
                </button>
          </form> <!-- <a href="registrationform.php">New User? Register</a> -->
  </html>

