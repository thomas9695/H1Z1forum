<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title>forum</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="../styles/css/bb.css" type="text/css" />
</head>
<body>

<div>
    <img class="resize" src="">

    <STYLE>
        <!--
        A{text-decoration:none}
        -->
    </STYLE>

    <div id="main">
        <div class="form" style="width:300px; margin-right:130px; margin-left:auto; margin-bottom: 10px;">
            <form action="" method="post">
                <input type="submit" value = "Logout" formaction="../logout.php?logout=true">
            </form>
        </div>

        <div class="container">
            <div class="logo">
                <img src="../styles/pictures/logo.png">
            </div>
            <p class="navbar-text" style="color: white;">welcome - <a href="../profile.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                    <?php echo $row['userEmail']; ?> <i class="caret"></i></a>
            <form>
                <button formaction="crafting.php">Back</button>
            </form>





            <?php
            $stmt = $user_home->runQuery("SELECT title, message, starter FROM topics3 WHERE id = :id");
            $stmt->execute([
                ':id'=>$_GET['rowid'],
            ]);
            $rows = $stmt->fetchAll();
            echo '<pre>';
            print_r($rowid = $_GET['rowid']);
            $stmt = $user_home->runQuery("SELECT title, message, starter FROM topics3 WHERE ID=:ID");
            foreach ($rows as $row){;
                $newtitle = wordwrap($row ['title'], 120);
                echo '<span style = "color: #ff0000"> <h3> By ' . $row ['starter'] . ' </h3> </span>';
                echo '<span style = "color: #ff0000"> <h2> ' . $newtitle . ' </h2> </span>';
                $newtext = wordwrap($row ['message'], 120, "<br />\n");
                echo '<span style = "color: #ff0000"> ' . $newtext . '  </span>';

            }


            ?>

            <hr>

            <form method="post">
                <h2 style="color: white">Comments</h2>
                <?php
                print " <textarea name='message' maxlength=\"2000\" rows=\"4\" cols=\"50\" onkeyup=\"this.value = this.value.replace(/[&*<>]/g, '')\">" ."</textarea>";
                ?>
                <button action="window.location.reload()" name="sumbit" type="submit" id="ta" data-submit="...Sending">Submit</button>
            </form>


            <script>  var ta = document.getElementById("ta");
                ta.addEventListener(
                    'keypress',
                    function (e) {
                        // Test for the key codes you want to filter out.
                        if (e.keyCode == 60) {
                            alert('No "<"!');
                            // Prevent the default event action (adding the
                            // character to the textarea).
                            e.preventDefault();
                        }
                    }
                ); </script>

            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST')       {

                echo "<meta http-equiv='refresh' content='0'>";

            }{

                try {
                    error_reporting(0);
                    $message = $_POST[ 'message' ];
                    $sql = "INSERT INTO replies ( 
            message, username, topicid ) 
            VALUES ( 
            :message, :username, :topicid )";
                    if($user_home->is_logged_in()) {
                        $username = $_SESSION['username'];
                        $topicid = $rowid = $_GET['rowid'];
                        $stmt = $user_home->runQuery($sql);
                        $stmt->execute( array(':message'=>$message, ':username' => $username, ':topicid'=>$topicid) );
                    };
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
            }

            $stmt = $user_home->runQuery("SELECT topicid, username, message FROM replies WHERE topicid = :idrow");
            $stmt->execute([
                ':idrow' =>$_GET['rowid']
            ]);
            $rowidc = $stmt->fetchAll();
            echo '<pre>';
            foreach ($rowidc as $rowz){
                $newtitless = wordwrap($rowz ['username'], 120);
                $newtitles = wordwrap($rowz ['message'], 120);
                echo '<hr>';
                echo '<div class="message" style="background-color: black; height: auto; width: auto"</div>
                <h3 style = "color: #ff0000;"> Reply by ' . $newtitless . ' </h3> 
                <h4 style = "color: #ff0000;"> ' . $newtitles . ' </h4> 
                <hr>';}
            ?>
        </div>
    </div>
</div>
</body>
</html>