<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_con extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Loan/Loan_model');
        $this->load->model('loan_product_model');
    }
    
 
      public function index() {
//        $data='';
        $data['loan_list'] = $this->Loan_model->loadPendingLoanList();
//         echo "<pre>"; print_r($data['loan_list']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/loan_list_view');
        $this->load->view('template/footer');
    }
 
      public function index2() {
          $data['borrower_list'] = $this->Loan_model->loadBorrower();
          $data['loan_product_list'] = $this->Loan_model->loadLoanProduct();
           $data['serialNo'] = $this->Loan_model->getRealSerialNumber("Loan");
           $data['guarantor_list'] = $this->Loan_model->loadGuarantors();
           $data['collateral_list'] = $this->Loan_model->loadGuarantors();
//          print_r($data);exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/add_loan_view');
        $this->load->view('template/footer');
    }
 
      public function updateView($loan_id='') {
          if(empty($loan_id)){
          $loan_id = $this->input->post("loan_id");
        $data['form'] = 1;
          }   
        $data['loans'] = $this->Loan_model->getLoans($loan_id);
         $data['borrower_list'] = $this->Loan_model->loadBorrower();
          $data['loan_product_list'] = $this->Loan_model->loadLoanProduct();
           $data['guarantor_list'] = $this->Loan_model->loadGuarantors();
           $data['collateral_list'] = $this->Loan_model->loadGuarantors();
//         echo "<pre>"; print_r($data['loans']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Loan/update_loan_view');
        $this->load->view('template/footer');
    }

    public function submitForm() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($submit) && $submit == 'submit') {
//                echo 'submit';
            $this->saveLoan();
        } else if (!empty($update) && $update == 'update') {
            $this->updateLoan();
//            echo 'update'.$this->input->post('id_assetsList');
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeForm();
//            echo 'remove';
        }
    }

    public function saveLoan() {
        if ($this->validate_form('insert')) {
            $result = $this->Loan_model->saveLoan();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Loan/Loan_con');
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
    
    public function updateLoan() {
        if ($this->validate_form('edit')) {
            $result = $this->Loan_model->updateLoan();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Loan/Loan_con');
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
    
    function downloadFile($file){
        $filename = $file; // of course find the exact filename....        
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); // required for certain browsers 
header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

readfile($filename);

exit;
    }
    
    public function approve_loan() {

        $data['loadLoans'] = $this->Loan_model->loadLoansForApproval();
//        $data['m_officer'] = $this->Borrower_model->loadMarketingOfficer();
//        $data['borrower_list'] = $this->Borrower_model->loadList();
//        $data['borrower_list2'] = $this->Borrower_model->loadList_blacklist();
//         echo "<pre>"; print_r($data['loadLoans']);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('Approval/loan_approve_view');
        $this->load->view('template/footer');
    }
      
    public function submitApproveLoan() {
//        if ($this->validate_form('insert')) {
        $res = $this->input->post('submit');
        $resultApp=0;
        $resultRej=0;
        if($res=="app"){
        $resultApp = $this->Loan_model->appLoan();
        }else if($res=="rej"){
        $resultRej = $this->Loan_model->rejLoan();
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
            $this->form_validation->set_rules('id_loan_product', 'Loan Product', 'required|trim');
            $this->form_validation->set_rules('disbursed_by', 'Disbursed By', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('id_loan_product', 'Loan Product', 'required|trim');
            $this->form_validation->set_rules('disbursed_by', 'Disbursed By', 'required|trim');
//            $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|trim');
//            $this->form_validation->set_rules('payment_term', 'Payment Term', 'required|trim');
//            $this->form_validation->set_rules('duration', 'Duration', 'required|trim');
//            $this->form_validation->set_rules('penalty_interest_rate', 'Penalty Interest Rate ', 'required|trim');
            
            $this->form_validation->set_rules('loan_id', 'Loan Id', 'required|trim', array('required'=> ' * Id for the loan Product was not found ! &nbsp; Please Select the loan Product and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('loan_id', 'Loan Id', 'required|trim', array('required'=> ' * Id for the loan Product was not found ! &nbsp; Please Select the loan Product and remove again.'));
        }
        return $this->form_validation->run();
    }
    
    //get loan Product data
    function getLoanProductDetail(){
        $result = $this->loan_product_model->getLoanProductDetail();
    }
    
       public function getLoanData() {
        $this->Loan_model->getLoanData();
//        $this->Purches_requsisition_Model->getItemComboWithSpace();
    }
    
}
// end of class 
