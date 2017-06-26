<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();



$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");

$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>forum</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="../styles/css/main.css" type="text/css" />
</head>
<body>

<div>
    <img class="resize" src="">



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
            <p class="navbar-text" style="color: white;">welcome - Guest <a href="../profile.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                    <?php echo $row['userEmail']; ?> <i class="caret"></i>

            <p class="navbar-text" style="color: white;"> <a href="basebuildingguest.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                    base building <i class="caret"></i>
                    <label></label>

        </div>
    </div>
</div>
</body>
</html>