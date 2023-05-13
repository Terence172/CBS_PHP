<?php
include 'cbssessionCustomer.php'; 
if(!session_id())
{
  session_start();
}

//Connect to DB
include ('dbconnect.php');

//Get Booking ID
If(isset($_GET['id']))
{
  $bid = $_GET['id'];
}




//SQL Delete operation
$sql = "DELETE FROM tb_booking WHERE b_id='$bid'";


// Execute SQL
$result = mysqli_query($con, $sql);

//Close Connection
mysqli_close($con);

//Redirect Successfull notification
header('Location: customermanage.php');


?>