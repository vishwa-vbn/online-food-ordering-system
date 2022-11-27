<!-- <?php 

session_start();
$user_id=$_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}

?>  -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reviews</title>


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style2.css">

</head>
<body>
   
<section  class="rsec">

 <div id="reviewdiv" >
                                    <form action="" method="post">
                                    <div><h3 id="item_name"> </h3></div>
                                    <textarea id="textbox" name="textr" cols="50" rows="4" placeholder="write review..."></textarea>
                                    <div id="rev_btn" ><input type="submit" value="Submit" name="rsubmit" > </div>
                                       </form>

                              </div> 


                              </section>

</body>
<script src="./js/admin_control.js"></script>

</html>