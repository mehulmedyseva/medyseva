<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_file extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        // if (!is_admin() && !is_pro_user()) {
        //     redirect(base_url());
        // }
        // $this->load->library('session');
    }
   public function add_drugs(){
        // return "dd";
        if(isset($_POST["submit_file"]))
        {
         $file = $_FILES["file"]["tmp_name"];
         $file_open = fopen($file,"r");
         while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
         {
          $user_id =  $csv[0];
          $name = $csv[1];
          $details = $csv[2];
          $data = array('user_id' => user()->id,'name' =>$name,'details' =>$details);
          $this->admin_model->insert($data, 'drugs');
         }
         
        }
        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect(base_url('admin/diagonosis'));
    }
    public function add_diagnosis(){
        // return "dd";
        if(isset($_POST["submit_file"]))
        {
         $file = $_FILES["file"]["tmp_name"];
         $file_open = fopen($file,"r");
         while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
         {
          $user_id =  $csv[0];
          $name = $csv[1];
          $details = $csv[2];
          $data = array('user_id' => user()->id,'name' =>$name,'details' =>$details);
          $this->admin_model->insert($data, 'diagonosis');
         }
         
        }
        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect(base_url('admin/diagonosis'));
    }

    public function add_advises(){
        // return "dd";
        if(isset($_POST["submit_file"]))
        {
         $file = $_FILES["file"]["tmp_name"];
         $file_open = fopen($file,"r");
         while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
         {
          $user_id =  $csv[0];
          $name = $csv[1];
          $details = $csv[2];
          $data = array('user_id' => user()->id,'name' =>$name,'details' =>$details);
          $this->admin_model->insert($data, 'advises');
         }
         
        }
        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect(base_url('admin/advises'));
    }

    public function add_additional_advises(){
        // return "dd";
        if(isset($_POST["submit_file"]))
        {
         $file = $_FILES["file"]["tmp_name"];
         $file_open = fopen($file,"r");
         while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
         {
          $user_id =  $csv[0];
          $name = $csv[1];
          $details = $csv[2];
          $data = array('user_id' => user()->id,'name' =>$name,'details' =>$details);
          //var_dump($csv);
          $this->admin_model->insert($data, 'additional_advises');
         }
         
        }
        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect(base_url('admin/additional_advises'));
    }

    public function add_advise_investigations(){
        // return "dd";
        if(isset($_POST["submit_file"]))
        {
         $file = $_FILES["file"]["tmp_name"];
         $file_open = fopen($file,"r");
         while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
         {
          $user_id =  $csv[0];
          $name = $csv[1];
          $details = $csv[2];
          $price=$csv[3];
          $data = array('user_id' => user()->id,'name' =>$name,'details' =>$details,'price'=>$price);
          //var_dump($data);exit;
          $this->admin_model->insert($data, 'advise_investigations');
         }
         
        }
        $this->session->set_flashdata('msg', trans('inserted-successfully'));
        redirect(base_url('admin/advise_investigation'));
    }
}
?>