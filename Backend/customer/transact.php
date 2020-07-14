<?php
while (! file_exists('mysqli.php'))
    chdir('..');
include_once "mysqli.php";
$username = $_POST['username'];
$transaction_type = $_POST['transaction_type'];
$account_number = $_POST['account_number'];
$transaction_amt = $_POST['transaction_amt'];
$ref = $_POST['ref'];
authValid($username, $con);
$res = new stdClass();
$res->status = 400;
$res->message = "Transaction Failed.";
//check if username and account_number are valid and if the account is locked or not
if($result = mysqli_query($con, "SELECT `account_type`, `approved`, `balance` FROM `customers` WHERE `username` = '".$username."' AND `account_number` = '".$account_number."'")){
	if(mysqli_num_rows($result) > 0){
		$cust = mysqli_fetch_assoc($result);
		if($cust['approved'] == 'Y'){
			$user_details = mysqli_query($con, "SELECT `phone_number` FROM `user_details` WHERE `username` = '".$username."'");
			$user_details = mysqli_fetch_assoc($user_details);
			$otp = mt_rand(123456,999999);
			$msg = "Your One Time Password(OTP) for a transaction of ".$transaction_amt." is ".$otp;
			$ph_no = $user_details['phone_number'];
			if($transaction_type == 'Deposit'){
				mysqli_query($con, "UPDATE `customers` SET `balance` = ".($transaction_amt + $cust['balance'])." WHERE `username` = '".$username."' AND `account_number` = '".$account_number."'");
				mysqli_query($con, "INSERT INTO `transaction_history` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `balance`, `ref`, `Timestamp`) VALUES(0, '".$account_number."', ".$transaction_amt.", 'Deposit', ".($transaction_amt + $cust['balance']).", '".$ref."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
				$txn_id = mysqli_insert_id($con);
				$res->status = 200;
				$res->message = "Deposit Successful. Transaction ID : ".$txn_id;
				send_sms($ph_no, "You have successfully deposited an amount of Rs. ".$transaction_amt.". Your current balance is Rs. ".($transaction_amt + $cust['balance']).". Your txnID is : ".$txn_id);
			}else if($transaction_type == 'Withdrawal'){
				if($cust['balance'] >= $transaction_amt){
					mysqli_query($con, "INSERT INTO `transaction_verify` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `ref`, `OTP`, `Timestamp`) VALUES (0, '".$account_number."', ".$transaction_amt.", 'Withdrawal', '".$ref."', '".$otp."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
					$res->status = 200;
					$res->message = "Enter OTP : ";
					$res->temp_id = mysqli_insert_id($con);
					send_sms($ph_no, $msg);
				}else{
					$res->message = "Insufficient funds available.";
				}
			}else if($transaction_type == 'Transfer'){
				if(($cust['balance'] >= $transaction_amt && $cust['account_type'] == "Savings") || ($cust['balance'] - $transaction_amt >= $overdraft && $cust['account_type'] == "Current")){
					if($result2 = mysqli_query($con, "SELECT `account_type`, `approved`, `balance` FROM `customers` WHERE `account_number` = '".$ref."'")){
						if(mysqli_num_rows($result2) > 0){
							$dest = mysqli_fetch_assoc($result2);
							if($dest['approved'] == 'Y'){
								mysqli_query($con, "INSERT INTO `transaction_verify` (`ID`, `account_number`, `transaction_amt`, `transaction_type`, `ref`, `OTP`, `Timestamp`) VALUES(0, '".$account_number."', ".$transaction_amt.", 'Transfer', '".$ref."', '".$otp."', '".date("Y-m-d H:i:s", strtotime("now"))."')");
								$res->status = 200;
								$res->message = "Enter OTP : ";
								$res->temp_id = mysqli_insert_id($con);
								send_sms($ph_no, $msg);
							}else{
								$res->message = "Destination account number : ".$ref." hasn't been approved yet";
							}
						}else{
							$res->message = "Destination account not valid.";
						}
					}
				}
				else{
					$res->message = "Insufficient funds available.";
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