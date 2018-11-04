<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoanProduct extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('loan_product_model');
    }
    
 
      public function index() {
          if ($this->viewper[0]->loanproductlist == 0) {
         $this->permissionError();  
      }
        $data['loan_product'] = $this->loan_product_model->loadList();
//         echo "<pre>"; print_r($data['loan_types']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/loan_product_list');
        $this->load->view('template/footer');
    }
 
      public function index2() {
           if ($this->viewper[0]->loanproductlist == 0) {
         $this->permissionError();  
      }
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/loan_product_view');
        $this->load->view('template/footer');
    }
 
      public function updateView() {
           if ($this->viewper[0]->loanproductlist == 0) {
         $this->permissionError();  
      }
          $loan_product_id = $this->input->post("loan_product_id");
        $data['loan_product'] = $this->loan_product_model->getLoanProduct($loan_product_id);
//         echo "<pre>"; print_r($data['loan_product']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/loan_product_update');
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
         if ($this->saveper[0]->loanproductlist == 0) {
         $this->permissionError(); 
         return false;
      }
        if ($this->validate_form('insert')) {
            $result = $this->loan_product_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('LoanProduct');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
                $this->index2();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index2();
        }
    }
    
    public function updateForm() {
        if ($this->editper[0]->loanproductlist == 0) {
         $this->permissionError(); 
         return false;
      }
        if ($this->validate_form('edit')) {
            $result = $this->loan_product_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('LoanProduct');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Update. Please try again.");
                $this->index2();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index2();
        }
    }
    public function removeForm() {
        if ($this->deleteper[0]->loanproductlist == 0) {
         $this->permissionError(); 
         return false;
      }
        if ($this->validate_form('remove')) {
            $result = $this->loan_product_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('LoanProduct');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to remove. Please try again.");
                $this->index2();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->index2();
        }
    }

    function validate_form($status) {
        $this->load->library('form_validation'); 

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        if ($status == 'insert') {
            $this->form_validation->set_rules('loan_product_name', 'Loan Product', 'required|trim');
            $this->form_validation->set_rules('disbursed_by', 'Disbursed By', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('loan_product_name', 'Loan Product', 'required|trim');
            $this->form_validation->set_rules('disbursed_by', 'Disbursed By', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('id_loan_product', 'Loan Product Id', 'required|trim', array('required'=> ' * Id for the loan Product was not found ! &nbsp; Please Select the loan Product and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_loan_product', 'Id Product Type', 'required|trim', array('required'=> ' * Id for the loan Product was not found ! &nbsp; Please Select the loan Product and remove again.'));
        }
        return $this->form_validation->run();
    }
    
}
// end of class 
