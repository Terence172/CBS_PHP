<?php
include 'cbssessionCustomer.php'; 
if(!session_id())
{
  session_start();
}

//Connect to DB
include ('dbconnect.php');

//Retrieve data from form
$uic = $_SESSION['uic'];
$fcar = $_POST['fcar'];
$fbdate = $_POST['fbdate'];
$frdate = $_POST['frdate'];

//Calculate the rent
$pickup =  date('Y-m-d H:i:s', strtotime($fbdate));	
$return =  date('Y-m-d H:i:s', strtotime($frdate));

$daydiff = abs(strtotime($frdate) - strtotime($fbdate));
$numday = $daydiff/(60*60*24);

//Get vehicle price from db
$sqlprice = "SELECT v_price FROM tb_vehicle WHERE v_reg = '$fcar'";
$resultprice = mysqli_query($con, $sqlprice);
$rowprice = mysqli_fetch_array($resultprice);

//Calculate total price
$totalprice = $numday * ($rowprice['v_price']);



//SQL Insert(CREATE) operation
$sql = "INSERT INTO tb_booking (b_customer, b_vehicle, b_bdate, b_rdate, b_total, b_status)
 		VALUES('$uic','$fcar','$fbdate','$frdate','$totalprice','1')";

//Check SQL execution - Optional
var_dump($sql);

// Execute SQL
$result = mysqli_query($con, $sql);

//Close Connection
mysqli_close($con);

//Redirect Successfull notification
header('Location: customermanage.php');


?>