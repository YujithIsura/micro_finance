<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
 * Developer : Yujith Isura.
 * Date : 2018-04-01 
 */

//exit('sdfsf');
defined('BASEPATH') OR exit('No direct script access allowed!');

class Mycompany_controll extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mycompany_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
//        if($this->viewper[0]->company==1){}else{$this->permissionError();return false;} 
        $data['first_menu'] = 'master_table';
        $data['second_menu'] = 'Mycompany_List';
//        $data['thired_menu'] = 'ledger';
        $data['list'] = $this->Mycompany_model->listCompany();
        //echo "<pre>"; print_r($data); exit();
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/Mycompany_List_View');
        $this->load->view('template/footer');
    }
 
    public function LoadMycompanyView() {
        if($this->viewper[0]->company==1){}else{$this->permissionError();return false;} 
        $data['first_menu'] = 'master_table';
        $data['second_menu'] = 'Mycompany_Add';
//        $data['thired_menu'] = 'ledger';
        $data['currency'] = $this->Mycompany_model->loadCurrency();
//          echo "<pre>"; print_r($data); exit();
        $data['terms'] = $this->Mycompany_model->loadTerms();
        $data['ref'] = $this->Mycompany_model->loadRef();
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/Mycompany_Add_View');
        $this->load->view('template/footer');
    }

    public function submitForm() {        
        $save_close = $this->input->post('save_close');
        $save_new = $this->input->post('save_new');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($save_close) && $save_close == 'sv_c') {
            if($this->saveper[0]->company==1){}else{$this->permissionError();return false;} 
            $this->SC_insertData();
        } elseif (!empty($save_new) && $save_new == 'sv_nw') {
            if($this->saveper[0]->company==1){}else{$this->permissionError();return false;} 
            $this->SN_insertData();
        } elseif (!empty($update) && $update == 'update') {
//            if($this->editper[0]->company==1){}else{$this->permissionError();return false;} 
            $this->updateData();
        } elseif (!empty($remove) && $remove == 'remove') {
            if($this->deleteper[0]->company==1){}else{$this->permissionError();return false;} 
            $this->removeData();
        }
    }

   
    public function saveAddCurrencyPopup() {
        $this->Mycompany_model->saveAddCurrencyPopup();
    }

    public function SC_insertData() {
        if($this->saveper[0]->company==1){}else{$this->permissionError();return false;} 

        if ($this->validate_form('insert')) {
            $result = $this->Mycompany_model->insertData();

            if ($result) {
//                    $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                $this->index();
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
                redirect(base_url('Mycompany_Controll/LoadMycompanyView'));
            }
        } else {
            $this->session->set_flashdata("error_msg", "Form submission error!.");
//            $this->LoadCustomerView();
            redirect(base_url('Mycompany_Controll/LoadMycompanyView'));
        }
    }

    public function SN_insertData() {
        if($this->saveper[0]->company==1){}else{$this->permissionError();return false;} 
        if ($this->validate_form('insert')) {
            $result = $this->Mycompany_model->insertData();

            if ($result) {
//                    $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                $this->LoadMycompanyView();
            } else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->LoadCustomerView();
                redirect(base_url('Mycompany_Controll/LoadMycompanyView'));
            }
        } else {
            $this->session->set_flashdata("error_msg", "Form submission error!.");
//            $this->LoadCustomerView();
            redirect(base_url('Mycompany_Controll/LoadMycompanyView'));
        }
    }

    public function updateData() {
//        if($this->editper[0]->company==1){}else{$this->permissionError();return false;} 
        $cusID = $this->input->post('comID');
       // echo $cusID; exit('sdgfsdfgsdf');
        if ($this->validate_form('edit')) {
            $username	=	$_SESSION['session_user_data']['userName'];
            $result = $this->Mycompany_model->updateData($cusID);

            if ($result) {
                $this->session->set_flashdata("success_msg", "Update successfully!.");
                $sess_array = $this->session->userdata('session_user_data');


                $this->load->model("Security_model");



                $this->Security_model->remove_login_time($username);

                if (isset($sess_array)){
                    $this->session->unset_userdata('session_user_data');
                }
                    redirect("Welcome");
//                $this->index();
            }else {
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
              //  $this->selectUpdate($cusID);
            }

        } else {
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->selectUpdate($cusID);
//            redirect(base_url('Mycompany_Controll/selectUpdate($cusID")'));
        }
    }

  
    public function selectUpdate($id) {
//        if($this->viewper[0]->company==1){}else{$this->permissionError();return false;} 
        $this->load->model('Mycompany_model');
//        $data['currency'] = $this->Mycompany_model->loadCurrency();
       // $data['terms'] = $this->Mycompany_model->loadTerms();
        //$data['ref'] = $this->Mycompany_model->loadRef();
        $data['company'] = $this->Mycompany_model->GetselectUpdate($id);
       
          
//      echo "<pre>"; print_r($data);  exit();

        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/Mycompany_Update_View');
        $this->load->view('template/footer');
    }

    function validate_form($status) {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');

        if ($status == 'insert' || $status == 'edit') {
//            exit('sdf');
            $this->form_validation->set_rules('company_md_txt', 'Company Name', 'required|trim');
            //$this->form_validation->set_rules('company_md_txt', 'contact', 'required|trim');
            //$this->form_validation->set_rules('email_md_txt', 'E mail', 'required|trim');
            //$this->form_validation->set_rules('phone_md_txt', 'Phone', 'required|trim');
        }
//        if ($status == 'edit') {
//            $this->form_validation->set_rules('name', 'Customer Name', 'required|trim');
//            $this->form_validation->set_rules('code', 'Code', 'required|trim');
//            $this->form_validation->set_rules('email', 'Email', 'required|trim');
//            $this->form_validation->set_rules('contact', 'Contact', 'required|trim');
//        }
//        if ($status == 'remove') {
//            $this->form_validation->set_rules('name', 'Class Name', 'required|trim', array('required' => ' * Class for the Area was not found ! &nbsp; Please Select area and remove again.'));
//        }
//        echo $this->form_validation->run();
//        exit();
        return $this->form_validation->run();
//        exit();
    }

}

