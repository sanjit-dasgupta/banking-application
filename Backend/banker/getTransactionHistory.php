<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$account_number = $_POST['account_number'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "Account Not Found";
if($result = mysqli_query($con, "SELECT * FROM `transaction_history` WHERE `account_number` = '".$account_number."' ORDER BY `Timestamp` DESC")){
	$res->status = 200;
	$res->message = "success";
	$res->result = mysqli_fetch_all($result,MYSQLI_ASSOC);
}
echo json_encode($res);
mysqli_close($con);
?>