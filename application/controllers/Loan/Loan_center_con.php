<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_center_con extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Loan/Loan_center_model');
        $this->load->model('Loan/Add_loan_model');
        $this->load->model('Loan/Repayment_model');
        $this->load->model('marketing_officer_model');
    }
    
    public function index() {
//        $data='';
//        $data['loan_types'] = $this->Add_loan_model->loadList();
//        $data['loan_list'] = $this->Add_loan_model->loadLoanList();
//        $data['borrower'] = $this->Add_loan_model->borrowerList();
//        $data['serialNo'] = $this->Add_loan_model->getRealSerialNumber("Loan");
       $data['loan_list'] = $this->Loan_center_model->loadApprovedLoans();
//         echo "<pre>"; print_r($data['loan_types']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/loan_center_list');
        $this->load->view('template/footer');
    }
    
    public function manageLoan() {
//        $data='';
//        $data['loan_types'] = $this->Add_loan_model->loadList();
//        $data['loan_list'] = $this->Add_loan_model->loadLoanList();
//        $data['borrower'] = $this->Add_loan_model->borrowerList();
//        $data['serialNo'] = $this->Add_loan_model->getRealSerialNumber("Loan");
       $data['loan'] = $this->Loan_center_model->loadLoanListByLoanId();
       $data['loanCollateral'] = $this->Loan_center_model->loadLoanCollateral();
//         echo "<pre>"; print_r($data['loanCollateral']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/loan_center_view');
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
            $result = $this->Add_loan_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Loan/Loan_con');
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
    
     public function getRepayment_order() {
        $this->loan_model->getRepayment_order();
//        $this->Purches_requsisition_Model->getItemComboWithSpace();
    }
    
     public function checkDuplicate() {
        $this->loan_model->checkDuplicate();
//        $this->Purches_requsisition_Model->getItemComboWithSpace();
    }
    
    public function updateForm() {
        if ($this->validate_form('edit')) {
            $result = $this->Add_loan_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Loan/Loan_con');
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
            $result = $this->Add_loan_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Loan/Loan_con');
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
    
    function base64_url_decode($input) {
         return base64_decode(strtr($input, '._-', '+/='));
        }
    
     
    public function viewLoan($bId) {
        $data='';
        $bIdnew = $this->base64_url_decode($bId);
//        print_r($bIdnew);exit();
//        $data['bId'] = $bId;
        $data['loan_types'] = $this->Add_loan_model->loadList();
        $data['loan_list'] = $this->Add_loan_model->loadLoanList();
        $data['loan'] = $this->Add_loan_model->loadLoanListByLoanId($bIdnew);
        $data['borrower'] = $this->Add_loan_model->borrowerList();
//        $data['serialNo'] = $this->Add_loan_model->getRealSerialNumber("Loan");
//         echo "<pre>"; print_r($data['borrower']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/update_loan_view');
        $this->load->view('template/footer');
    }
     
    public function addRepayment($bId) {
//        $data='';
//        $bIdnew = $this->base64_url_decode($bId);

        $data['loan'] = $this->Add_loan_model->loadLoanListByLoanId($bId);
//         echo "<pre>"; print_r($data['loan']);  exit();
        $data['loanShedule'] = $this->Add_loan_model->getLoanSchedule($bId);
        $data['collector'] = $this->marketing_officer_model->loadList();
//        $data['serialNo'] = $this->Add_loan_model->getRealSerialNumber("Loan");
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/add_repayment');
        $this->load->view('template/footer');
    }
    
     public function pay_repayment() {
     $loan_id = $this->input->post('loan_id');
     $result = $this->Repayment_model->SaveRepayment();
     if($result){
         $this->session->set_flashdata("success_msg", "Paid successfully!.");
         redirect('Loan/Loan_center_con/addRepayment/'.$loan_id);
     }else{
          $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
          redirect('Loan/Loan_center_con/addRepayment/'.$loan_id);
     }
    }
    
    public function approve_loan() {
        $data='';

        $data['loadLoan'] = $this->Add_loan_model->loadLoanForApproval();
//        $data['m_officer'] = $this->Borrower_model->loadMarketingOfficer();
//        $data['borrower_list'] = $this->Borrower_model->loadList();
//        $data['borrower_list2'] = $this->Borrower_model->loadList_blacklist();
//         echo "<pre>"; print_r($data['loadBorrower']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Approval/Loan_approve_view');
        $this->load->view('template/footer');
    }
    
     
    public function submitApproveLoan() {
//        if ($this->validate_form('insert')) {
        $res = $this->input->post('submit');
        $resultApp=0;
        $resultRej=0;
        if($res=="app"){
        $resultApp = $this->Add_loan_model->appLoan();
        }else if($res=="rej"){
        $resultRej = $this->Add_loan_model->rejLoan();
        }
            
            
//            echo "<pre>"; print_r($result);  exit();
        if ($resultApp) {

            $this->session->set_flashdata("success_msg", "Approved successfully!.");
//                $this->grn_Approve_sumary();
            $this->approve_loan();
        }else if($resultRej){
            $this->session->set_flashdata("success_msg", "Rejected successfully!.");
//                $this->grn_Approve_sumary();
            $this->approve_loan();
        }else {
            //send error message to view
            $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->grn_Approve_sumary();
            $this->approve_loan();
        }
    }

    function validate_form($status) {    
        $this->load->library('form_validation'); 

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        if ($status == 'insert') {
            $this->form_validation->set_rules('loan_type', 'Loan Type', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('loan_type', 'Loan Type', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('loan_id', 'Loan Id', 'required|trim', array('required'=> ' * Id for the loan was not found ! &nbsp; Please Select the loan and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('loan_id', 'Loan Id', 'required|trim', array('required'=> ' * Id for the loan was not found ! &nbsp; Please Select the loan and remove again.'));
        }
        return $this->form_validation->run();
    }
    
}
// end of class 
