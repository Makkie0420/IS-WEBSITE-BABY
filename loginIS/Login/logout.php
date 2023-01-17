<?php
require '../includes/db.php';
session_start();
$update = mysqli_query($conn, "UPDATE regis2 SET status = 0 WHERE register_id=".$_SESSION['id'].";");
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
header("Location:index.html");
?>