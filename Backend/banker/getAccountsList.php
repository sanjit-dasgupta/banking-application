<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$custUsername = $_POST['custUsername'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "Customer Not Found";
if($result = mysqli_query($con, "SELECT `username` FROM `users` WHERE `username` = '".$custUsername."' AND `role` = 'Customer'")){
	if(mysqli_num_rows($result)>0){
	$result = mysqli_query($con, "SELECT * FROM `customers` WHERE `username` = '".$custUsername."'");
	$res->status = 200;
	$res->message = "success";
	$res->result = mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
}
echo json_encode($res);
mysqli_close($con);
?>