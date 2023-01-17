<?php
require '../includes/db.php';
session_start();
if(!empty($_SESSION["id"])){
  header("Location:index.php");
}
  $usernameemail = $_POST["username_email"];
  $password = $_POST["pwd"];
  $result = mysqli_query($conn, "SELECT * FROM regis2 WHERE name = '$usernameemail' OR email = '$usernameemail'");
  $result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usernameemail' AND password = '$password'");
  $row2 = mysqli_fetch_assoc($result2);
  if(mysqli_num_rows($result2) > 0){
    if($password == $row2['password']){
        $_SESSION['id'] = $row2['users_id'];
        $_SESSION["name"] = $row2['username'];
        $_SESSION["login"] = true;
        header("Location: Admin-UI/index.html");
    }
  }
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
        $_SESSION['id'] = $row['register_id'];
        $_SESSION["name"] = $row['email'];
        $_SESSION["login"] = true;
        if (isset($_SESSION['id'])){
            $update = mysqli_query($conn, "UPDATE regis2 SET status = 1 WHERE register_id=".$_SESSION['id'].";");
        }
        header("Location: Customer-UI/home.html");
    }
    else{
        ?>  
        <script language="javascript">
        alert("Error: Password mismatch");
        location.href = "index.html";
        </script>
        <?php
    }
  }
  else{
    ?>  
        <script language="javascript">
        alert("Error: username not registered, please register");
        location.href = "index.html";
        </script>
        <?php
  }
?>