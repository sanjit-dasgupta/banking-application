<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$res = new stdClass();
$res->status = 400;
$res->message = "Invalid Query";
if($result = mysqli_query($con, "SELECT d1.`ID` as id, d1.`Name`, d2.* FROM `branch` AS d1, `address` as d2 WHERE d1.`AddressID` = d2.`ID`")){
	if(mysqli_num_rows($result) > 0){
		$res->status = 200;
		$res->message = "success";
		$res->details = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
}
echo json_encode($res);
mysqli_close($con);
?>