<?php

include 'config.php';

session_start();

$admin_id=$_SESSION['admin_id'];


if(isset($_POST['add_product']))
{
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $price=$_POST['price'];
    $cat=$_POST['category'];
   $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;


    $select_product_name = mysqli_query($conn,"SELECT name FROM   `products` WHERE name='$name' ") or die('query failed');

    if(mysqli_num_rows($select_product_name)  > 0){

        $message[]='product name already exist';
    }
    else
    {
        $add_query=mysqli_query($conn,"INSERT INTO `products`(name,price,category,image)VALUES('$name', '$price', '$cat', '$image') ") or die('query failed');

        move_uploaded_file($image_tmp_name,$image_folder);
        $message[]='product added successfully';

    }


    }




    if(isset($_POST['update_product'])){

        $update_p_id = $_POST['update_p_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
     
        mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');
     
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        // $update_image_size = $_FILES['update_image']['size'];
        $update_folder = 'uploaded_img/'.$update_image;
        $update_old_image = $_POST['update_old_image'];
     
        if(!empty($update_image)){
           // if($update_image_size > 2000000){
              // $message[] = 'image file size is too large';
           // }else{
              mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
              move_uploaded_file($update_image_tmp_name, $update_folder);
              unlink('uploaded_img/'.$update_old_image);
           
        }
     
         header('location:admin_products.php');
     
     }

    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $delete_image_query=mysqli_query($conn,"SELECT image FROM `products` WHERE id= '$delete_id' ") or die('query faied');
        $deleted_image=mysqli_fetch_assoc( $delete_image_query);
        unlink('uploaded_img/'.$deleted_image['image']);
        mysqli_query($conn,"DELETE FROM `products` WHERE id='$delete_id'")or die('query failed');
        header('location:admin_products.php');


    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/adminstyle.css">
</head>


<body class="ppage" >


<?php include 'adminheader.php'; ?>
<section class="add_products">
    <div class="add_box">

<!-- <h1 class="title" >Food Products<h1> -->
    <form action="" method="post"  enctype="multipart/form-data">
        <h3>Add Products</h3>
        <input type="text" name="name" class="namebox" placeholder="Enter food name" Required>
        <input type="number" min="0" name="price" class="namebox" placeholder="Enter food price" required>
    <select name="category" class="boxselect">
         <option value="Veg">Veg</option>
         <option value="NOnveg">Nonveg</option>
         <option value="Beverages">Beverages</option>
         <option value="Starters">Starters</option>
      </select>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="boxfile" required>
      <input type="submit" value="Add" name="add_product" class="btn">
</form>

</div>
</section>

<section class="show_products">

<h1 id="foodbox">Added Food Products</h1>

    <div class="box-container">
        <?php

        $selected_products=mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
        if(mysqli_num_rows($selected_products)>0){
            while($fetch_products=mysqli_fetch_assoc($selected_products)){
        ?>

        <div class="box1">
           
           <img  class="pimage"  src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
        <div class="name"> <?php echo $fetch_products['name']; ?> </div> 
         <div class="price"><?php  echo $fetch_products['price'];?>/-Rs</div>
           <div class="deletebtn"><a id="delete" href="admin_products.php? delete=<?php echo $fetch_products['id']; ?> "class="option-btn"> delete</a></div>       
           <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="update-btn">update</a>
        
        </div>
        <?php
            }
        }
        else{
            echo '<p class="empty"><span> no food products added yet</span></p>';
        }
        ?>

</section>

<section class="updatepsec">


<?php
if(isset($_GET['update']))
{

    $update_id=$_GET['update'];
    $update_products= mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
if(mysqli_num_rows($update_products)>0)
{

    while($fetch_up=mysqli_fetch_assoc($update_products))
    {

    
?>


<form  id="upfom" method="post" enctype="multipart/form-data">
      <input type="hidden" name="up_id" value="<?php echo $fetch_up['id']; ?>">
      <input type="hidden" name="up_o_image" value="<?php echo $fetch_up['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_up['image']; ?>" alt="">
      <input type="text" name="up_name" value="<?php echo $fetch_up['name']; ?>"  required placeholder="enter product name">
      <input type="number" name="up_price" value="<?php echo $fetch_up['price']; ?>" min="1"  required placeholder="enter product price">
      <input type="file" class="box" name="up_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" id="updatebtn">
      <input type="reset" value="cancel"  id="can_btn">
   </form>



<?php
    }
}
}
else{
    echo '<script> document.querySelector(".updatepsec").style.display = "none"; </script>';
}
?>



















</section>




<script src="./js/admin.js"></script>



</body>
</html>