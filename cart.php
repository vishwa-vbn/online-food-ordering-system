

<?php

include 'config.php';

session_start();
$user_id=$_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}


if(isset($_POST['update_cart']))
{
   $Cart_id = $_POST['cart_id'];
   $cart_qnt = $_POST['cart_quantity'];
   mysqli_query($conn,"UPDATE `cart`  SET quantity='$cart_qnt' WHERE id='$Cart_id'") or die('query failed');
   $message[]='cart quantity updated successfully!';
}


if(isset($_GET['delete']))
{
   $Cart_id = $_GET['delete'];
   mysqli_query($conn,"DELETE FROM `cart` WHERE id='$Cart_id' ") or die('query failed');
   
   $message[]='items deleted successfully!';

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">

</head>
<body>

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

<?php include 'header.php'; ?>

<div class="heading">
   <h3 class="cartt">Your Cart</h3>
  
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
   <?php
   global $final_total;
   $final_total=0;

$selected_products=mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id= '$user_id' ") or die('query failed');
if(mysqli_num_rows($selected_products)>0){
    while($fetch_products=mysqli_fetch_assoc($selected_products)){
?>
      
      <div class="box2">
         <a href="cart.php?delete=<?php echo $fetch_products['id']; ?>" class="removebtn" onclick="return confirm('delete this from cart?');">x</a>
           <img  class="pimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
           <div class="name"> <?php echo $fetch_products['name']; ?> </div> 
         <div class="price"><?php  echo $fetch_products['price'];?>/-Rs</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value=" <?php echo $fetch_products['id']; ?>">
            <input class="qty" type="number" min="1" name="cart_quantity" value=" <?php echo $fetch_products['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="update-btn">
         </form>
         <div class="sub-total">total : <span> <?php echo $subtotal= ( $fetch_products['quantity']* $fetch_products['price']); ?>  /-</span> </div>
      </div>
      <?php
         $final_total += $subtotal;
            }
        }
        else{
            echo '<p class="empty"><span> no food products added yet</span></p>';
        }
        ?>
      
       
      
      
   </div>

   <div class="deletediv">
      <a class="deletelink <?php  echo ($final_total>1)?'':'disabled';?> "  href="cart.php?delete_all"  onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <section class="cart-total">
      <p class="totalp">Total Price :<span><?php echo $final_total; ?> /-</span> </p>
      <div class="flex">
         <a href="shop.php" class="opt-btn">continue shopping</a> 
      <?php

if($final_total >0){
 {
      echo '
         <a href="proceedorder.php"  id="btnshp" class="btnshop"   >proceed to checkout</a>
        
      ';
   }
}
      
       ?>


      </div>
      </section>

</section>
<script src="./js/user_script.js"></script>


</body>
</html>