<?php

include 'config.php';
session_start();
// $admin_id=$_SESSION['admin_id'];

if(isset($_POST['addbtn']))
{
    $name=mysqli_real_escape_string($conn,$_POST['iname']);
    $qnty=$_POST['iqnty'];

    $select_item_name=mysqli_query($conn,"SELECT * FROM `inventory`  WHERE iname='$name' ") or die('query failed');

    if(mysqli_num_rows($select_item_name) > 0)
    {
        $message[]='item already exist';
    }
    else
    {
        $add_query=mysqli_query($conn,"INSERT INTO `inventory`(iname,iqnty)VALUES('$name','$qnty')") or die('query failed');
    
        $message[]='item added successfully';
    }

}

if(isset($_POST['delbtn']))
{
    $dname=$_POST['iname'];

   mysqli_query($conn,"DELETE FROM `inventory` WHERE iname='$dname'")or die('query failed');
    header('location:inventory.php');
}


global $pqnty;
global $uiname;
global $piname;
if(isset($_POST['iname']))
{
    $item__name= $_POST['iname'];
        $select_item=mysqli_query($conn,"SELECT * FROM `inventory` WHERE iname='$item__name'") or die('query failed');
    if(mysqli_num_rows($select_item)>0)
    {
        while($fetch_item=mysqli_fetch_assoc($select_item)){
            
            $piname=$fetch_item['iname'];
       $pqnty= $fetch_item['iqnty'];
        }
    }


    if(isset($_POST['upbtn']))
    {
        $name=mysqli_real_escape_string($conn,$_POST['iname']);
        $qnty=$_POST['iqnty'];


        mysqli_query($conn,"UPDATE `inventory` SET iqnty='$qnty' WHERE iname='$name'") or die('query failed');
    }



      



}




if(isset($_POST['upitem']))
{
$iprice=0;
    $random_num=rand(10,100);
    $supli_id=mysqli_real_escape_string($conn,$_POST['sup_id']);
    $updat_item=mysqli_real_escape_string($conn,$_POST['up_name']);
    $updat_qnty=mysqli_real_escape_string($conn,$_POST['iupqnty']);

$iprice= $updat_qnty * $random_num;
   
    mysqli_query($conn,"INSERT INTO `reorder`(sup_id,item_name,item_qnty,price)VALUES('$supli_id','$updat_item','   $updat_qnty','$iprice')") or die('query failed');
    
        $message[]='ordered successfully';
    



}

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/inventory_style.css">
    <link rel="stylesheet" href="adstyle.css">
</head>
<body>
<?php include 'adminheader.php'; ?>
    <section id="inventory">
        <div class="invent-box">
            <h1>Add Grocery</h1>
            <form action="" id="iform" method="post">
                <div class="invent">
                <input type="text"  id="finput" name="iname" placeholder="Enter item name"  autofocus value="<?php echo $piname ?>">
                <input type="number" id="fqnty" name="iqnty" placeholder="Enter quantity"  value="<?php echo $pqnty ?>">
               
               <div id="gbuttons">
                <input type="submit" id="add" value="Add" name="addbtn">
                <input type="submit" id="delete" value="Delete" name="delbtn"> 
                <input type="submit" id="add"  value="Update" name="upbtn">
                <input type="submit" id="delete"  value="Reorder" name="reorderbtn"> 

               </div>
                </div>
            </form>
        </div>

    </section>

    <section class="show_inventory">

    <h3 id="itembox">Added Item</h3>
    <div class="box-stock">

 

    <table border="1px">
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Quantity</th>


        </tr>
        <?php
        
        
        

        $select_item=mysqli_query($conn,"SELECT * FROM `inventory`") or die('query failed');
        if(mysqli_num_rows($select_item)>0)
        {
            while($fetch_item=mysqli_fetch_assoc($select_item)){
         ?>
           

            <tr>
                
            <td><?php echo $fetch_item['id'];?></td>
            <td><?php echo $fetch_item['iname'];?></td>
            <td><?php echo $fetch_item['iqnty'];?></td>
            </tr>


            
            <?php
               
            }
        }
    
   
        ?>



        </table>
         
    </div>
    </section>


    <section class="inventory_orders">

<h3 id="itembox">Your Orders</h3>
<div class="box-stock">



<table border="1px">
    <tr>
        

        <th>No</th>
            <th>Supplier_id</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Bill</th>



    </tr>
    <?php
    
    
    

    $select_item=mysqli_query($conn,"SELECT * FROM `reorder`") or die('query failed');
    if(mysqli_num_rows($select_item)>0)
    {
        while($fetch_item=mysqli_fetch_assoc($select_item)){
     ?>
       

        <tr>
           



            <td><?php echo $fetch_item['id'];?></td>
                <td><?php echo $fetch_item['sup_id'];?></td>
                <td><?php echo $fetch_item['item_name'];?></td>
                <td><?php echo $fetch_item['item_qnty'];?></td>
                <td><?php echo $fetch_item['price'];?></td>
       <td>  <a href="printindex.php?printid=<?php echo $fetch_item['id']; ?>" >Print</a> </td>
                


        </tr>


        
        <?php
           
        }
    }


    ?>



    </table>
     
</div>
</section>


    
<section class="reordersec">



<?php

if(isset($_POST['reorderbtn']))
{

?>

<form  id="upfom" method="post" >
      <input type="text" name="sup_id" placeholder="Enter supplier Id">

      <input type="text" name="up_name"   required placeholder="enter product name">
      <input type="number" name="iupqnty"  min="1"  required placeholder="enter product quantity">
      <input type="submit" value="update" name="upitem" id="upitembtn">
      <input type="reset" value="cancel"  id="can_btn">
   </form>




   <?php
}


else{
echo '<script> document.querySelector(".reordersec").style.display = "none"; </script>';
}
?>

</section>





<script src="./js/admin.js"></script>

</body>
</html>