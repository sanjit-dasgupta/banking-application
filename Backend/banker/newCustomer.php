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
$password = md5($_POST['password']);
$dob = $_POST['dob'];
$branch = $_POST['branch'];
$addressLine1 = $_POST['addressLine1'];
$addressLine2 = $_POST['addressLine2'];
$city = $_POST['city'];
$state = $_POST['state'];
$pinCode = $_POST['pinCode'];
$res = new stdClass();
$res->status = 400;
$res->message = "Customer with the same username already exists";
if(mysqli_query($con, "INSERT INTO `users`(`username`, `password`, `role`, `enabled`) VALUES ('".$customer_username."','".$password."','Customer','Y')")){
	mysqli_query($con, "INSERT INTO `address`(`ID`, `Line1`, `Line2`, `City`, `State`, `PinCode`) VALUES (0,'".$addressLine1."', '".$addressLine2."', '".$city."', '".$state."', '".$pinCode."')");
	$addressID = mysqli_insert_id($con);
	mysqli_query($con, "INSERT INTO `user_details`(`username`, `first_name`, `last_name`, `dob`, `phone_number`, `email_address`, `branch_id`, `addressID`) VALUES ('".$customer_username."','".$fname."','".$lname."','".$dob."','".$phone_number."','".$email."',".$branch.",".$addressID.")");
	$res->status = 200;
	$res->message = "Customer added successfully";
}
echo json_encode($res);
mysqli_close($con);
?>