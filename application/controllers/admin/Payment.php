<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Payment';      
        $data['page'] = 'Payment'; 
        $payment = $this->admin_model->get_my_payment();
        $data['payment_id'] = $payment->puid;
        $data['my_payment'] = $payment;
        $data['package'] = $this->common_model->get_package_by_slug($payment->package);
        $data['main_content'] = $this->load->view('admin/payment',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function settings(){
        $data = array();
        $data['page_title'] = 'Payment Settings';      
        $data['page'] = 'Payment';   
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['users'] = $this->common_model->get_users();
        $data['main_content'] = $this->load->view('admin/payment_settings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function receipt($puid)
    {
        $data = array();
        $data['page_title'] = 'Payment Receipt'; 
        $data['user'] = $this->admin_model->get_user_payment_details($puid);
        //echo "<pre>"; print_r($data['user']); exit();
        $this->load->view('admin/payment/payment_invoice_receipt',$data);
        //$this->load->view('admin/index',$data);
    }

    public function lists()
    {
        $data = array();
        $data['page_title'] = 'Payment list';
        $data['payments'] = $this->admin_model->get_users_payment_lists(user()->id);
        $data['main_content'] = $this->load->view('admin/payment/payment_invoice_lists',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function transactions()
    {
        $data = array();
        $data['page_title'] = 'Transactions';
        $data['payments'] = $this->admin_model->get_payment_lists();
        $data['main_content'] = $this->load->view('admin/payment/transactions',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    //update settings
    public function update(){

        if ($_POST) {
            
            if(!empty($this->input->post('paypal_payment'))){$paypal_payment = $this->input->post('paypal_payment', true);}
            else{$paypal_payment = 0;}

            if(!empty($this->input->post('stripe_payment'))){$stripe_payment = $this->input->post('stripe_payment', true);}
            else{$stripe_payment = 0;}
            
            $data = array(
                'country' => $this->input->post('country', true),
                'paypal_mode' => $this->input->post('paypal_mode', true),
                'paypal_email' => $this->input->post('paypal_email', true),
                'publish_key' => $this->input->post('publish_key', true),
                'secret_key' => $this->input->post('secret_key', true),
                'paypal_payment' => $paypal_payment,
                'stripe_payment' => $stripe_payment 
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', trans('updated-successfully'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function offline()
    {   
        if($_POST)
        {   
            $package = $this->admin_model->get_by_id($this->input->post('package'), 'package');
            $payment = $this->admin_model->get_user_payment($this->input->post('user'));

            if($this->input->post('billing_type') =='monthly'):
                $amount = round($package->monthly_price); 
                $expire_on = date('Y-m-d', strtotime('+1 month'));
            else:
                $amount = round($package->price); 
                $expire_on = date('Y-m-d', strtotime('+12 month'));
            endif;
            
            //validate inputs
            $this->form_validation->set_rules('user', trans('user'), 'required');
            $this->form_validation->set_rules('package', trans('package'), 'required');
            $this->form_validation->set_rules('status', trans('payment-status'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/payment'));
            } else {
                
                $data=array(
                    'user_id' => $this->input->post('user', true),
                    'package_id' => $package->id,
                    'billing_type' => $this->input->post('billing_type', true),
                    'amount' => $amount,
                    'status' => $this->input->post('status', true),
                    'created_at' => my_date_now(),
                    'expire_on' => $expire_on
                );
                $data = $this->security->xss_clean($data);

                if (empty($payment)) {
                    $this->admin_model->insert($data, 'payment');
                } else {
                    $this->admin_model->update_payment($data, $this->input->post('user'), 'payment');
                }

                $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                redirect(base_url('admin/payment/settings'));

            }
        }      
        
    }


    public function upgrade()
    {
        $data = array();
        $data['page_title'] = 'Upgrade';      
        $data['page'] = 'Payment'; 
        $payment = $this->admin_model->get_my_payment();
        $data['payment_id'] = $payment->puid;
        $data['package'] = $this->common_model->get_package_by_slug($payment->package);
        $data['main_content'] = $this->load->view('admin/upgrade',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function upgrade_operation() 
    {
        $data = array(
            'account_type' => 'pro'
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, user()->id, 'users');

        $pkg = $this->common_model->get_package_price('pro');
        $payment = $this->common_model->get_user_payment(user()->id);

        //create payment
        $pay_data=array(
            'package' => 'pro',
            'amount' => $pkg->price,
            'status' => 'pending',
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $this->admin_model->update($pay_data, $payment->id, 'payment');

        if (get_settings()->enable_paypal == 1) {
            redirect(base_url('admin/payment'));
        } else {
            redirect(base_url('admin/profile'));
        }
        
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'testimonials');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/testimonial'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'testimonials'); 
        echo json_encode(array('st' => 1));
    }






    //******* User Payments *******//

    public function user()
    {
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
        
        $data = array();
        $data['page_title'] = 'Payment Settings';      
        $data['page'] = 'Payment';   
        $data['settings'] = $this->admin_model->get('settings');
        $data['currencies'] = $this->admin_model->select_asc('country');
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['main_content'] = $this->load->view('admin/user/user_payment_settings',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    //update payment settings
    public function user_update(){
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
        
        if ($_POST) {
            
            if(!empty($this->input->post('paypal_payment'))){$paypal_payment = $this->input->post('paypal_payment', true);}
            else{$paypal_payment = 0;}

            if(!empty($this->input->post('stripe_payment'))){$stripe_payment = $this->input->post('stripe_payment', true);}
            else{$stripe_payment = 0;}
            
            $country = $this->admin_model->get_by_id($this->input->post('currency'), 'country');

            $data = array(
                'country' => $this->input->post('currency', true),
                'currency' => $country->currency_code,
                'paypal_mode' => $this->input->post('paypal_mode', true),
                'paypal_email' => $this->input->post('paypal_email', true),
                'publish_key' => $this->input->post('publish_key', true),
                'secret_key' => $this->input->post('secret_key', true),
                'paypal_payment' => $paypal_payment,
                'stripe_payment' => $stripe_payment 
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, user()->id, 'users');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }








    public function staff_payment(){
        
        $data = array();
        $data['appointment'] = $this->admin_model->get_by_id($amp_id, 'appointments');
        $data['appointment_id'] = $data['appointment']->id;
        $data['user'] = $this->admin_model->get_by_id($data['appointment']->user_id, 'users');
        
         $data['patients'] = $this->admin_model->select_by_chamber('patientses');
          
          
     
          
        $data['main_content'] = $this->load->view('admin/user/staff_payment', $data, TRUE);
        
        $this->load->view('admin/index', $data);
    }




    //** Patient Payments **//

    public function patient($amp_id){
        
        $data = array();
        $data['appointment'] = $this->admin_model->get_by_id($amp_id, 'appointments');
        $data['appointment_id'] = $data['appointment']->id;
        $data['user'] = $this->admin_model->get_by_id($data['appointment']->user_id, 'users');
        
        
        $data['main_content'] = $this->load->view('admin/user/patient_payment', $data, TRUE);
        
        $this->load->view('admin/index', $data);
    }
    
    
    public function rozerpay_payment_custome($id){
        
            $res = $this->admin_model->get_by_id($id, 'invoices');
        
			$userData= array(
		
				'puid'            => $this->input->post('razorpay_payment_id'),
				'amount'          => $res->total,
				'payment_method'  => 'Rozerpay',
				'invoice_id'      =>  $id,
				'created_at'      => date('Y-m-d'),
				'status'          => 'verified',
				'invoice_type'    => 'custome',
				'user_id'         => $this->session->userdata('id'),
				'appointment_id'  => $res->id,
				'patient_id'      => $res->patient_id,
			);
			
            
            $action = ['paymant_status' => 'paid'];
			
			$this->admin_model->edit_option($action,$id,'invoices');
			
			
			// var_dump($userData);
			$data = $userData;
			$id = $this->admin_model->insert($data, 'payment_user');
			
			
			
			if($id)
			{
			 	redirect(base_url('admin/payment/success_msg')); 
			}
        
                
    }
    
    
    public function rozerpay_payment($id){
        
        
        $amp = $this->admin_model->get_invoice_appointments($id);
        
         $info = $this->admin_model->get_by_prescription_id($amp->prescription_id,'pre_investigation');
                      
         $test_price = [];      
	         	  
	        foreach($info as $value){
				            
				    $detail  = $this->admin_model->get_name_by_id($value->investigation_id,'advise_investigations');
				            
				    $test_price[] = $detail['price'];
				  
	         }
	         	  
	         $final_amount = array_sum($test_price);
	         	  
	         $amount =  $final_amount+$amp->price;
        
        
        $res = $this->admin_model->get_by_id($id, 'appointments');
        
			$userData= array(
		
				'puid'            => $this->input->post('razorpay_payment_id'),
				'amount'          => $amount,
				'payment_method'  => 'Rozerpay',
				'created_at'      => date('Y-m-d'),
				'status'          => 'verified',
				'user_id'         => $res->user_id,
				'appointment_id'  => $res->id,
				'patient_id'      => $res->patient_id,
			);
			

			// var_dump($userData);
			$data = $userData;
			$id = $this->admin_model->insert($data, 'payment_user');
			if($id)
			{
			 	redirect(base_url('admin/payment/success_msg')); 
			}
        
    }


    public function stripe_payment()
    {

        $id = $this->input->post('appointment_id');
        $appointment = $this->admin_model->get_by_id($id, 'appointments');
        $user = $this->admin_model->get_by_id($appointment->user_id, 'users');
        $amount = evisit_settings($user->id)->price;

        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($user->secret_key);
        
        try {
            $charge = \Stripe\Charge::create ([
                "amount" => $amount*100,
                "currency" => $user->currency,
                "source" => $this->input->post('stripeToken'),
                "description" => "Consultation payment from ".get_settings()->site_name 
            ]);
            $chargeJson = $charge->jsonSerialize();
            
            $amount                  = $chargeJson['amount']/100;
            $balance_transaction     = $chargeJson['balance_transaction'];
            $currency                = $chargeJson['currency'];
            $status                  = $chargeJson['status'];
            $payment = 'success';
        }catch(Exception $e) { 
            $error = $e->getMessage(); 
            $this->session->set_flashdata('error', $error);
            $payment = 'failed';
        }

        if($payment == 'success'):  
            redirect(base_url('admin/payment/payment_success/'.$appointment->id.'/stripe'));
        else:
            redirect(base_url('admin/payment/payment_cancel/'.$appointment->id));
        endif;
    }


    //payment success
    public function payment_success($amp_id, $payment_method='')
    {   
        
        $appointment = $this->admin_model->get_by_id($amp_id, 'appointments');
        $user = $this->admin_model->get_by_id($appointment->user_id, 'users');
        $amount = evisit_settings($user->id)->price;
        $uid = random_string('numeric',5);
       
        if (isset($payment_method) && $payment_method == 'stripe') {
            $payment_method = 'stripe';
        } else {
            $payment_method = 'paypal';
        }

        $pay_data = array(
            'user_id' => $user->id,
            'patient_id' => $appointment->patient_id,
            'appointment_id' => $appointment->id,
            'puid' => $uid,
            'status' => 'verified',
            'amount' => $amount,
            'payment_method' => $payment_method,
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $response = $this->common_model->insert($pay_data, 'payment_user');

        if ($response) {
            redirect(base_url('admin/payment/success_msg'));
        }

    }


    //payment cancel
    public function offline_payment($amp_id)
    {   
        $appointment = $this->admin_model->get_by_id($amp_id, 'appointments');
        $user = $this->admin_model->get_by_id($appointment->user_id, 'users');
        $amount = evisit_settings($user->id)->price;
        $uid = random_string('numeric',5);
        $payment_method = 'offline';
        
        $pay_data = array(
            'user_id' => $user->id,
            'patient_id' => $appointment->patient_id,
            'appointment_id' => $appointment->id,
            'puid' => $uid,
            'status' => 'verified',
            'amount' => $amount,
            'payment_method' => $payment_method,
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $response = $this->common_model->insert($pay_data, 'payment_user');
        $this->session->set_flashdata('msg', trans('inserted-successfully')); 
        redirect($_SERVER['HTTP_REFERER']);
    }


    //payment cancel
    public function payment_cancel($amp_id)
    {   
        $data = array();
        $data['error_msg'] = 'Error';
        $data['main_content'] = $this->load->view('admin/user/payment_user_msg',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function success_msg(){
        $data = array();
        $data['success_msg'] = 'Success';
        $data['main_content'] = $this->load->view('admin/user/payment_user_msg',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

}
	

