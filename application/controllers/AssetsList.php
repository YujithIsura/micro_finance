<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AssetsList extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('assets_model');
    }
    
    public function index() {
        if ($this->viewper[0]->collateraltypelist == 0) {
         $this->permissionError();  
      }
        
        $data['list'] = $this->assets_model->loadList();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/assets_type_list');
        $this->load->view('template/footer');
    }

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
         if ($this->saveper[0]->collateraltypelist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('insert')) {
            $result = $this->assets_model->addForm();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('AssetsList');
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
         if ($this->editper[0]->collateraltypelist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('edit')) {
            $result = $this->assets_model->updateForm();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('AssetsList');
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
         if ($this->deleteper[0]->collateraltypelist == 0) {
         $this->permissionError();  
         return false;
      }
        if ($this->validate_form('remove')) {
            $result = $this->assets_model->removeForm();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('AssetsList');
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
            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[assetslist.name]');
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('id_assetsList', 'Id AreaList', 'required|trim', array('required'=> ' * Id for the Area was not found ! &nbsp; Please Select area and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_assetsList', 'Id AreaList', 'required|trim', array('required'=> ' * Id for the Area was not found ! &nbsp; Please Select area and remove again.'));
        }
        return $this->form_validation->run();
    }
  
    // ******************************** assest details******************************************
    
     public function assest_detail() {
        	
        $data['asset_details'] = $this->assets_model->loadAssetDetail();
        $data['assetTypes'] = $this->assets_model->loadAssetTypes();
//        $data['loanTypes'] = $this->assets_model->loadLoanTypes();
        $data['borrower_list'] = $this->assets_model->loadBorrowers();
//        $data['max_id'] = $this->assets_model->get_max_id();
//         echo "<pre>"; print_r($data['borrower_list']);  exit();
//         echo "<pre>"; print_r($data['asset_details']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/asset_detail');
        $this->load->view('template/footer');
    }
    
      public function submitAssetDetail() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($submit) && $submit == 'submit') {
            $this->addAssetDetail();
        } else if (!empty($update) && $update == 'update') {
            $this->updateAssetDetail();
            $this->input->post('id_assetsList');
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeAssetDetail();
        }
    }

    public function addAssetDetail() {
        if ($this->validate_AssetDetail('insert')) {
            $result = $this->assets_model->addAssetDetail();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('AssetsList/assest_detail');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
                $this->assest_detail();
            }
        } else {
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->assest_detail();
        }
    }
    
    public function updateAssetDetail() {
        if ($this->validate_AssetDetail('edit')) {
            $result = $this->assets_model->updateAssetDetail();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('AssetsList/assest_detail');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Update. Please try again.");
                $this->assest_detail();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->assest_detail();
        }
    }
    
    public function removeAssetDetail() {
        if ($this->validate_AssetDetail('remove')) {
            $result = $this->assets_model->removeAssetDetail();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('AssetsList/assest_detail');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to remove. Please try again.");
                $this->assest_detail();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->assest_detail();
        }
    }

    function validate_AssetDetail($status) {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        
        if ($status == 'insert' || $status == 'edit') {
            $this->form_validation->set_rules('type', 'Type', 'required|trim');
            $this->form_validation->set_rules('id_assetsTypelist', 'Asset Type', 'required|trim');
            $this->form_validation->set_rules('id_customer', 'Customer', 'required|trim');
//            $this->form_validation->set_rules('loan', 'Loan', 'required|trim');            
            $this->form_validation->set_rules('worth', 'Value', 'required|trim');
        } 
        
        if ($status == 'insert') {
            $this->form_validation->set_rules('assest_no', 'Asset No', 'required|trim|is_unique[asset.assest_no]');            
        }
        if ($status == 'edit') {
            $this->form_validation->set_rules('assest_no', 'Asset No', 'required|trim');
            $this->form_validation->set_rules('id_asset', 'Asset Id', 'required|trim', array('required'=> ' * Id for this Asset was not found ! &nbsp; Please Select an Asset and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_asset', 'Asset Id', 'required|trim', array('required'=> ' * Id for this Asset was not found ! &nbsp; Please Select an Asset and remove again.'));
        }

        return $this->form_validation->run();
    }
    
    function is_asset_used_in_marketing_form(){
        $this->assets_model->is_asset_used_in_marketing_form();
    }
}
// end of class 
