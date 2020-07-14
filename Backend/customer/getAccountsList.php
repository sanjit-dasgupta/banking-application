<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "User Not Found";
if($result = mysqli_query($con, "SELECT * FROM `customers` WHERE `username` = '".$username."'")){
	$res->status = 200;
	$res->message = "success";
	$res->result = mysqli_fetch_all($result,MYSQLI_ASSOC);
}
echo json_encode($res);
mysqli_close($con);
?>