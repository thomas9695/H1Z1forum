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
<html>
<head>
    <title></title>
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/custom.css" rel="stylesheet" media="screen">
</head>
<body>



<div class="container">
    <style type="text/css">
        body { background-image: url("https://www.onlinekeystore.com/images/D/ss_8986a739111572a240d727def562854a027aeac3.1920x1080.jpg") !important;}
    </style>
    <form id="contact" action="" method="post">
        <h3>Start topic</h3>
        <h4>Survival</h4>
        <fieldset>
            <input name="title" placeholder="Title" type="text" tabindex="4" maxlength="50" required>
        </fieldset>
        <fieldset>
            <textarea maxlength="10000" name="message" placeholder="Type your message here...." tabindex="5" required></textarea>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
    </form>
    <form>
        <button formaction="crafting.php">Back</button>
    </form>


    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        try {
            $title = $_POST[ 'title' ];
            $message = $_POST[ 'message' ];



            $sql = "INSERT INTO topics3 ( 
            title, message, starter ) 
            VALUES ( 
            :title, :message, :starter )";

            if($user_home->is_logged_in()) {
                $starter = $_SESSION['username'];
                $stmt = $user_home->runQuery($sql);
                $stmt->execute( array( ':title'=>$title, ':message'=>$message, ':starter' => $starter) );

            };

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    ?>
</div>
</body>