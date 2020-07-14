<?php
while (! file_exists('mysqli.php') )
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
authValid($username, $con);
$cust_username = $_POST['cust_username'];
$res = new stdClass();
$res->status = 400;
$res->message = "User Not Found";
if($result = mysqli_query($con, "SELECT * FROM `user_details` WHERE `username` = '".$cust_username."'")){
	if(mysqli_num_rows($result) > 0){
		$res->status = 200;
		$res->message = "success";
		$res->user_details = mysqli_fetch_assoc($result);
		$result = mysqli_query($con, "SELECT * FROM `address` WHERE `ID` IN (SELECT `addressID` FROM `user_details` WHERE `username` = '".$cust_username."')");
		$res->address_details = mysqli_fetch_assoc($result);
	}
}
echo json_encode($res);
mysqli_close($con);
?>