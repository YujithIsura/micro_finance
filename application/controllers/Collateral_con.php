<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Collateral_con extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('guarantor_model');
        $this->load->model('collateral_model');
    }
    
 
      public function index() {
          if ($this->viewper[0]->loancollaterallist == 0) {
         $this->permissionError();  
      }
        $data['collateralList'] = $this->collateral_model->loadCollateralList();
        $data['typeList'] = $this->collateral_model->loadCollateralType();
//         echo "<pre>"; print_r($data['collateralList']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/collateral_list');
        $this->load->view('template/footer');
    }
 
      public function index2($loan_id='') {
          if ($this->viewper[0]->loancollaterallist == 0) {
         $this->permissionError();  
      }
          $data['typeList'] = $this->collateral_model->loadCollateralType();
          $data['loan_id'] = $loan_id;
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/add_collateral_view');
        $this->load->view('template/footer');
    }
 
      public function updateView() {
          if ($this->viewper[0]->loancollaterallist == 0) {
         $this->permissionError();  
      }
          $loan_collateral_id = $this->input->post("loan_collateral_id");
          $fromLoanCenter=0;
          $fromLoanCenter = $this->input->post("fromLoanCenter");
       $data['fromLoanCenter'] = $fromLoanCenter;
       $data['typeList'] = $this->collateral_model->loadCollateralType();
       $data['collateralData'] = $this->collateral_model->loadCollateralDataById($loan_collateral_id);
//         echo "<pre>"; print_r($data['collateralData']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/update_collateral_view');
        $this->load->view('template/footer');
    }

    public function submitForm() {
        $saveClose = $this->input->post('saveClose');
        $updateClose = $this->input->post('updateClose');
        $saveNew = $this->input->post('saveNew');
        $remove = $this->input->post('remove');
        
        if (!empty($saveClose) && $saveClose == 'saveClose') {
//                echo 'submit';
            $this->addForm1();
        } else if (!empty($saveNew) && $saveNew == 'saveNew') {
            $this->addForm2();
//            echo 'update'.$this->input->post('id_assetsList');
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
//            echo 'remove';
        }else if (!empty($updateClose) && $updateClose == 'updateClose') {
            $this->updateForm();
//            echo 'remove';
        }
    }

    public function addForm1() {
        if ($this->saveper[0]->loancollaterallist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('insert')) {
            $result = $this->collateral_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Collateral_con');
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

    public function addForm2() {
        if ($this->saveper[0]->loancollaterallist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('insert')) {
            $result = $this->guarantor_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Guarantor_con/index2');
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
        if ($this->editper[0]->loancollaterallist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('edit')) {
            $result = $this->collateral_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Collateral_con');
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
        if ($this->deleteper[0]->loancollaterallist == 0) {
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
            $this->form_validation->set_rules('loan_id', 'Loan ID', 'required|trim');
            $this->form_validation->set_rules('collateral_type', 'Collateral type', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('loan_id', 'Loan ID', 'required|trim');
            $this->form_validation->set_rules('collateral_type', 'Collateral type', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('loan_collateral_id', 'Collateral Id', 'required|trim', array('required'=> ' * Id for the Collateral was not found ! &nbsp; Please Select the Collateral and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('loan_collateral_id', 'Collateral Id', 'required|trim', array('required'=> ' * Id for the Collateral was not found ! &nbsp; Please Select the Collateral and remove again.'));
        }
        return $this->form_validation->run();
    }
    
}
// end of class 
