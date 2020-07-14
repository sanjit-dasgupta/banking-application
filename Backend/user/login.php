<?php
while (! file_exists('mysqli.php') )
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$password = md5($_POST['password']);
$res = new stdClass();
$res->status = 400;
$res->message = "Login Failed";
$result = mysqli_query($con, "SELECT `role`,`enabled` FROM `users` WHERE `username` = '".$username."' AND `password` = '".$password."'");
if($result){
	$rowcount=mysqli_num_rows($result);
	if($rowcount == 0){
		echo json_encode($res);
		mysqli_close($con);
		exit;
	}
	$arr = mysqli_fetch_assoc($result);
	if($arr['enabled'] != 'Y'){
		$res->status = 400;
		$res->message = "Account disabled";
		mysqli_close($con);
		echo json_encode($res);
		exit;
	}
	$res->status = 200;
	$res->role = $arr['role'];
	$res->message = "Login Successful";
	$user_details = mysqli_query($con, "SELECT * FROM `user_details` WHERE `username` = '".$username."'");
	$res->user_details = mysqli_fetch_assoc($user_details);
	$token = md5(uniqid(rand(), true));
	mysqli_query($con, "UPDATE `login_data` SET `expired` = 'Y' WHERE `username` = '".$username."'");
	mysqli_query($con, "INSERT INTO `login_data`(`username`, `token`, `expired`, `last_accessed_timestamp`,`login_timestamp`) VALUES ('".$username."','".$token."','N', '".date("Y-m-d H:i:s", strtotime("now"))."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
	setcookie("token", $token, time() + (30*60), "/");
}
echo json_encode($res);
mysqli_close($con);
?>