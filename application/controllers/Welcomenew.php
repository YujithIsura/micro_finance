<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('common_model');
    }

    public function index()
    {
        if ($this->session->userdata('session_user_data'))
        {
            $this->dashbord();
        }else{
          //  $this->load->view('template/Login_new');
            $this->load->view('template/login_pageNew');

        }
    }
    
    public function newLogin()
    {
        $this->load->view('template/login_pageNew');
    }

    public function login(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', ' Password', 'required');

        if ($this->form_validation->run()) {
            $user_name = $this->input->post('username');
            $password = $this->input->post('password');

            $result = $this->common_model->check_user($user_name, $password);

            $this->load->model("Security_model");


            if ($result) {
                $result2 = $this->common_model->validate_user($user_name);
                if($result2 OR $user_name=='super admin'){
                    $this->common_model->login_log($user_name);
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

    public function login2(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', ' Password', 'required');

        if ($this->form_validation->run()) {
            $user_name = $this->input->post('username');
            $password = $this->input->post('password');
//            exit($user_name . ' - '.$password);
            $result = $this->common_model->check_user2($user_name, $password);
            if ($result) {
                $this->common_model->login_log($user_name);

                $this->dashbord();
            } else {
                $this->session->set_flashdata('message', 'invalied_user');
                $this->index();
            }
        } else {
            $this->index();
//            $this->load->view('login_page');
        }
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

    function dashbord() {
//        $from = $this->input->post('from_md_txt');
//        $to = $this->input->post('to_md_txt');
//        $this->dashbordChart($from, $to);
        if (!$this->session->userdata('session_user_data'))
        {
            redirect('Welcome');
        }else{
            $uname=$_SESSION['session_user_data']['userName'];
            $result =   $this->db->query("SELECT * FROM useraccount_save_1 WHERE uname='$uname'");
            $this->saveper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_edit_1 WHERE uname='$uname'");
            $this->editper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_view_1 WHERE uname='$uname'");
            $this->viewper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_delete_1 WHERE uname='$uname'");
            $this->deleteper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_print_1 WHERE uname='$uname'");
            $this->printper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_export_1 WHERE uname='$uname'");
            $this->exportper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_email_1 WHERE uname='$uname'");
            $this->emailper=$result->result();

            $result =   $this->db->query("SELECT status FROM useracc WHERE userName='$uname'")->result();
            $this->usertypemain=strtolower($result[0]->status);

        }
        $year=date("Y");
        $month=date("m");
        $year2=$year+1;

        if($month>4){
            $year=date("Y");
            $year2=$year+1;
        }else{
            $year=date("Y");
            $year2=$year;
            $year=$year-1;
        }


        $data['data1']=$this->common_model->getDashData1($year,$year2);
        $data['data2']=$this->common_model->getMonthlyIncome($year,$year2);
        $data['data3']=$this->common_model->getMonthlyExpence($year,$year2);
        $data['data4']=$this->common_model->getMonthlyExpenses($year,$year2);
        $data['year']=$year;
        $data['year2']=$year2;
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('dashbord');
        $this->load->view('template/footer');
    }

    function getDashboard(){
        $year=date("Y");
        $month=date("m");
        $year2=$year+1;

        if($month>4){
            $year=date("Y");
            $year2=$year+1;
        }else{
            $year=date("Y");
            $year2=$year;
            $year=$year-1;
        }

        $data['data1']=$this->common_model->getDashData1($year,$year2);
        $data['data2']=$this->common_model->getMonthlyIncome($year,$year2);
        $data['data3']=$this->common_model->getMonthlyExpence($year,$year2);
        $data['data4']=$this->common_model->getMonthlyExpenses($year,$year2);
        $data['year']=$year;
        $data['year2']=$year2;

        $this->load->view('dashbord_data',$data);

    }

    function dashbord2($year,$year2) {
//        $from = $this->input->post('from_md_txt');
//        $to = $this->input->post('to_md_txt');
//        $this->dashbordChart($from, $to);
        if (!$this->session->userdata('session_user_data'))
        {
            redirect('Welcome');
        }else{
            $uname=$_SESSION['session_user_data']['userName'];
            $result =   $this->db->query("SELECT * FROM useraccount_save_1 WHERE uname='$uname'");
            $this->saveper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_edit_1 WHERE uname='$uname'");
            $this->editper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_view_1 WHERE uname='$uname'");
            $this->viewper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_delete_1 WHERE uname='$uname'");
            $this->deleteper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_print_1 WHERE uname='$uname'");
            $this->printper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_export_1 WHERE uname='$uname'");
            $this->exportper=$result->result();

            $result =   $this->db->query("SELECT * FROM useraccount_email_1 WHERE uname='$uname'");
            $this->emailper=$result->result();

            $result =   $this->db->query("SELECT status FROM useracc WHERE userName='$uname'")->result();
            $this->usertypemain=strtolower($result[0]->status);

        }
        $data['data1']=$this->common_model->getDashData1($year,$year2);
        $data['data2']=$this->common_model->getMonthlyIncome($year,$year2);
        $data['data3']=$this->common_model->getMonthlyExpence($year,$year2);
        $data['data4']=$this->common_model->getMonthlyExpenses($year,$year2);;
        $data['year']=$year;
        $data['year2']=$year2;
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('dashbord');
        $this->load->view('template/footer');
    }

    function submitForm(){

        $from = $this->input->post('from_md_txt');
        $to = $this->input->post('to_md_txt');
        $year=$this->input->post("year_md_txt");

        if($year=="this"){

            $this->dashbord();
        }
        if($year=="last"){
            $year=date("Y")-1;
            $year2=$year+1;
            $this->dashbord2($year,$year2);
        }
        if($year=="custom"){
            $year=explode("-",$from);
            $year=$year[0];
            $year2=explode("-",$to);
            $year2=$year2[0];
            $this->dashbord2($year,$year2);
        }

    }

    function dashbordChart($from, $to) {
        $data['from'] = $from;
        $data['to'] = $to;
        $data['income'] = $this->Chart_Model->income_Chart();
        $data['expence'] = $this->Chart_Model->expence_Chart();
        $data['inDate'] = $this->Chart_Model->income_Month();
        $data['exDate'] = $this->Chart_Model->expence_Month();
        // echo "<pre>"; print_r($data['inDate']);  exit();
        //echo "<pre>"; print_r($data['income']);  exit();
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('dashbordChart');
        $this->load->view('template/footer');
    }

//    public function submitForm() {
////        $from = $this->input->post('from_md_txt');
////        $to = $this->input->post('to_md_txt');
////
////        $this->income_Chart();
////        $this->expence_Chart();
////        $this->expence_Month();
////        $this->income_Month();
////        $this->dashbordChart($from, $to);
//    }

    public function income_Chart(){
        $this->Chart_Model->income_Chart();
    }

    public function expence_Chart(){
        $this->Chart_Model->expence_Chart();
    }
    public function expence_Month(){
        $this->Chart_Model->expence_Month();
    }
    public function income_Month(){
        $this->Chart_Model->income_Month();
    }
}
