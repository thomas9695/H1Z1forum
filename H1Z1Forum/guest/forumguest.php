<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();


$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>forum</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="../styles/css/bb.css" type="text/css" />
</head>
<body>

<div>



    <div id="main">
        <div class="form" style="width:300px; margin-right:130px; margin-left:auto; margin-bottom: 10px;">
            <form action="../index.php" method="post">
                <input type="submit" value = "Sign in/Register">
            </form>
        </div>

        <div class="container">
            <div class="logo">
                <img src="../styles/pictures/logo.png">
            </div>
            <p class="navbar-text" style="color: white;">welcome - <a href="../profile.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                    <?php echo $row['userEmail']; ?> <i class="caret"></i></a>




                <?php
                $stmt = $user_home->runQuery("SELECT title, message, starter FROM topics WHERE id = :id");
                $stmt->execute([
                    ':id'=>$_GET['rowid'],
                ]);
                $rows = $stmt->fetchAll();
                echo '<pre>';
                print_r($rowid = $_GET['rowid']);
                $stmt = $user_home->runQuery("SELECT title, message, starter FROM topics WHERE ID=:ID");
                foreach ($rows as $row){;
                    $newtitle = wordwrap($row ['title'], 120);
                    echo '<span style = "color: #ff0000"> <h3> ' . $newtitle . ' </h3> </span>';
                    $newtext = wordwrap($row ['message'], 120, "<br />\n");
                    echo '<span style = "color: #ff0000"> ' . $newtext . '  </span>';

                }


                ?>

            <hr>




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
                echo '<h3 style = "color: #ff0000"> Reply by ' . $newtitless . ' </h3> ';
                echo '<h4 style = "color: #ff0000"> ' . $newtitles . ' </h4> ';
                echo '<hr>';}
            ?>
        </div>
    </div>
</div>
</body>
</html>