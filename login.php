<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['emailid']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select_users = mysqli_query($conn, "SELECT * FROM `customer` WHERE Email_id = '$email' AND Password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

     


         $_SESSION['user_name'] = $row['Name'];
         $_SESSION['user_email'] = $row['Email_id'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }
      else

   {
      $message[] = 'incorrect email or password!';
   }


}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/logstyle.css">

</head>
<body class="logbody"  >



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="RICON" onclick="this.parentElement.remove();">X</i>
      </div>
      ';
   }
}
?>

    <section class="logsec">

        <div class="loginform">

             <!-- <div class="form-container"> -->

                <form name="logform"  method="post">
                    
                <img src="./image/Shanik's -logos__white (1).png" class="logoimg">
                    
                     <input  type="email" name="emailid" placeholder="enter your email" required class="loginput1">
                     <input type="password" name="password" placeholder="enter your password" required class="box">
                       <input type="submit" name="submit" value="login now" class="loginbtn">
                       <p class="regp"> <a href="forgotlog.php">forgot password?</a></p>
                        <p class="regr">don't have an account? <a href="register.php">Register</a></p>
                 </form>

             <!-- </div> -->

            <!-- <p class="regp">
            <a href="register.php">Register</a>
            </p> -->
        </div>
    </section>
    
</body>
</html>