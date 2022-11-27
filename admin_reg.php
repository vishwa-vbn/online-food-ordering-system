<?php

include 'config.php';

if(isset($_POST['submit']))
{
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['emailid']);
    $passw=mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassw=mysqli_real_escape_string($conn,$_POST['cpass']);
    


    $select_user=mysqli_query($conn, "SELECT * FROM `admin` WHERE Email_id='$email' AND Password='$passw' ")or die('query failed');

    if(mysqli_num_rows($select_user)>0){
        $message[]='User alraedy exist';
    }
    else{

        if($passw!=$cpassw){
            $message[]='Enter the password correctly!' ;
        }
        else{
            mysqli_query($conn,"INSERT INTO `admin` (Name,Email_id,Password) VALUES ('$name','$email','$passw')") or die('query failed');

            $message[]='registered successfully!';
            header('location:login.php');
        }
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
    <link rel="stylesheet" href="css/adreg_style.css">
   
</head>
<body id="adregbody">

<section>
    <form name="admform" id="adregform" method="post" onsubmit="return validateform()">
    
    <div class="admdiv">
        <h1>Admin Register</h1>
      
        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter your name" id="name"><br/>

        <label>Email:</label> 
        <input type="email" name="emailid" placeholder="Enter your email"><br/>
       
        <label>Password:</label>   
        <input type="password" name="pass" placeholder="Enter Password"><br/>
        
        <label>Confirm Password:</label>  
        <input type="password" name="cpass" placeholder="confirm password"><br/>
        
        <input type="submit" id="sbtn" name="submit">
        <p class="have">already have an account?    
        <a href="login.php">login now</a></p>
    </div>
</form>
</section>

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
  <script src="./js/user.js"></script>  
</body>
</html>