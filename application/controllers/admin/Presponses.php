<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// header("Pragma: no-cache");
// header("Cache-Control: no-cache");
// header("Expires: 0");

define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
define('PAYTM_MERCHANT_KEY', 'Fz@QskH6dlkgyyLY'); //Change this constant's value with Merchant key received from Paytm.
define('PAYTM_MERCHANT_MID', 'XixoOl03172100850378'); //Change this constant's value with MID (Merchant ID) received from Paytm.
define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.

require_once(APPPATH."libraries/paytm/config_paytm.php");
require_once(APPPATH."libraries/paytm/encdec_paytm.php");

class Presponses extends Home_Controller {

	function __construct() {
        parent::__construct();
        // $this->load->model('student');
        // $this->load->model('course');
	// $this->load->model('payment');     
	$this->config->set_item('csrf_protection', false);  
	$this->load->library('session');
    }

	public function pay()
	{
	   
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.



if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		if (isset($_POST) && count($_POST)>0 )
		{ 
		  
		    
			$userData= array(
				// 'order_id' => $_POST['ORDERID'],
				// 'cust_id' => $_POST['CUST_ID'],
				// 'student_id' => $this->session->userdata('userId'),
				// 'course_id' => $this->session->userdata('course_id'),
				// 'txn_id' => $_POST['TXNID'],
				'puid' => $_POST['TXNID'],
				// 'paid_amt' => $_POST['TXNAMOUNT'],
				'amount' => $_POST['TXNAMOUNT'],
				// 'payment_mode' => $_POST['PAYMENTMODE'],
				'payment_method' => $_POST['PAYMENTMODE'],
				// 'txn_date' => $_POST['TXNDATE'],
				'created_at' => $_POST['TXNDATE'],
				// 'gateway_name' => $_POST['GATEWAYNAME'],
				// 'bank_txn_id' => $_POST['BANKTXNID'],
				// 'bank_name' => $_POST['BANKNAME'],
				// 'check_sum_hash'=> $_POST['CHECKSUMHASH'],
				// 'mid' => $_POST['MID'],
				// 'currency' => $_POST['CURRENCY'],
				'status' => 'verified',
				
				'user_id' => $this->session->userdata('user_id'),
				'appointment_id' =>$this->session->userdata('appointment_id'),
				'patient_id' => $this->session->userdata('patient_id')
			);
			// var_dump($userData);
			$data = $userData;
			$id = $this->admin_model->insert($data, 'payment_user');
			if($id)
			{
			   // return 'payment_success';
			 	redirect(base_url('admin/payment/success_msg')); 
			}
		}
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}



}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
}
}