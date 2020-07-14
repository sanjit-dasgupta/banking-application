<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$account_number = $_POST['account_number'];
$otp = $_POST['otp'];
$temp_id = $_POST['temp_id'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "Invalid OTP.";
//check if username and account_number are valid and if the account is locked or not
if($result = mysqli_query($con, "SELECT `account_type`, `approved`, `balance` FROM `customers` WHERE `username` = '".$username."' AND `account_number` = '".$account_number."'")){
	if(mysqli_num_rows($result) > 0){
		$cust = mysqli_fetch_assoc($result);
		if($cust['approved'] == 'Y'){
			$result2 = mysqli_query($con, "SELECT * FROM `transaction_verify` WHERE `ID` = '".$temp_id."' AND `OTP` = '".$otp."'");
			if(mysqli_num_rows($result2) > 0){
				$transaction_data = mysqli_fetch_assoc($result2);
				if(strtotime("now") - strtotime($transaction_data['Timestamp']) < 5*60){
					if($transaction_data['transaction_type'] == 'Withdrawal'){
						mysqli_query($con, "UPDATE `customers` SET `balance` = ".($cust['balance'] - $transaction_data['transaction_amt'])." WHERE `username` = '".$username."' AND `account_number` = '".$account_number."'");
						mysqli_query($con, "INSERT INTO `transaction_history` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `balance`, `ref`, `Timestamp`) VALUES(0, '".$account_number."', ".$transaction_data['transaction_amt'].", 'Withdrawal', ".($cust['balance'] - $transaction_data['transaction_amt']).", '".$transaction_data['ref']."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
						$txn_id = mysqli_insert_id($con);
						$res->status = 200;
						$res->message = "Withdrawal Successful. Transaction ID : ".$txn_id;
						$user_details = mysqli_query($con, "SELECT `phone_number` FROM `user_details` WHERE `username` = '".$username."'");
						$user_details = mysqli_fetch_assoc($user_details);
						$ph_no = $user_details['phone_number'];
						send_sms($ph_no, "You have successfully withdrawn an amount of Rs. ".$transaction_data['transaction_amt'].". Your current balance is Rs. ".($cust['balance'] - $transaction_data['transaction_amt']).". Your txnID is : ".$txn_id);
					}else if($transaction_data['transaction_type'] == 'Transfer'){
						$result_ref = mysqli_query($con, "SELECT `balance` FROM `customers` WHERE `account_number` = '".$transaction_data['ref']."'");
						$dest = mysqli_fetch_assoc($result_ref);
						mysqli_query($con, "UPDATE `customers` SET `balance` = ".($cust['balance'] - $transaction_data['transaction_amt'])." WHERE `username` = '".$username."' AND `account_number` = '".$account_number."'");
						mysqli_query($con, "UPDATE `customers` SET `balance` = ".($dest['balance'] + $transaction_data['transaction_amt'])." WHERE `account_number` = '".$transaction_data['ref']."'");
						mysqli_query($con, "INSERT INTO `transaction_history` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `balance`, `ref`, `Timestamp`) VALUES(0, '".$account_number."', ".$transaction_data['transaction_amt'].", 'Transfer', ".($cust['balance'] - $transaction_data['transaction_amt']).", '".$transaction_data['ref']."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
						$txn_id = mysqli_insert_id($con);
						$res->status = 200;
						$res->message = "Transaction Successful. Transaction ID : ".$txn_id;
						mysqli_query($con, "INSERT INTO `transaction_history` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `balance`, `ref`, `Timestamp`) VALUES(0, '".$transaction_data['ref']."', ".$transaction_data['transaction_amt'].", 'Deposit', ".($dest['balance'] + $transaction_data['transaction_amt']).", '".$account_number."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
						$user_details = mysqli_query($con, "SELECT `phone_number` FROM `user_details` WHERE `username` = '".$username."'");
						$user_details = mysqli_fetch_assoc($user_details);
						$ph_no = $user_details['phone_number'];
						send_sms($ph_no, "You have successfully transferred an amount of Rs. ".$transaction_data['transaction_amt'].". Your current balance is Rs. ".($cust['balance'] - $transaction_data['transaction_amt']).". Your txnID is : ".$txn_id);
						$user_details = mysqli_query($con, "SELECT `phone_number` FROM `user_details` WHERE `username` IN (SELECT `username` FROM `customers` WHERE `account_number` = '".$transaction_data['ref']."')");
						$user_details = mysqli_fetch_assoc($user_details);
						$ph_no = $user_details['phone_number'];
						send_sms($ph_no, "You have successfully received an amount of Rs. ".$transaction_data['transaction_amt'].". Your current balance is Rs. ".($dest['balance'] + $transaction_data['transaction_amt']).". Your txnID is : ".$txn_id);
					}
				}else{
					$res->message = "OTP Expired. Transaction Failed.";
				}
			}
		}else{
			$res->message = "Account number : ".$account_number." hasn't been approved yet.";
		}
	}else{
		$res->message = "Account number : ".$account_number." not found.";
	}
}
echo json_encode($res);
mysqli_close($con);
?>