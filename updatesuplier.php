<?php


include 'config.php';

if(isset($_POST['submit']))
{
    $id=mysqli_real_escape_string($conn,$_POST['supplierid']);
    $name=mysqli_real_escape_string($conn,$_POST['suppliername']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phoneno']);
    $email=mysqli_real_escape_string($conn,$_POST['emailid']);

    

$select_user=mysqli_query($conn, "SELECT  * FROM `supplier` WHERE Email_id='$email'");


if(mysqli_num_rows($select_user) > 0){
    mysqli_query($conn,"UPDATE `supplier` SET Name ='$name',Address ='$address',Phone_no ='$phone' WHERE Email_id ='$email'") or die('query failed');
    
        $message[] = 'successfully updated!';
    
}else{
        $message[]='Supplier does not  exist';


    }
}
?>


<?php


    if(isset($_POST['delete'])){

        $s_email=mysqli_real_escape_string($conn,$_POST['updatemail']);
            mysqli_query($conn,"DELETE FROM `supplier` WHERE Email_id ='$s_email'") or die('query failed');
    
            $message[] = 'successfully deleted the supplier record!';
        
    }else{
            $message[]='Supplier does not  exist';
    
    
        }
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/supplierstyles.css">
</head>
<body>


<?php include 'adminheader.php'; ?>


<div class="serach_sup" id="search">
<form action="" method="post">
        <br/><label>Select the supplier name to Update / Delete:</label>
        <input type="text" id="updatemail" name="updatemail" placeholder="enter the email" id= "update">
        <input type="submit" id="sbtn2"  name="search"  value="ok">
        <input type="submit" id="sbtn3"  name="delete"  value="delete">
</form>
</div>
<?php
    if(isset($_POST['search'])){

    $s_email=$_POST['updatemail'];
    ?>


<?php
    $select_sup=mysqli_query($conn,"SELECT * FROM `supplier` WHERE Email_id='$s_email'") or ('query failed');
    if(mysqli_num_rows($select_sup)>0) {
        while($fetch_sup=mysqli_fetch_assoc($select_sup))
        {

           
   ?>

<section class="sec1">



    <form  id="supform" method="post" action="" enctype="multipart/form-data">
    <div class="supdiv1">
        <h1><center><u>Update Supplier</u></center></h1>


        
        <label>Email-ID:</label>
        <input type="email" name="emailid" placeholder="Enter your email" value="<?php echo $fetch_sup['Email_id'] ?>">
        <label>Supplier ID:</label>
        <input type="text" name="supplierid" placeholder="Enter your supplier id" value="<?php echo $fetch_sup['supplier_id'] ?>">
        <label>Supplier Name:</label>
        <input type="text" name="suppliername" placeholder="Enter your supplier name" value="<?php echo $fetch_sup['Name'] ?>">
        <label>Address:</label>
        <input type="text" name="address" placeholder="Enter your address" value="<?php echo $fetch_sup['Address'] ?>">
        <label>Contact Number:</label>
        <input type="tel" name="phoneno" placeholder="Enter your phone number" value="<?php echo $fetch_sup['Phone_no'] ?>">
        <input type="submit" id="sbtn1"  name="submit">
        
    </div>
    </form>

    <?php
        }
    }
    ?>

    <?php
    }
    ?>
    
 </section>
 
    
</body>
</html>
