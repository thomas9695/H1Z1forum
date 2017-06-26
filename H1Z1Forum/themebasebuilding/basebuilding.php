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
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>forum</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="../styles/css/bb.css" type="text/css" />
</head>
<body>

<div>
    <img class="resize" src="">

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
            <strong class="navbar-text" style="color: white;">welcome - ></strong><a href="../profile.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                    <?php echo $row['userEmail']; ?> <i class="caret"></i></a>
            <form action="starttopic.php">
            <input type="submit" value="start new post" href="starttopic.php">
                <button formaction="../home.php">Back</button>
            </form> <hr>


              <?php
                $stmt = $user_home->runQuery("SELECT starter, title, message, id FROM topics");
                $stmt->execute([
                ]);
                $rows = $stmt->fetchAll();
                echo '<pre>';
                         foreach ($rows as $row) :?>
                    <?php echo '<div class="message" style="background-color: black; height: auto; width: auto"</div>
            <h3 style="color: white">By: ' .  $row['starter'] . '</h3></a>'  ?>
            <STYLE>
                <!--
                A{text-decoration:none}
                -->
            </STYLE> <a class="formtitellink" href="forum.php?rowid=<?= $row['id'] ?>">  <?php echo '<h3>' .  $row['title'] . '</h3></a><hr>'  ?>
                    <?php endforeach; ?>

            <table>
                <thead align="center" style="display: ">
                <tr>
                </tr>
                </thead>
                <tbody>

                </rd>




        </div>
    </div>

</div>






</body>
</html>