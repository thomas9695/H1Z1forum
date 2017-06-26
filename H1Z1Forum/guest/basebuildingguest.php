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


            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "table_users";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT starter, title, message, id FROM topics";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {

                    echo
                    "
                         
                          
                ";



                }
            } else {
                echo "0 results";

            }



            ?>





            <table>
                <thead align="center" style="display: ">
                <tr>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($result as $rows) :?>
                <rd class="item_row">

                    <td><?php echo $rows->result; ?></td>
                    <a class="formtitellink" href="forumguest.php?rowid=<?= $rows['id'] ?>">  <?php echo '<h3>' .  $rows['title'] . '</h3></a><hr>' ?>
                        <?php endforeach; ?>
                </rd>
                </tbody>
            </table>



        </div>
    </div>

</div>






</body>
</html>