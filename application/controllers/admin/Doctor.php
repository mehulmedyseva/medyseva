<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends Home_Controller{
    
    
   public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_staff() && !is_user()) {
            redirect(base_url());
        }
    }
    
    
   public function index()
   {
      
        $data = array();
        $data = array();
        $data['page_title'] = 'Doctor';      
        $data['page'] = 'Doctor';   
        $data['staff'] = FALSE;
        $data['staffs'] = $this->admin_model->select_doctor('users');
        $data['chambers'] = $this->admin_model->select_by_user('chamber');

       $data['main_content']= $this->load->view('admin/user/add_doctor',$data,TRUE);
       
       $this->load->view('admin/index', $data);
   }
   
   public function get_time()
    {   
        $user_id = $this->input->get('user_id', true);
        $date=$this->input->get('date', true);
        $day = date('l', strtotime($date));
        $day_id = get_day_id($day);
       
        $value = array();
        $value['times'] = get_time_by_days($day_id, $user_id);
        $value['date'] = $date;

        $data = array();
        $data['result'] = $this->load->view('admin/user/doctor_time', $value, TRUE);
        
        echo$data['result'];
    }
   public function create()
   {
       $data = array();
       
      $data['main_content']= $this->load->view('doctor/create');
       
       $this->load->view('admin/index', $data);
   }
  public function add()
  {   $id = $this->input->post('id', true);

     $check = $this->admin_model->check_email($this->input->post('email'));
     if (!empty($check) && $id == '')
     {
         $this->session->set_flashdata('error', trans('email-exist'));
                redirect(base_url('admin/doctor'));
     }
      $password = hash_password($this->input->post('password'));
      $user = $this->auth_model->validate_user();
      $code = random_string('numeric', 6);
       $data=array(
                    //'user_id' => user()->id,
                    'chamber_id' => $this->input->post('chamber_id', true),
                    'name' => $this->input->post('name', true),
                    'user_name' => str_slug($this->input->post('name', true)),
                    'slug' => str_slug($this->input->post('name', true)),
                    'email' => $this->input->post('email', true),
                    'verify_code' => $code,
                    'password' => $password,
                    'role' => 'user',
                    'status' => 1,
                    'parent_id' =>user()->id,
                    'email_verified' => 0,
                    'enable_appointment' => 1,
                    'created_at' => my_date_now(),
                );
                
                        
                
                
       $data = $this->security->xss_clean($data);         
       
    if($id!="")  
      { 
            $data=array(
                        
                            
                            'name' => $this->input->post('name', true),
                            'email' => $this->input->post('email', true),
                            'chamber_id' => $this->input->post('chamber_id', true),

                            'slug' => str_slug($this->input->post('name', true)),
                          //  'designation' => $this->input->post('designation', true),
                            //'password' => $password,
                            'role' => 'user',
                            'created_at' => my_date_now(),
                        );

                    if ($id != '') 
                      {
                                $this->admin_model->edit_option($data, $id, 'users');
                                $this->session->set_flashdata('msg', trans('updated-successfully')); 
                                
                                 $data_img = $this->admin_model->do_upload('photo');
                       if($data_img){
                         $data_img = array(
                                     'thumb' => $data_img['medium']
                                    );
                                $this->admin_model->edit_option($data_img, $id, 'users'); 
                          }
                    }
        
    }
    else{
      
          
    $id = $this->admin_model->insert($data, 'users');
     
     
     $this->session->set_flashdata('msg', trans('inserted-successfully')); 
     
      $data_img = $this->admin_model->do_upload('photo');
                if($data_img){
                    $data_img = array(
                        'thumb' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'users'); 
                 }


    
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
                            'user_id' => $id,
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
                        
                        
                        
                   /*  $cuid = random_string('numeric',5);
                        $chamber=array(
                            'user_id' =>$id,
                            'uid' => $cuid,
                            'title' => 'Chamber Title',
                            'name' => 'Chamber Name',
                            'is_primary' => 1,
                            'status' => 1,
                            'created_at' => my_date_now()
                        );
                        $this->common_model->insert($chamber, 'chamber');*/

 
       }

        redirect(base_url('admin/doctor'));
  }
  
  public function edit($id){
     
      $data=array();
      $data['page_title'] = 'Edit';   
      $data['chambers'] = $this->admin_model->select_by_user('chamber');

      $data['user']= $this->admin_model->select_option($id, 'users');
      $data['main_content']= $this->load->view('admin/user/add_doctor',$data,TRUE);
     $this->load->view('admin/index',$data);

  }
public function delete($id)
{
     $this->admin_model->delete($id,'users'); 
        echo json_encode(array('st' => 1));
}
public function update()
{  
}
}





























?>