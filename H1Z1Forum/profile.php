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
<html lang="en">
<head>
	<link rel="stylesheet" href="styles/css/profile.css" type="text/css">
	<meta charset="UTF-8">
	<title>Website</title>
</head>
<body>



<div>
	<div id="main">
		<div class="form" style="width:300px; margin-right:130px; margin-left:auto; margin-bottom: 10px;">
			<form action="logout.php" method="post">
				<p><input type="submit" value = "Logout">
			</form>

		</div>

		<div class="container">
			<div class="logo">
				<img src="styles/pictures/logo.png">
			</div>


			<p class="navbar-text" style="color: white;">Logged in as <a  role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
					<?php echo $row['userEmail']; ?> <i class="caret"></i>
			<p class="navbar-text" style="color: white;"><a href="home.php"> Go back to the forum </a></p>

			<form action="logoutpass.php" method="post">
				<p><input type="submit" value = "Change password">
			</form>

		</div></div></div>

<div>

</div>



</body>
<footer>
</footer>
</html>

