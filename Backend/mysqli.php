<?php
date_default_timezone_set('Asia/Kolkata'); 
$con = mysqli_connect("localhost","banking","1rHHE2Epk8cuIOvb","banking");
$overdraft = -30000;
// Check connection
if (mysqli_connect_errno())
  {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
  echo "Connection Failed";
  exit;
  }
  function authValid($username, $con){
	  $token = $_COOKIE['token'];
	  $res = new stdClass();
	  $res->status = 401;
	  $res->message = "Failed to authenticate user";
	  if($result = mysqli_query($con, "SELECT `ID`, `expired`, `last_accessed_timestamp` FROM `login_data` WHERE `username` = '".$username."' AND `token` = '".$token."'")){
		  if(mysqli_num_rows($result) > 0){
			  $arr = mysqli_fetch_assoc($result);
			  if($arr['expired'] != 'Y'){
				  $start_date = strtotime($arr['last_accessed_timestamp']); 
				  $end_date = strtotime("now"); 
				  if($end_date - $start_date < 5*60){
					  $res->status = 200;
					  $res->message = "User Authenticated";
					  mysqli_query($con, "UPDATE `login_data` SET `last_accessed_timestamp` = '".date("Y-m-d H:i:s", strtotime("now"))."' WHERE `username` = '".$username."' AND `token` = '".$token."'");
				  }else{
					  $res->message = "Session Expired. Login Again.";
					  mysqli_query($con, "UPDATE `login_data` SET `last_accessed_timestamp` = '".date("Y-m-d H:i:s", strtotime("now"))."', `expired` = 'Y' WHERE `username` = '".$username."' AND `token` = '".$token."'");
				  }
			  }			  
		  }
	  }
	  if($res->status == 401){
		  echo json_encode($res);
		  mysqli_close($con);
		  exit;
	  }
	  return $res;
  }
  function send_sms($mobile,$msg){
$authKey = "168694AVmpaIM9yoS5cad4a7f";

$mobileNumber = $mobile;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "FLORNC";

//Your message to send, Add URL encoding here.
$message = urlencode($msg);

//Define route 
$route = "4";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="https://control.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response
$output = curl_exec($ch);

if(curl_errno($ch))
{
    return 'SMS Error : ' . curl_error($ch);
}

curl_close($ch);

return $output;
}
?>