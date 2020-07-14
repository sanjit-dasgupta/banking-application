<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
authValid($username, $con);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$customer_username = $_POST['customer_username'];
$dob = $_POST['dob'];
$addressLine1 = $_POST['addressLine1'];
$addressLine2 = $_POST['addressLine2'];
$city = $_POST['city'];
$state = $_POST['state'];
$pinCode = $_POST['pinCode'];
$res = new stdClass();
$res->status = 400;
$res->message = "User not found";
if(mysqli_query($con, "UPDATE `address` SET `Line1`='".$addressLine1."',`Line2`='".$addressLine2."',`City`='".$city."',`State`='".$state."',`PinCode`='".$pinCode."' WHERE `ID` IN (SELECT `addressID` FROM `user_details` WHERE `username` = '".$customer_username."')")){	
	mysqli_query($con, "UPDATE `user_details` SET `first_name`='".$fname."',`last_name`='".$lname."',`dob`='".$dob."',`phone_number`='".$phone_number."',`email_address`='".$email."' WHERE `username` = '".$customer_username."'");
	$res->status = 200;
	$res->message = "User details updated successfully";
}
echo json_encode($res);
mysqli_close($con);
?>