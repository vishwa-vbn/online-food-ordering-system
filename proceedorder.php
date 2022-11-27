 <?php

include 'config.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}



if(isset($_POST['order_now']))
{

$name= mysqli_real_escape_string($conn, $_POST['Name']);
$pno=$_POST['Phoneno'];
$email= mysqli_real_escape_string($conn,$_POST['Email']);
$address=mysqli_real_escape_string($conn,'flat no. '. $_POST['Address'].' ,'. $_POST['City'].','. $_POST['state'].'-'. $_POST['Pincode']);
$pmethod=mysqli_real_escape_string($conn,$_POST['Payment']);
$DateOfOrder=date('d-M-Y');
$final_total=0;
$cart_items[]='';

$cart_data=mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($cart_data)>0)
{
    while($cart_item= mysqli_fetch_assoc($cart_data))
    {
        $total_products = $cart_item['name'].' ('.$cart_item['quantity'].') ';
        $item_image =$cart_item['image'];
        
        $sub_total=($cart_item['price'] * $cart_item['quantity']);
        $final_total +=$sub_total;

        
   
// $images=implode(',',$item_image);

// $total_products= implode(',',$cart_items);
$order_query= mysqli_query($conn,"SELECT * FROM `orders` WHERE name='$name' And phone='$pno' AND email='$email' AND payment= '$pmethod' AND address='$address' AND  total_products='$total_products' AND total_price='$final_total'") or die('query failed');


    if(mysqli_num_rows($order_query)>0)
    {
        $message[]='order alredy placed';

    }else

    {
        mysqli_query($conn, "INSERT INTO `orders` (user_id,name,phone,email,payment,address, total_products,total_price,dateOforder,image) VALUES('$user_id','$name','$pno','$email','$pmethod','$address','$total_products','$final_total','$DateOfOrder','$item_image')") or die('query failed');
        $message[]="order placed successfully!";
        mysqli_query($conn,"DELETE FROM `cart` WHERE user_id='$user_id'")or die('query failed');
        header('Refresh: 7; URL=http://localhost/online%20food%20order/home.php');

        
    }


}
}
}


if(isset($_POST['update_now']))
{

// $name= mysqli_real_escape_string($conn, $_POST['Name']);
    $pno=$_POST['Phoneno'];
$email= mysqli_real_escape_string($conn,$_POST['Email']);
$address=mysqli_real_escape_string($conn,$_POST['Address']);
$city=mysqli_real_escape_string($conn,$_POST['City']);
$pincode=mysqli_real_escape_string($conn,$_POST['Pincode']);



mysqli_query($conn,"UPDATE `customer` SET  Phone='$pno',Email_id='$email',Address='$address',City='$city', Pincode='$pincode' WHERE  id= '$user_id'") or die('query failed');

$message[]='address updated successfully';


}
?>







 <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <link  rel="stylesheet" href="./css/style2.css"> -->
   <link rel="stylesheet" href="css/style2.css">


   <title>check out</title>

  


</head>

<body >






<!-- <h1>this is messaage section</h1> -->


<?php include 'header.php'; ?>



<section id="usec_bar">

<form action="" class="usearch_bar" method="post">


<input id="sname" type="text" name="Name" id="sname" placeholder=" Enter your email_id">
<input  id="sbtn" type="submit" value="search"  name="searchbtn">
</form>

</section>






<?php
if(isset($_POST['searchbtn']))
{
    $user_Ename=$_POST['Name'];
  

?>





<?php 



    $select_users= mysqli_query($conn,"SELECT * FROM  `customer` WHERE Email_id = '$user_Ename' " ) or('query failed');
    if(mysqli_num_rows($select_users)>0)
    {
    while($fetch_user=mysqli_fetch_assoc($select_users))
    {

    
  
?>




<div class="checkdiv">


   <form action=""  id="sform" method="post">
    <div id="fs_div1">


                  
                  
                 





   <div>
   <lable >Name:</lable> <input type="text" id="Uname" name="Name" placeholder="Enter your name" value=" <?php echo $fetch_user['Name'] ?>">
   <lable >Email:</lable> <input type="email" name="Email" id="uemail"  value="<?php echo $fetch_user['Email_id'] ?>" placeholder="Enter your email">
   <lable >Contact:</lable><input type="tel" id="Uphone" name="Phoneno" placeholder="Enter phone number" minlength="10" maxlength="10" value="<?php echo $fetch_user['Phone'] ?>">
 
    
   <lable  >Address:</lable> <input type="text" name="Address" placeholder="Enter your address" value="<?php echo $fetch_user['Address'] ?>">
   </div>


    </div>

    <div id="fs_div2">
       

    <lable  >City:</lable> <input type="text" name="City" placeholder="e.g silicon city" value="<?php echo $fetch_user['City'] ?>">

    <lable  >Pincde:</lable> <input type="text" name="Pincode" placeholder="e.g 567144" value="<?php echo $fetch_user['Pincode'] ?>">

    
    <lable  >Mode:</lable>  <select id="paymt" name="Payment">

<option value="Cash On Delivery" >Cash On Delivery</option>
<option value="Gpay">Gpay</option>
<option value="paypal">Paypal</option>
<option value="Debit/Credit card">Debit/credit card</option>


</select>

<lable  >State:</lable><input type="text" id="ustate" name="state" placeholder="e.g karnataka">
        
<input type="submit" id="order_btn" name="order_now" value="Order">
<input type="submit" id="addup_btn" name="update_now" value="Update Address">


    </div>


</form> 

<?php
    }
}
else
{
    $message[]='user name does noot exisit';
}

?>







<?php
}
?>








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


</body>

</html>

