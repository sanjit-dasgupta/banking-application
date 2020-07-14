<?php
while (! file_exists('mysqli.php') )
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$token = $_COOKIE['token'];
$res = new stdClass();
$res->status = 400;
$res->message = "Logout Failed";
authValid($username, $con);
if(mysqli_query($con, "UPDATE `login_data` SET `expired` = 'Y' WHERE `username` = '".$username."' AND `token` = '".$token."'")){
	if(mysqli_affected_rows($con) > 0){
		$res->status = 200;
		$res->message = "Logout Successful";
	}
}
echo json_encode($res);
mysqli_close($con);
?>