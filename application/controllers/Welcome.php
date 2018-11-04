<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/*
 * Micro Finance 
 * Developer : Yujith
 * Date : 2018-04-01
 */
class Welcome extends CI_Controller {

	
    function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
    }

    public function index()
    {
        if ($this->session->userdata('session_user_data'))
        {
            $this->dashbord();
        }else{
            $this->load->view('template/login_pageNew');

        }
    }
    
    
    public function login(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', ' Password', 'required');

        if ($this->form_validation->run()) {
            $user_name = $this->input->post('username');
            $password = $this->input->post('password');

            $result = $this->Common_model->check_user($user_name, $password);

            $this->load->model("Security_model");


            if ($result) {
                $result2 = $this->Common_model->validate_user($user_name);
                if($result2 OR $user_name=='super admin'){
                    $this->Common_model->login_log($user_name);
                    $this->Security_model->set_login_time($user_name);

                    if(!empty($_SESSION['new'])){
                        $url_new    =   $_SESSION['new'];
                        $_SESSION['new']="";
                        redirect($url_new);
                    }else{
                        $this->dashbord();
                    }
                }else{
                    $this->session->set_flashdata('message', 'user_already_logged');
                    $this->index();
                }
            } else {
                $this->session->set_flashdata('message', 'invalied_user');
                $this->index();
            }
        } else {
            $this->index();
        }
    }
    
    function dashbord() {
        
//        if (!$this->session->userdata('session_user_data'))
//        {
//            redirect('Welcome');
//        }else{
//            $data['uname']=$_SESSION['session_user_data']['userName'];
//            print_r($uname);
//            $result =   $this->db->query("SELECT * FROM useraccount_save_1 WHERE uname='$uname'");
//            $this->saveper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_edit_1 WHERE uname='$uname'");
//            $this->editper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_view_1 WHERE uname='$uname'");
//            $this->viewper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_delete_1 WHERE uname='$uname'");
//            $this->deleteper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_print_1 WHERE uname='$uname'");
//            $this->printper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_export_1 WHERE uname='$uname'");
//            $this->exportper=$result->result();
//
//            $result =   $this->db->query("SELECT * FROM useraccount_email_1 WHERE uname='$uname'");
//            $this->emailper=$result->result();
//
//            $result =   $this->db->query("SELECT status FROM useracc WHERE userName='$uname'")->result();
//            $this->usertypemain=strtolower($result[0]->status);
//
//        }
//        $year=date("Y");
//        $month=date("m");
//        $year2=$year+1;
//
//        if($month>4){
//            $year=date("Y");
//            $year2=$year+1;
//        }else{
//            $year=date("Y");
//            $year2=$year;
//            $year=$year-1;
//        }
//
//
//        $data['data1']=$this->common_model->getDashData1($year,$year2);
//        $data['data2']=$this->common_model->getMonthlyIncome($year,$year2);
//        $data['data3']=$this->common_model->getMonthlyExpence($year,$year2);
//        $data['data4']=$this->common_model->getMonthlyExpenses($year,$year2);
//        $data['year']=$year;
//        $data['year2']=$year2;
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('blank');
        $this->load->view('template/footer');
    }
    
     function logout() {
        $sess_array = $this->session->userdata('session_user_data');


        $this->load->model("Security_model");

        $username	=	$_SESSION['session_user_data']['userName'];

        $this->Security_model->remove_login_time($username);

        if (isset($sess_array)){
            $this->session->unset_userdata('session_user_data');
        }
        $this->index();
    }
}
