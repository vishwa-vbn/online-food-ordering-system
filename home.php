

<?php
include 'config.php';
session_start();
$user_id=$_SESSION['user_id'];



if(!isset($user_id))
{
  header('location:login.php');

}
if(isset($_POST['addtocart']))
{

  $f_name=$_POST['food_name'];
  $f_price=$_POST['food_price'];
  $f_image=$_POST['food_image'];
  $f_qunty=$_POST['food_quantity'];




$cart_number=mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$f_name' AND user_id= '$user_id' ") or die('query failed');

if(mysqli_num_rows($cart_number)>0){

  $message[]='alredy exist in cart!';


}else
{
  mysqli_query($conn,"INSERT INTO `cart` (user_id,name,price,quantity,image) VALUES('$user_id','$f_name','$f_price','$f_qunty','$f_image')") or die('query failed');
 $message[]='Added To The Cart!';
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
    <link rel="stylesheet" href="./css/home.css">
   




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
  

    <section  >
      <div id="imagediv" style="background: url('./image/img/pexels-ella-olsson-1640774.jpg');  background-repeat: no-repeat;
    width:auto;
    height:400px;
    z-index:-1;
    opacity: 0.9;
    background-size: 100%;
    margin-top: 60px;
    border-radius: 5px;
    margin-left: 1px;
    box-shadow: 0px 8px 16px 8px rgba(139, 137, 139, 0.6);
    background-position:  bottom ;
    " >

    <div class="tit">
       <h1>Order Tasty & <br/> Freshfood </h1>
        <h2>AnyTime!</h2>
       
      </div>
         </div>
     
      
      
      
    </section>

    <section id="cat">
   <div id="cat2">
    <p id="cattitle">Categories </p>    
    <p id="cattitle2">Choose a category to view all products</p>
   </div>
    </section>
 



    
    
    <form  method="post"  >
    <section id="category">
    


    
    


     <div class="gallery">

     <input  class="a " type="submit"  name="veg_food"  value="Vegitarian"  onclick="scrollscreen()" >
      <img   id="catimg" src="./image/carrots.png" alt="carrot" >
   
     
      
    
    </div>
    
    <div class="gallery">
      
    <input  class="a" type="submit"  name="non_veg_food"  value="Non-Veg" onclick="scrollscreen()" >
        <img   id="catimg"src="./image/fried-chicken.png"alt="biriyani" >
      </a>
    
    </div>
    
    <div class="gallery">
      
   <input  class="a" type="submit"  name="Starters"  value="Starters"  onclick="scrollscreen()">
        <img id="catimg" src="./image/starter.png" alt="coke cola" >
      </a>
      
    </div>

    <div class="gallery">
      
   <input  class="a" type="submit"  name="Beverages"  value="Beverages" onclick="scrollscreen()" >


    
        <img id="catimg" src="./image/juices.png" alt="coke cola" >
      </a>
      
    </div>

    <div class="gallery">
      
      <a  href="./food.php">View All Products </a>
      
    </div>

    

    </section>

    </form>

   
   
    <section class="show_products">



<div class="box-container2" >

    <?php

    if(isset($_POST['veg_food']))
    {

        $selected_products=mysqli_query($conn, "SELECT * FROM `products` WHERE category ='Veg' ") or die('query failed');
        if(mysqli_num_rows($selected_products)>0){
            while($fetch_products=mysqli_fetch_assoc($selected_products)){
              global $iname;

              $iname=$fetch_products['name'];
        ?>



           

   

<div class="box1"  >
          <form action="" method="post"  >
               <img  class="oimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>"  alt="">
               <div class="iname"> <?php echo $fetch_products['name']; ?> </div> 
             <div class="iprice"><?php  echo $fetch_products['price'];?>/-Rs</div>
             <input class="rng" type="number" min="1"  name="food_quantity" value="1" class="qanty">
              <input type="hidden" name="food_name" value="<?php echo $fetch_products['name']; ?>">
              <input type="hidden" name="food_price" value="<?php echo $fetch_products['price']; ?> ">
              <input type="hidden" name="food_image" value="<?php echo $fetch_products['image']; ?>">
              <input  type="submit" value="add to cart" name="addtocart"  class="cartbtn">
              <button type="button"  id="lrev" name="rbtn"  value="<?php echo $iname ?>" onclick="reviewitem(this)" >check review</button>


          </form>
   </div>
 

<?php
            }
          }

          }

         
          ?>

</div>




<div class="box-container2" >

    <?php

    if(isset($_POST['non_veg_food']))
    {

        $selected_products=mysqli_query($conn, "SELECT * FROM `products` WHERE category ='Nonveg' ") or die('query failed');
        if(mysqli_num_rows($selected_products)>0){
            while($fetch_products=mysqli_fetch_assoc($selected_products)){
              global $iname;

              $iname=$fetch_products['name'];
        ?>



           

   

<div class="box1"  >
          <form action="" method="post"  >
               <img  class="oimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>"  alt="">
               <div class="iname"> <?php echo $fetch_products['name']; ?> </div> 
             <div class="iprice"><?php  echo $fetch_products['price'];?>/-Rs</div>
             <input class="rng" type="number" min="1"  name="food_quantity" value="1" class="qanty">
              <input type="hidden" name="food_name" value="<?php echo $fetch_products['name']; ?>">
              <input type="hidden" name="food_price" value="<?php echo $fetch_products['price']; ?> ">
              <input type="hidden" name="food_image" value="<?php echo $fetch_products['image']; ?>">
              <input  type="submit" value="add to cart" name="addtocart"  class="cartbtn">
              <button type="button"  id="lrev" name="rbtn"  value="<?php echo $iname ?>" onclick="reviewitem(this)" >check review</button>


          </form>
   </div>
 

<?php
            }
          }

          }

         
          ?>

</div>





<?php

if(isset($_POST['Starters']))
{

    $selected_products=mysqli_query($conn, "SELECT * FROM `products` WHERE category ='Starters' ") or die('query failed');
    if(mysqli_num_rows($selected_products)>0){
        while($fetch_products=mysqli_fetch_assoc($selected_products)){
          global $iname;

          $iname=$fetch_products['name'];
    ?>



       



<div class="box1"  >
      <form action="" method="post"  >
           <img  class="oimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>"  alt="">
           <div class="iname"> <?php echo $fetch_products['name']; ?> </div> 
         <div class="iprice"><?php  echo $fetch_products['price'];?>/-Rs</div>
         <input class="rng" type="number" min="1"  name="food_quantity" value="1" class="qanty">
          <input type="hidden" name="food_name" value="<?php echo $fetch_products['name']; ?>">
          <input type="hidden" name="food_price" value="<?php echo $fetch_products['price']; ?> ">
          <input type="hidden" name="food_image" value="<?php echo $fetch_products['image']; ?>">
          <input  type="submit" value="add to cart" name="addtocart"  class="cartbtn">
          <button type="button"  id="lrev" name="rbtn"  value="<?php echo $iname ?>" onclick="reviewitem(this)" >check review</button>


      </form>
</div>


<?php
        }
      }

      }

     
      ?>

</div>





<?php

if(isset($_POST['Beverages']))
{

    $selected_products=mysqli_query($conn, "SELECT * FROM `products` WHERE category ='Beverages' ") or die('query failed');
    if(mysqli_num_rows($selected_products)>0){
        while($fetch_products=mysqli_fetch_assoc($selected_products)){
          global $iname;

          $iname=$fetch_products['name'];
    ?>



       



<div class="box1"  >
      <form action="" method="post"  >
           <img  class="oimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>"  alt="">
           <div class="iname"> <?php echo $fetch_products['name']; ?> </div> 
         <div class="iprice"><?php  echo $fetch_products['price'];?>/-Rs</div>
         <input class="rng" type="number" min="1"  name="food_quantity" value="1" class="qanty">
          <input type="hidden" name="food_name" value="<?php echo $fetch_products['name']; ?>">
          <input type="hidden" name="food_price" value="<?php echo $fetch_products['price']; ?> ">
          <input type="hidden" name="food_image" value="<?php echo $fetch_products['image']; ?>">
          <input  type="submit" value="add to cart" name="addtocart"  class="cartbtn">
          <button type="button"  id="lrev" name="rbtn"  value="<?php echo $iname ?>" onclick="reviewitem(this)" >check review</button>


      </form>
</div>


<?php
        }
      }

      }

     
      ?>

</div>





<?php

if(isset($_POST['non_veg_food']))
{

    $selected_products=mysqli_query($conn, "SELECT * FROM `products` WHERE category ='Nonveg' ") or die('query failed');
    if(mysqli_num_rows($selected_products)>0){
        while($fetch_products=mysqli_fetch_assoc($selected_products)){
          global $iname;

          $iname=$fetch_products['name'];
    ?>



       



<div class="box1"  >
      <form action="" method="post"  >
           <img  class="oimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>"  alt="">
           <div class="iname"> <?php echo $fetch_products['name']; ?> </div> 
         <div class="iprice"><?php  echo $fetch_products['price'];?>/-Rs</div>
         <input class="rng" type="number" min="1"  name="food_quantity" value="1" class="qanty">
          <input type="hidden" name="food_name" value="<?php echo $fetch_products['name']; ?>">
          <input type="hidden" name="food_price" value="<?php echo $fetch_products['price']; ?> ">
          <input type="hidden" name="food_image" value="<?php echo $fetch_products['image']; ?>">
          <input  type="submit" value="add to cart" name="addtocart"  class="cartbtn">
          <button type="button"  id="lrev" name="rbtn"  value="<?php echo $iname ?>" onclick="reviewitem(this)" >check review</button>


      </form>
</div>


<?php
        }
      }

      }

     
      ?>

</div>
    </section>

    <!-- <section id="footer">

<h1 id="copyhead"> CopyRight C2022 Shanik's</h1>

    </section> 
 -->

       
    <section id='urev'>

    <form action="" method="post">

        <input type="hidden" id="hinput" name="hname">
       <div id="ce-div"> <input type="submit" id="v_btn" name="view_btn" value="View Reviews"> </div>
      </form>

      <div id="rev_sec">

    <?php
    

if(isset($_POST['view_btn']))
{

  $h_name= $_POST['hname'];

    $selected_p=mysqli_query($conn, "SELECT * FROM `reviews` WHERE food_name ='$h_name' ") or die('query failed');
    if(mysqli_num_rows($selected_p)>0){
        while($fetch_p=mysqli_fetch_assoc($selected_p)){


     

     $ur_id= $fetch_p['user_id'];
     $selected_product= mysqli_query($conn,"SELECT * FROM `customer` WHERE id='$ur_id' ") or die('query failed');

     if(mysqli_num_rows($selected_product)>0){
      while($fetch_product=mysqli_fetch_assoc($selected_product)){
     

    
    ?>


        <div id="flex_box" >
         
        <div id="i_flex">
        <img id="user_logo" src="./image/user (1).png">
        </div>

        <div id="n_flex">
          <div id="user_name"> <h4> <?php echo $fetch_product['Name']; ?></h4></div>
      </div>
        </div>

          <div id="r_messages"> <h3> <?php echo $fetch_p['review'] ?> </h3> </div>
     
    <?php 
        }}
      }}
}

      ?>



 
</div>
    </section>


    <script src="./js/user_script.js"></script>
  
    
</body>
</html>