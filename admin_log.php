<?php

include 'config.php';
session_start();

if(isset($_POST['lsubmit'])){

    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $pass=mysqli_real_escape_string($conn,$_POST['password']);

    $select_user=mysqli_query($conn,"SELECT * FROM `admin` WHERE Email_id='$email' AND Password='$pass'")or die('query failed');

    if(mysqli_num_rows($select_user)>0){

        $row=mysqli_fetch_assoc($select_user);



        $_SESSION['admin_name']=$row['Name'];
        $_SESSION['admin_email']=$row['Email_id'];
        $_SESSION['admin_id']=$row['id'];
        header('location:admin_products.php');
       
    }
    else{
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
    <link rel="stylesheet" type="text/css" href="./css/adlog_style.css">
</head>
<body class="adlogbody">

<section class="adlogsec">
    <div class="adloginform">
    <form name="adlogform" method="post">
         <img src="./image/Shanik's -logos__white (1).png" class="adlogoimg"> 

        <input type="email" name="emailid" placeholder="Enter your mail" required class="adloginput1">
        <input type="password" name="password" placeholder="Enter your password" required class="box">
        <input type="submit" name="lsubmit" value="login now" class="adloginbtn">
        <p class="adregp"> <a href="forgotlog.php">forgot password?</a></p>
        <p class="adregr">Don't have an account? <a href="admin_reg.php">Register</a></p>
        
    </form>
    </div>
</section>
    
</body>
</html>