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

class Predirect extends Home_Controller {

	function __construct() {
		parent::__construct();
		// $this->load->model('student');
		// $this->load->model('course');
		$this->load->library('session');
	}

	public function add()
	{
	    
	 
		$checkSum = "";
		$paramList = array();

		$data = array(
			'user_id' =>$this->input->post('cust_id'),
			'patient_id' =>$this->input->post('patient_id'),
			'appointment_id' =>$this->input->post('appointment_id'),
		   
		);

		$this->session->set_userdata($data);
		

		$ORDER_ID = $_POST["ORDER_ID"];
		$CUST_ID = $_POST["cust_id"];
		$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
		$CHANNEL_ID = $_POST["CHANNEL_ID"];
		$TXN_AMOUNT = $_POST["TXN_AMOUNT"];
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
		$paramList["CUST_ID"] = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"] = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		$paramList["CALLBACK_URL"] = base_url()."admin/presponses/pay";
		
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		$paramList["CHECKSUMHASH"]=$checkSum;	

		$this->load->view('pgRedirect',['paramList'=>$paramList]);
	}


}