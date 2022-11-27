<?php


 include 'config.php';
session_start();
$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id))
{
    header('location:admin_log.php');

}

if(isset($_POST['update_status']))
{

    
    $del_time_status = $_POST['deltime'];
    $pay_status=$_POST['pay_state'];
    $order_id=$_POST['oid'];


    mysqli_query($conn,"UPDATE `orders` SET delivery_Time='$del_time_status' , payment_status='$pay_status' WHERE id='$order_id'") or die('query failed');


    
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
<body id="adminobody">


<?php include 'adminheader.php'; ?>


<section id="adorders">



    <form action="" method="post">

    <div id="up_records">

    <input id="cus_id" type="number" name="oid" placeholder="Enter customer Id" >
   
            <label id="st"> Select Estimate delivery time:</label>

             <select id="payment_options"  name="deltime">
             <option ></option>

            <option value="15 minutes">15 minutes</option>
            <option value="30 minutes">30 minutes</option>
            <option value="45 minutes">45 minutes</option>
            <option value="deliverd">deliverd</option>

            
            
            </select>

             <label id="st"> Select payment status:</label>
             <select id="payment_options" name="pay_state">

                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
             </select>
        

    
            <input type="submit" value="Update Status" name="update_status" id="supdate">

      </div>
        
    </form>



    <div id="adiv"> <h1> Customer Orders</h1>
    </div>



    <div id="ordertab">

    <table>

    <tr>
                 
                  <th scope="row">Id</th>
                 <th scope="row">Name</th>
                 <th scope="row">Phone</th>
                 <th scope="row">Email</th>
                 <th scope="row">Address</th>
                 <th scope="row">Poduct</th>
                 <th scope="row">Price</th>
                 <th scope="row">Delivery Time</th>
                 <th scope="row">payment status</th>
                </tr>


    <?php  
  
      $select_orders=mysqli_query($conn,"SELECT * FROM `orders`") or die("query failed");

if(mysqli_num_rows($select_orders)>0)
{
    while($fetch_order = mysqli_fetch_assoc($select_orders))
    {

      

    ?>

        
                

                <tr>
                <td id="tid"><?php echo $fetch_order['id']; ?></td>
                 <td><?php echo $fetch_order['name']; ?></td>
                <td><?php echo $fetch_order['phone']; ?></td>
                <td><?php echo $fetch_order['email']; ?></td>
                <td><?php echo $fetch_order['address']; ?></td>
                <td><?php echo $fetch_order['total_products']; ?></td>
                <td id="tprice"><?php echo $fetch_order['total_price']; ?></td>
                <td><?php echo $fetch_order['delivery_Time']; ?></td>

                <td><?php echo $fetch_order['payment_status']; ?></td>




               
               
                </tr>

                
           

            <?php 
    }
}
?>
 </table>

    </div>


</body>
</html>