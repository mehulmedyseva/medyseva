<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drugs extends Home_Controller {

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
        $data['page_title'] = 'Drugs';      
        $data['page'] = 'Drugs';   
        $data['drug'] = FALSE;
        $data['drugs'] = $this->admin_model->select_by_user('drugs');
        $data['main_content'] = $this->load->view('admin/user/drugs',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/drugs'));
            } else {
                if(user()->role == 'staff'){$user_id = user()->user_id;}else{$user_id = user()->id;}
                $data=array(
                    'user_id' => $user_id,
                    'name' => $this->input->post('name', true),
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'drugs');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'drugs');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }
                redirect(base_url('admin/drugs'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['drug'] = $this->admin_model->select_option($id, 'drugs');
        $data['main_content'] = $this->load->view('admin/user/drugs',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'drugs');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/drugs'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'drugs');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/drugs'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'drugs'); 
        echo json_encode(array('st' => 1));
    }
    
    public function remove(){
        
        $res = $this->admin_model->select_by_user('drugs');
        
        foreach($res as $value){
                        
                        
            if($this->input->post('check_box_'.$value->id) == 'yes') {
                
                $this->admin_model->delete($value->id,'drugs');
                
            }    
        }
        
        $this->session->set_flashdata('msg', 'Drugs has been deleted successfully.'); 
        redirect(base_url('admin/drugs'));
    }
    
   
}
	

