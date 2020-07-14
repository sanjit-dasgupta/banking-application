<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
authValid($username, $con);
$customer_username = $_POST['customer_username'];
$account_type = $_POST['account_type'];
$balance = $_POST['balance'];
$res = new stdClass();
$res->status = 400;
$res->message = "Account could not be created";
if(mysqli_query($con, "INSERT INTO `customers`(`account_number`, `username`, `account_type`, `balance`, `banker`, `approved`) VALUES (0,'".$customer_username."','".$account_type."',".$balance.",'".$username."','Y')")){
	$account_number = mysqli_insert_id($con);
	$res->status = 200;
	$res->message = "Account added successfully. New account number : ".$account_number;
}
echo json_encode($res);
mysqli_close($con);
?>