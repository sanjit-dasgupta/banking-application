<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "Account Not Found";
if($result = mysqli_query($con, "SELECT `first_name`, `last_name`, `phone_number`, `email_address` FROM `user_details` WHERE `username` IN (SELECT `banker` FROM `customers` WHERE `username` = '".$username."')")){
	if(mysqli_num_rows($result) > 0){
		$res->status = 200;
		$res->message = "success";
		$res->details = mysqli_fetch_assoc($result);
	}
}
echo json_encode($res);
mysqli_close($con);
?>