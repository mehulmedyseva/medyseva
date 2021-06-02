<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends Home_Controller {

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
        $data['page_title'] = 'Staff';      
        $data['page'] = 'Staff';   
        $data['staff'] = FALSE;
        $data['staffs'] = $this->admin_model->select_by_stff('staffs');
        $data['chambers'] = $this->admin_model->select_by_user('chamber');
        $data['main_content'] = $this->load->view('admin/user/staff',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   

            $id = $this->input->post('id', true);

            $check = $this->admin_model->check_duplicate_email($this->input->post('email'));
            if (!empty($check) && $id == '') {
                $this->session->set_flashdata('error', trans('email-exist'));
                redirect(base_url('admin/staff'));
            }

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/staff'));
            } else {
                if ($id != '') {
                    $password = $this->input->post('password');
                } else {
                    $password = hash_password($this->input->post('password'));
                }

                $data=array(
                    'user_id' => user()->id,
                    'chamber_id' => $this->input->post('chamber_id', true),
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'slug' => str_slug($this->input->post('name', true)),
                    'designation' => $this->input->post('designation', true),
                    'password' => $password,
                    'role' => 'staff',
                    'created_at' => my_date_now(),
                );
                $data = $this->security->xss_clean($data);

                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'staffs');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {

                    $total = get_total_value('staffs');
                    if (ckeck_plan_limit('staffs', $total) == FALSE) {
                        $this->session->set_flashdata('error', trans('reached-maximum-limit'));
                        redirect(base_url('admin/staff'));
                        exit();
                    }
                    $id = $this->admin_model->insert($data, 'staffs');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo');
                if($data_img){
                    $data_img = array(
                        'thumb' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'staffs'); 
                 }

                redirect(base_url('admin/staff'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['staff'] = $this->admin_model->select_by_option($id, 'staffs');
        $data['chambers'] = $this->admin_model->select_by_user('chamber');
        $data['main_content'] = $this->load->view('admin/user/staff',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'staffs');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/staff'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'staffs');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/staff'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'staffs'); 
        echo json_encode(array('st' => 1));
    }

}
	

