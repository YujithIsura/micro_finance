<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingOfficer extends MY_Controller {

    
    function __construct() {
        parent::__construct();
        $this->load->model('marketing_officer_model');
    }
    
    public function index() {
        if ($this->viewper[0]->loanofficerlist == 0) {
         $this->permissionError();  
      }
        $data['collector_list'] = $this->marketing_officer_model->loadList();
//        $data['branch_list'] = $this->marketing_officer_model->loadBranchList();
//         echo "<pre>"; print_r($data['branch_list']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/marketing_officer_view');
        $this->load->view('template/footer');
    }

//    public function viewAssetsList() {
//        
//    }
    public function submitForm() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($submit) && $submit == 'submit') {
            $this->addForm();
        } else if (!empty($update) && $update == 'update') {
            $this->updateForm();
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
        }
    }

    public function addForm() {
        if ($this->validate_form('insert')) {
            $result = $this->marketing_officer_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('MarketingOfficer');
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
            $result = $this->marketing_officer_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('MarketingOfficer');
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
    public function removeForm() {
        if ($this->validate_form('remove')) {
            $result = $this->marketing_officer_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('MarketingOfficer');
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
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
//            $this->form_validation->set_rules('nic', 'nic', 'required|trim');
//            $this->form_validation->set_rules('joined_date', 'joined date', 'required|trim');
//            $this->form_validation->set_rules('contact_no', 'contact no', 'required|trim');
//            $this->form_validation->set_rules('branch', 'branch', 'required|trim');
//            $this->form_validation->set_rules('address', 'address', 'required|trim');
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
//            $this->form_validation->set_rules('nic', 'nic', 'required|trim');
//            $this->form_validation->set_rules('joined_date', 'joined date', 'required|trim');
//            $this->form_validation->set_rules('contact_no', 'contact no', 'required|trim');
//            $this->form_validation->set_rules('branch', 'branch', 'required|trim');
//            $this->form_validation->set_rules('address', 'address', 'required|trim');
            $this->form_validation->set_rules('id_marketing_officer', 'Marketing Officer Id', 'required|trim', array('required'=> ' * Id for the Marketing Officer was not found ! &nbsp; Please Select the Marketing Officer and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_marketing_officer', 'Marketing Officer Id ', 'required|trim', array('required'=> ' * Id for the Marketing Officer was not found ! &nbsp; Please Select the Marketing Officer and remove again.'));
        }
        return $this->form_validation->run();
    }
    
    
    
    // ******************************** Marketing Officer******************************************
 
    
}
// end of class 
