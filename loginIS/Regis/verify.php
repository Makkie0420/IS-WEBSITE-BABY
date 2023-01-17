<?php
require '../includes/db.php';
if(!empty($_SESSION["id"])){
  header("Location:index.html");
}
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["pwd"];
  $confirmpassword = $_POST["c_pwd"];
  $duplicate = mysqli_query($conn, "SELECT * FROM regis2 WHERE name = '$name' OR email = '$email'");
  if(mysqli_num_rows($duplicate) > 0){
        ?>  
        <script language="javascript">
        alert("Email is already in use, please use a different one");
        location.href = "index.html";
        </script>
        <?php
  }
  else{
    if($password == $confirmpassword){
      $query = "INSERT INTO regis2 VALUES('','$name','$email','$password','0')";
      mysqli_query($conn, $query);
        ?>  
        <script language="javascript">
        alert("Successfully registered");
        location.href = "../Login/index.html";
        </script>
        <?php
    }
    else{
        ?>  
        <script language="javascript">
        alert("Password does not match!");
        location.href = "index.html";
        </script>
        <?php
    }
  }
?>