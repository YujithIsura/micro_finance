<?php


class MY_Controller extends CI_Controller
{
    
    public $usertypemain;
    public $username;
    public $saveper;
    public $editper;
    public $viewper;
    public $deleteper;
   
                function __construct()
    {
        parent::__construct();

        $this->load->library('session');

        if (!$this->session->userdata('session_user_data')) {
            if ($_SERVER['REQUEST_METHOD'] == "GET" OR empty($_SERVER['REQUEST_METHOD'])) {
                $_SESSION['new'] = current_url();
            }

            redirect('Welcome');
        } else {
            $uname = $_SESSION['session_user_data']['userName'];
            $this->username = $_SESSION['session_user_data']['userName'];
            $this->load->model("Security_model");

            $this->Security_model->set_last_access($uname);
            
            $result = $this->db->query("SELECT * FROM user_permission_save WHERE userName='$uname'");
            $this->saveper = $result->result();

            $result = $this->db->query("SELECT * FROM user_permission_edit WHERE userName='$uname'");
            $this->editper = $result->result();

            $result = $this->db->query("SELECT * FROM user_permission_view WHERE userName='$uname'");
            $this->viewper = $result->result();

            $result = $this->db->query("SELECT * FROM user_permission_delete WHERE userName='$uname'");
            $this->deleteper = $result->result();

            $result = $this->db->query("SELECT status FROM useracc WHERE userName='$uname'")->result();
            if (isset($result[0])) {
                $this->usertypemain = strtolower($result[0]->status);
            } else {
                $this->usertypemain = "";
            }
           


        }
    }

    public function permissionError()
    {
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('permissionError.php');
        $this->load->view('template/footer');
    }
    
    
}
