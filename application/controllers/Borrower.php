<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Borrower extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Borrower_model');
    }
    
    public function index() {
      if ($this->viewper[0]->borrowerlist == 0) {
         $this->permissionError();  
      }
        $data['areaList'] = $this->Borrower_model->loadArea();
        $data['m_officer'] = $this->Borrower_model->loadMarketingOfficer();
        $data['borrower_list'] = $this->Borrower_model->loadList();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/borrower_view');
        $this->load->view('template/footer');
    }

    public function submitForm() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');
        $blackList = $this->input->post('blackList');

        if (!empty($submit) && $submit == 'submit') {
            $this->addForm();
        } else if (!empty($update) && $update == 'update') {
            $this->updateForm();
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
        } else if (!empty($blackList) && $blackList == 'blackList') {
            $this->blackListCustomer();
        }
    }

    public function addForm() {
        if ($this->validate_form('insert')) {
            $result = $this->Borrower_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Borrower');
//                $this->index();
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
                $this->index();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index();
        }
    }
    
    public function updateForm() {
        if ($this->validate_form('edit')) {
            $result = $this->Borrower_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Borrower');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Update. Please try again.");
                $this->index();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index();
        }
    }
    public function blackListCustomer() {
        if ($this->validate_form('remove')) {
            $result = $this->Borrower_model->blackListCustomer();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "blacklisted successfully!.");
                redirect('Borrower');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to blacklist. Please try again.");
                $this->index();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index();
        }
    }
    public function removeForm() {
        if ($this->validate_form('remove')) {
            $result = $this->Borrower_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Borrower');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to remove. Please try again.");
                $this->index();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index();
        }
    }

    function validate_form($status) {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        if ($status == 'insert') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[borrower.name]');
            $this->form_validation->set_rules('nic', 'nic', 'required|trim|is_unique[borrower.nic]');
//            $this->form_validation->set_rules('id_areaList', 'Area', 'required|trim');
//            $this->form_validation->set_rules('id_marketing_officer', 'Marketing Officer', 'required|trim');
//            $this->form_validation->set_rules('contact_no', 'contact no', 'required|trim|is_unique[customer.contact_no]');
//            $this->form_validation->set_rules('joined_date', 'joined date', 'required|trim');
//            $this->form_validation->set_rules('gender', 'gender', 'required|trim');
//            $this->form_validation->set_rules('job', 'job', 'required|trim');
//            $this->form_validation->set_rules('distance', 'distance', 'required|trim');
//            $this->form_validation->set_rules('address', 'address', 'required|trim');
//            $this->form_validation->set_rules('communication_address', 'Communication Address', 'required|trim');
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('nic', 'nic', 'required|trim');
//            $this->form_validation->set_rules('id_areaList', 'Area', 'required|trim');
//            $this->form_validation->set_rules('id_marketing_officer', 'Marketing Officer', 'required|trim');
////            $this->form_validation->set_rules('relative_type', 'Relative Type', 'required|trim');
//            $this->form_validation->set_rules('contact_no', 'contact no', 'required|trim');
//            $this->form_validation->set_rules('gender', 'gender', 'required|trim');
//            $this->form_validation->set_rules('job', 'job', 'required|trim');
//            $this->form_validation->set_rules('distance', 'distance', 'required|trim');
//            $this->form_validation->set_rules('address', 'address', 'required|trim');
//            $this->form_validation->set_rules('communication_address', 'Communication Address', 'required|trim');
            $this->form_validation->set_rules('id_borrower', 'Borrower Id', 'required|trim', array('required'=> ' * Id for the Borrower was not found ! &nbsp; Please Select the Borrower and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_borrower', 'Id Borrower', 'required|trim', array('required'=> ' * Id for the Borrower was not found ! &nbsp; Please Select the Borrower and remove again.'));
        }
        
        return $this->form_validation->run();
//         $this->form_validation->run();
//         echo validation_errors();
//                exit();
    }
    
    
    
}
// end of class 
