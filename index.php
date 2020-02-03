<?php
//index.php
    session_start(); 
    require "database.php";
    
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

    if(!isset($_SESSION["username"]) AND isset($_SESSION["logged"]) != TRUE){
            echo "<script>alert('Please login first!');</script>";
            header("Refresh:0; url=form.php");
            die();
    }
    if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
        echo "<script>alert('Session hijecking detected!');</script>";
        header("Refresh:0; url=form.php");
        die();
    }

?>
    <h2> Welcome, <?php echo htmlentities($_SESSION['username']); ?> !</h2>
      <a href="changepasswordform.php" style='color:blue;font-size:13px;'>Change Password</a>  <a href="logout.php" style='color:blue;font-size:13px;'>Logout</a>
<?php       


    function securechecklogin($username, $password) {

            $mysqli = new mysqli('localhost',
                                 'akpans1',
                                 'p@sw0rd',
                                 'secad_sm19');
            if ($mysqli->connect_errno) {
                echo "Connection to the database falied..";
                exit();
            }
            $prepared_sql = "select * from Users where username=? and password=password(?);";
            

            if(!$stmt = $mysqli->prepare($prepared_sql)){
                echo "prepared statement error";
                return FALSE;
            }
            $stmt->bind_param("ss",$username,$password);
            if(!$stmt->execute()) {
                echo "DEBUG: Execute error!";
                return FALSE;
            }
            if(!$stmt->store_result()) {
                echo "DEBUG: store result error!";
                return FALSE;
            }        
            $result = $stmt;
        
            if($result->num_rows == 1) {
                return TRUE;    
            }
            return FALSE;
        }

    function checklogin($username, $password) {
        $mysqli = new mysqli('localhost',
                             'akpans1',
                             'p@sw0rd',
                             'secad_sm19');
        if ($mysqli->connect_errno) {
            echo "Connection to the database falied..";
            exit();
        } 
        $sql = "select * from Users where username='". $username."' and password=password('".$password."');";
        
        $result = $mysqli->query($sql);
        if($result->num_rows == 1) {
            return TRUE;    
        }
        return FALSE;
    }
    showallposts($_SESSION["username"]);
    

?>
    