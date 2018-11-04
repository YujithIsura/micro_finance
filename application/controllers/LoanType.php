<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoanType extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('loan_model');
    }
    
    public function index() {
//        $data='';
        $data['loan_types'] = $this->loan_model->loadList();
//         echo "<pre>"; print_r($data['loan_types']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/loan_types_view');
        $this->load->view('template/footer');
    }

    public function submitForm() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($submit) && $submit == 'submit') {
//                echo 'submit';
            $this->addForm();
        } else if (!empty($update) && $update == 'update') {
            $this->updateForm();
//            echo 'update'.$this->input->post('id_assetsList');
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
//            echo 'remove';
        }
    }

    public function addForm() {
        if ($this->validate_form('insert')) {
            $result = $this->loan_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Loan');
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
            $result = $this->loan_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Loan');
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
            $result = $this->loan_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Loan');
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
            $this->form_validation->set_rules('loan_type_name', 'Loan Type', 'required|trim');
            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('loan_type_name', 'Loan Type', 'required|trim');
            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('id_loan_type', 'Loan Type Id', 'required|trim', array('required'=> ' * Id for the loan type was not found ! &nbsp; Please Select the loan type and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_loan_type', 'Id Loan Type', 'required|trim', array('required'=> ' * Id for the loan type was not found ! &nbsp; Please Select the loan type and remove again.'));
        }
        return $this->form_validation->run();
    }
    
}
// end of class 
