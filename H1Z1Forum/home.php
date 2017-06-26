<?php
session_start();
require_once 'class.user.php';
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
<html>
<head>
    <title>forum</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="styles/css/main.css" type="text/css" />
</head>
<body>

<div>
    <img class="resize" src="">



    <div id="main">
        <div class="form" style="width:300px; margin-right:130px; margin-left:auto; margin-bottom: 10px;">
            <form action="" method="post">
                <input type="submit" value = "Logout" formaction="logout.php?logout=true">
            </form>
        </div>


        <div class="container">
            <div class="logo">
                <img src="styles/pictures/logo.png">

            </div>
            <p class="navbar-text" style="color: white;">welcome - <a href="profile.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                <?php echo $row['userEmail']; ?> <i class="caret"></i> </a></p>

            <div class="java" id="java">
                <h1 style="color: white">Choose a theme</h1>
                  <a href="themebasebuilding/basebuilding.php">  <img src="styles/pictures/forum.jpg" style="text-align:center;" align="middle" href="themebasebuilding/basebuilding.php"></a>
            </div>
            <div class="java" id="java">
                <a href="themecombat/combat.php">  <img src="styles/pictures/combat21.jpg" style="text-align:center;" align="middle" href="combat.php"></a>
            </div>
            <div class="java" id="java">
                <a href="themesurvival/crafting.php">  <img src="styles/pictures/survival.jpg" style="text-align:center;" align="middle" href="crafting.php"></a>
            </div>
        </div>
        </div>
    </div>
</body>
</html>