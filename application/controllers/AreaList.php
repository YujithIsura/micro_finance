<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AreaList extends MY_Controller {

    
    function __construct() {
        parent::__construct();
        $this->load->model('area_list_model');
    }
    
    public function index() {
        if ($this->viewper[0]->arealist == 0) {
         $this->permissionError();  
      }

        $data['list'] = $this->area_list_model->loadList();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/area_list');
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
        if ($this->validate_form('insert')) {
            $result = $this->area_list_model->addForm();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('AreaList');
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
            $result = $this->area_list_model->updateForm();
            
            if ($result) {
                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('AreaList');
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
            $result = $this->area_list_model->removeForm();

            if ($result) {
                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('AreaList');
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
            $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[arealist.name]');
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('id_areaList', 'Id AreaList', 'required|trim', array('required'=> ' * Id for the Area was not found ! &nbsp; Please Select area and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_areaList', 'Id AreaList', 'required|trim', array('required'=> ' * Id for the Area was not found ! &nbsp; Please Select area and remove again.'));
        }
        return $this->form_validation->run();
    }
}

// end of class 
