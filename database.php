<?php   
//database.php
            $mysqli = new mysqli('localhost',
                                 'akpans1',
                                 'p@sw0rd',
                                 'secad_sm19');   


    function changepassword($username, $newpassword) {
        global $mysqli;
            if ($mysqli->connect_errno) {
                echo "Connection to the database failed..";
                exit();
            }
            $prepared_sql = "UPDATE  Users SET password=Password(?) WHERE username=?;";

            if(!$stmt = $mysqli->prepare($prepared_sql)){
                echo "prepared statement error";
                return FALSE;
            }

            $stmt->bind_param("ss",$newpassword, $username);

            if(!$stmt->execute()) {
                echo "Execute error!";
                return FALSE;
            }
            return TRUE;
        }

        function addnewuser($username, $password) {
        global $mysqli;
            $prepared_sql = "INSERT INTO Users VALUES (?,password(?));";
            
            if(!$stmt = $mysqli->prepare($prepared_sql)){
                echo "prepared statement error";
                return FALSE;
            }
            $stmt->bind_param("ss", $username,$password);

            if(!$stmt->execute()) {
                echo "Execute error!";
                return FALSE;
            }
            if(!$stmt->store_result()) {
                echo "store result error!";
                return FALSE;
            }

            $result = $stmt;
        
            return TRUE;
        }

        function addnewpost($content, $postedby){
            global $mysqli;
            $prepared_sql = "insert into Posts (content, postedby) values (?, ?);";
            
            if(!$stmt = $mysqli->prepare($prepared_sql)){
                echo "prepared statement error";
                return FALSE;
            }
            $stmt->bind_param("ss", $content,$postedby);
            if(!$stmt->execute()) {
                echo "DEBUG: Execute error!";
                return FALSE;
            }
            if(!$stmt->store_result()) {
                echo "DEBUG: store result error!";
                return FALSE;
            }
            $result = $stmt;
            return TRUE;
        }

        function addcomment($comment, $postedby, $postid){
            global $mysqli;


            $prepared_sql = "insert into Comments (comment,commentby,postid) values(?,?,?);";
            
            if(!$stmt = $mysqli->prepare($prepared_sql)){
                echo "prepared statement error";
                return FALSE;
            }
            
            $stmt->bind_param("ssi", $comment, $postedby, $postid);

            if(!$stmt->execute()) {
                echo "DEBUG: Execute error!";
                return FALSE;
            }
            
            return TRUE;
        }

        function getcomment($pid){
            $local_mysqli = new mysqli('localhost',
                                 'akpans1',
                                 'p@sw0rd',
                                 'secad_sm19');  
            $prepared_sql = "SELECT commentid, comment, commenttime, commentby, postid FROM Comments where postid=?;";

            if(!$stmt = $local_mysqli->prepare($prepared_sql)){
                echo "Cannot prepare statement";
                return;
            }

            $stmt->bind_param("i", $pid);

            if(!$stmt -> execute()){
                echo "DEBUG: exec error";
                return;
            }
            if(!$stmt -> bind_result($commentid, $comment, $commenttime, $commentby, $postid)){
                echo "Binding failed";
                return;
            }
                while($stmt -> fetch()){
                        echo htmlentities($commentby)." said: ". htmlentities($comment);
                        echo "<br>";
                }            
        }


        function getpost($postid){
            global $mysqli;
            $prepared_sql = "SELECT postid, content, posttime, postedby FROM Posts WHERE postid = ?;";
            if(!$stmt = $mysqli -> prepare($prepared_sql)){
                echo "Cannot prepare statement";
                return;
            }
            $stmt->bind_param("s", $postid);
            if(!$stmt -> execute()){
                echo "DEBUG: exec error";
                return;
            }
            if(!$stmt -> bind_result($postid, $content, $posttime, $postedby)){
                echo "Binding failed";
                return;
            }
            // echo htmlentities($content);
                while($stmt -> fetch()){
                    if(htmlentities($postedby) == $_SESSION["username"]){
                        echo htmlentities($content);
                        return;
                    }else {
                        //header("Refresh:1; url=editpostform.php");
                        break;
                    }
                }
        }

        function getpostcontent($postid){
            
            $local_mysqli1 = new mysqli('localhost',
                                 'akpans1',
                                 'p@sw0rd',
                                 'secad_sm19'); 
            
            $prepared_sql = "SELECT content FROM Posts WHERE postid = ?;";
            if(!$stmt = $local_mysqli1 -> prepare($prepared_sql)){
                echo "Cannot prepare statement";
                return;
            }

            $stmt->bind_param("s", $postid);

            if(!$stmt -> execute()){
                echo "DEBUG: exec error";
                return;
            }
            
            if(!$stmt -> bind_result($cnt)){
                echo "Binding failed";
                return;
            }
            while($stmt -> fetch()){
                echo htmlentities($cnt);    
            }
              
        }

        function getpostedy($postid){
            
            $local_mysqli1 = new mysqli('localhost',
                                 'akpans1',
                                 'p@sw0rd',
                                 'secad_sm19'); 
            
            $prepared_sql = "SELECT postedby FROM Posts WHERE postid = ?;";
            if(!$stmt = $local_mysqli1 -> prepare($prepared_sql)){
                echo "Cannot prepare statement";
                return;
            }

            $stmt->bind_param("i", $postid);

            if(!$stmt -> execute()){
                echo "DEBUG: exec error";
                return;
            }
            
            if(!$stmt -> bind_result($postedby)){
                echo "Binding failed";
                return;
            }
            while($stmt -> fetch()){
                echo htmlentities($postedby);   
            }
            return;
            
        }

        function updatepost($content, $postid) {
            global $mysqli;
                if ($mysqli->connect_errno) {
                    echo "Connection to the database failed..";
                    exit();
                }

                $prepared_sql = "UPDATE  Posts SET content=? WHERE postid=?;";

                if(!$stmt = $mysqli->prepare($prepared_sql)){
                    echo "DEBUG: prepared statement error";
                    return FALSE;
                }

                $stmt->bind_param("ss",$content, $postid);

                if(!$stmt->execute()) {
                    echo "DEBUG: Execute error!";
                    return FALSE;
                }
                return TRUE;
            }

        function deletepost($postid){
            global $mysqli;
                if ($mysqli->connect_errno) {
                    echo "Connection to the database failed..";
                    exit();
                }
                $prepared_sql = "DELETE FROM Posts WHERE postid=?";
                if(!$stmt = $mysqli->prepare($prepared_sql)){
                    echo "DEBUG: prepared statement error";
                    return FALSE;
                }
                $stmt->bind_param("s", $postid);
                if(!$stmt->execute()) {
                    echo "DEBUG: Execute error!";
                    return FALSE;
                }
                return TRUE;
        }



        function showallposts($currentuser){
            global $mysqli;
            $prepared_sql = "SELECT * FROM Posts;";
            if(!$stmt = $mysqli -> prepare($prepared_sql)){
                echo "Cannot prepare statement";
                return;
            }
            if(!$stmt -> execute()){
                echo "DEBUG: exec error";
                return;
            }
            if(!$stmt -> bind_result($postid, $content, $posttime, $postedby)){
                echo "Binding failed";
                return;
            }
            $postcount = 0;

            while($stmt -> fetch()){
                $postcount++;
                echo "<div id='posts' style='color:black;font-size:18px;font-family:verdana;'>";
                        echo "<br>" . htmlentities($posttime) . " <br><b>" . htmlentities($postedby) . "</b> wrote: " . htmlentities($content) . "</br>\n";
                echo "</div>";
                    //comments for each post 
                echo "<a href='#' style='color:blue;font-size:15px;' onclick='togglecomments(\"cmnts_" . $postcount . "\")'> show/hide comments</a>  ";
                echo "<div id='cmnts_$postcount' style='background-color:pink' >";
                    getcomment($postid);
                echo "</div>";
                echo "<a href='commentform.php?postid=" . htmlentities($postid) . "'style='color:blue;font-size:15px;'>comment</a><br>";

                    if($currentuser == $postedby){
                        echo "<a href='editpostform.php?postid=" . htmlentities($postid) . "' style='color:blue;font-size:15px;'>Edit</a>\n";

                        

                        echo "<a href='deletepostform.php?postid=" . htmlentities($postid) . "' style='color:blue;font-size:15px;'>Delete</a><br>\n"; 
                    }
                    echo "<hr>";
            }
           if($postcount==0){
                    echo "No posts. <a href='newpostform.php'>Create new post.</a><br>\n";
                }else{
                    echo "<a href='newpostform.php'><br>Add new post</a><br>\n";
                }
        }
?>
<script>
    function togglecomments(id) {
      var x = document.getElementById(id);
      if (x.style.display === "block") {
            x.style.display = "none";
      } else {
            x.style.display = "block";
      }
    }

</script>