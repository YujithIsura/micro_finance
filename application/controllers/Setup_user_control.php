<?php

defined('BASEPATH') OR exit('No Detrct Script Access Allowed!.');
ini_set('display_errors', 1);

class Setup_user_control  extends MY_Controller {
     public function __construct() { 
        parent::__construct();
        $this->load->model('Setup_user_model');
    }
    
     public function index($status = 'hide') { 
         
        $data['user_list'] = $this->Setup_user_model->getUserList();
        $data['status'] = $status; 
//          print_r($data['list']);
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('setup_user_view',$data);       
        $this->load->view('template/footer');
    }
    
    public function CreateUser($status = 'hide'){
      
         $this->Setup_user_model->insert();
         $data['user_list'] = $this->Setup_user_model->getUserList();
        $data['status'] = $status; 
        
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('setup_user_view',$data);       
        $this->load->view('template/footer');
    }
    public function insert(){
        if($this->usertypemain!="admin"){
            $this->permissionError();
            return false;
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|callback_check',array('Password Confirmation','requird'));
        
    
        if ($this->form_validation->run() == FALSE)
        {
           $this->index();
        }
        else
            {
            $this->Setup_user_model->insert();
            $this->index('hide');
        }
        
        
        
    }
    public function insert1(){
        if($this->usertypemain!="admin"){
            $this->permissionError();
            return false;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required|callback_check',array('Password Confirmation','requird'));
        
        

        if ($this->form_validation->run() == FALSE)
        {
            
         $this->index();
        }
        else
        {
        $this->Setup_user_model->insert();
        $this->index('show');
        }
        
        
        
    }
    public function check(){
        if($this->usertypemain!="admin"){
            $this->permissionError();
            return false;
        }
        if($this->Setup_user_model->checkPassword()){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    public function update_view($id){
        
        $data['list'] = $this->Setup_user_model->get_user_for_update($id);
         $data['list'] = $this->Setup_user_model->permission($id);
        $data['saveper']=$this->Setup_user_model->getPermissionSave($data['list'][0]->userName);
        $data['editper']=$this->Setup_user_model->getPermissionEdit($data['list'][0]->userName);
         $data['deleteper']=$this->Setup_user_model->getPermissionDelete($data['list'][0]->userName);
         $data['viewper']=$this->Setup_user_model->getPermissionView($data['list'][0]->userName);
        
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('setup_user_update_view',$data);
        $this->load->view('template/footer');
    }
    public function updateForm($id){

         $result =  $this->Setup_user_model->UpdateUser($id);

           if($result){
               $this->session->set_flashdata("success_msg", "Update Successfully");
               redirect(base_url('Setup_user_control'));
           }else{
               $this->session->set_flashdata("error_msg", "Update Failed!,Try Again");
               redirect(base_url('Setup_user_control/update_view/' . $id));
           }

    }



     public function savePwPopup() {
        $this->Setup_user_model->savePwPopup();
    }
    public function removeData($id){
        if($this->usertypemain!="admin"){
            $this->permissionError();
            return false;
        }
         $this->Setup_user_model->remove($id);
         $this->index();
    }
    public function submitForm(){
        
        $id     =   $this->input->post("id");
        $submit=  $this->input->post('submit');
        $update=  $this->input->post('edit');
        $remove=  $this->input->post('Remove');
        
        
        if ($update=='edit') { 
            $this->updateForm($id);           
        }
        if ($remove=='Remove') {
            $this->removeData($id);
        }
    }
     public function submitForm1(){
         if($this->usertypemain!="admin"){
            $this->permissionError();
            return false;
        }
        $saveClose  =  $this->input->post('Save&Close');
        $saveNew =  $this->input->post('Save&New');
       
        
        
        if ($saveClose=='Save&Close') { 
            $this->insert();
            
            
        }
        if ($saveNew=='Save&New') {
            $this->insert1();
        }
    }



    public function assignPermission(){
        
       $id = $this->input->post('user');
     
        $data['list'] = $this->Setup_user_model->permission($id);
        $data['list'] = $this->Setup_user_model->get_user_for_update($id);
        $data['saveper']=$this->Setup_user_model->getPermissionSave($data['list'][0]->userName);
        $data['editper']=$this->Setup_user_model->getPermissionEdit($data['list'][0]->userName);
         $data['deleteper']=$this->Setup_user_model->getPermissionDelete($data['list'][0]->userName);
         $data['viewper']=$this->Setup_user_model->getPermissionView($data['list'][0]->userName);
         
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('setup_user_update_view',$data);
        $this->load->view('template/footer');
      
        
    }
    
    public function ConfirmPermission(){
//        if($this->usertypemain!="admin"){
//            $this->permissionError();
//            return false;
//        }
        $id = $this->input->post('user');
        $submit = $this->input->post('submit');
        
       // $this->input->post('user');
        $data['id']   = $id;
        $data['list'] = $this->Setup_user_model->permission($id);
        $this->Setup_user_model->confirmPermission();
         $data['saveper']=$this->Setup_user_model->getPermissionSave($data['list'][0]->userName);
         $data['editper']=$this->Setup_user_model->getPermissionEdit($data['list'][0]->userName);
         $data['deleteper']=$this->Setup_user_model->getPermissionDelete($data['list'][0]->userName);
         $data['viewper']=$this->Setup_user_model->getPermissionView($data['list'][0]->userName);
         
//         print_r($data['editper'][0]->classlist);
//         
	if($submit=="submit"){
		$this->index();
	}else{
		
	$this->assignPermission();
		}
      
    }
//    public function reset(){
//        $this->load->library('session');
//        $dataArray = array(
//            
//             
//            'username'  =>   $this->input->post('username1'),
//            'password'  =>   $this->input->post('password1'),
//            'cpassword' =>   $this->input->post('cpassword1'),
//            'name'      =>   $this->input->post('name1'),
//            'usertype'  =>   $this->input->post('usertype1')
//        );
//        $this->session->userdata($dataArray);
//    } 
    
    function checkAdminUser(){
        $user   =   $this->input->post("adminuser");
        $pass   =   $this->input->post("adminpass");
        
        $pass   =   md5($pass);
        
        $result =   $this->db->query("SELECT * FROM useracc WHERE userName='$user' AND password='$pass' AND status='Admin' ")->result();
        
        echo count($result);
    }
}
