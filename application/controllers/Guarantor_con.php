<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Guarantor_con extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('guarantor_model');
    }
    
 
      public function index() {
          if ($this->viewper[0]->guaranterlist == 0) {
         $this->permissionError();  
      }
        $data['guarantor'] = $this->guarantor_model->loadList();
//         echo "<pre>"; print_r($data['loan_types']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/guarantor_list');
        $this->load->view('template/footer');
    }
 
      public function index2() {
          if ($this->saveper[0]->guaranterlist == 0) {
         $this->permissionError();  
      }
          $data['areaList'] = $this->guarantor_model->loadArea();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/add_guarantor_view');
        $this->load->view('template/footer');
    }
 
      public function updateView() {
          if ($this->viewper[0]->guaranterlist == 0) {
         $this->permissionError();  
      }
          $guarantor_id = $this->input->post("guarantor_id");
          $data['guarantor'] = $this->guarantor_model->getGuarantor($guarantor_id);
          $data['areaList'] = $this->guarantor_model->loadArea();
//         echo "<pre>"; print_r($data['guarantor']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/update_guarantor_view');
        $this->load->view('template/footer');
    }

    public function submitForm() {
        $saveClose = $this->input->post('saveClose');
        $saveNew = $this->input->post('saveNew');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');
        
        if (!empty($saveClose) && $saveClose == 'saveClose') {
//                echo 'submit';
            $this->addForm1();
        } else if (!empty($saveNew) && $saveNew == 'saveNew') {
            $this->addForm2();
//            echo 'update'.$this->input->post('id_assetsList');
        } else if (!empty($update) && $update == 'update') {
            $this->updateForm();
//            echo 'remove';
        }
        else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
//            echo 'remove';
        }
    }

    public function addForm1() {
        if ($this->saveper[0]->guaranterlist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('insert')) {
            $result = $this->guarantor_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Guarantor_con');
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
        if ($this->saveper[0]->guaranterlist == 0) {
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
        if ($this->editper[0]->guaranterlist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('edit')) {
            $result = $this->guarantor_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Guarantor_con');
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
        if ($this->deleteper[0]->guaranterlist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('remove')) {
            $result = $this->guarantor_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Guarantor_con');
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
            $this->form_validation->set_rules('guarantor_name', 'Guarantor Name', 'required|trim');
            $this->form_validation->set_rules('nic', 'NIC NO', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('guarantor_name', 'Guarantor Name', 'required|trim');
            $this->form_validation->set_rules('nic', 'NIC NO', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('guarantor_id', 'Guarantor Id', 'required|trim', array('required'=> ' * Id for the Guarantor was not found ! &nbsp; Please Select the Guarantor and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('guarantor_id', 'Guarantor Id', 'required|trim', array('required'=> ' * Id for the Guarantor was not found ! &nbsp; Please Select the Guarantor and remove again.'));
        }
        return $this->form_validation->run();
    }
    
}
// end of class 
