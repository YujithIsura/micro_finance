<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     * 
     */
    
    function __construct() {
        parent::__construct();
        $this->load->model('process_model');
//        $this->load->model('process_model');
    }
    
    public function index() {
        $data='';
//		$this->load->view('blank');
//        $data['areaList'] = $this->process_model->loadArea();
//        $data['m_officer'] = $this->process_model->loadMarketingOfficer();
        $data['assetsList'] = $this->process_model->load_assetsList();
        $data['max_id'] = $this->process_model->get_max_id();
        $data['customer_list'] = $this->process_model->loadList();
        $data['marketing_form'] = $this->process_model->load_marketing_form();
        $data['asset_details'] = $this->process_model->load_assets();
//        exit($data['max_id']);
//         echo "<pre>"; print_r($data);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('marketing_form');
        $this->load->view('template/footer');
    }

    public function load_borrower_data(){
//        $id_customer = $this->input->post('id_customer');
        $this->process_model->load_borrower_data();
    }
    public function load_active_loan_amount(){
//        $id_customer = $this->input->post('id_customer');
        $this->process_model->load_active_loan_amount();
    }
    public function load_marketing_form_data(){
//        $id_customer = $this->input->post('id_customer');
        $this->process_model->load_marketing_form_data();
    }
    public function load_application_form_data(){
//        $id_customer = $this->input->post('id_customer');
        $this->process_model->load_application_form_data();
    }
    public function load_asset_details(){
        $this->process_model->load_asset_details();
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
            $result = $this->process_model->addForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
                redirect('Process');
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
            $result = $this->process_model->updateForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
                redirect('Process');
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
            $result = $this->process_model->removeForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Process');
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
            $this->form_validation->set_rules('id_customer', 'Customer', 'required|trim');
            $this->form_validation->set_rules('approved_loan_amount', 'Approved Loan Amount', 'required|trim');
            $this->form_validation->set_rules('applied_loan_amount', 'Applied Loan Amount', 'required|trim');
//            $this->form_validation->set_rules('id_assetsList', 'Asset Type', 'required|trim');
//            $this->form_validation->set_rules('asset_details', 'asset details', 'required|trim');
            $this->form_validation->set_rules('id_asset', 'Asset no', 'required|trim|callback_is_asset_compatible');
            $this->form_validation->set_rules('marketing_form_no', 'marketing form no', 'required|trim');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('id_customer', 'Customer', 'required|trim');
            $this->form_validation->set_rules('approved_loan_amount', 'Approved Loan Amount', 'required|trim');
            $this->form_validation->set_rules('applied_loan_amount', 'Applied Loan Amount', 'required|trim');
//            $this->form_validation->set_rules('id_assetsList', 'Asset Type', 'required|trim');
//            $this->form_validation->set_rules('asset_details', 'asset details', 'required|trim');
            $this->form_validation->set_rules('id_asset', 'Asset no', 'required|trim|callback_is_asset_compatible');
            $this->form_validation->set_rules('marketing_form_no', 'marketing form no', 'required|trim');
            
            $this->form_validation->set_rules('id_marketing_form', 'Id of marketing form', 'required|trim' , array('required'=> ' * Id of the marketing form  not found ! &nbsp; Please Select the marketing form and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_marketing_form', 'id_marketing_form', 'required|trim', array('required'=> ' * Id of the marketing form  not found ! &nbsp; Please Select the marketing form and remove again.'));
        }
        return $this->form_validation->run();
    }
    
    public function is_asset_compatible(){
    
        $this->form_validation->set_message('is_asset_compatible', 'Asset and the customer are incompatible');
        return $this->process_model->is_asset_compatible();
    
    }
    
    
        // ******************************** loan Application ******************************************
         
    public function loanApplication(){
        $data['assetsList'] = $this->process_model->load_assetsList();
//        $data['max_id'] = $this->process_model->get_max_id();
        $data['customer_list'] = $this->process_model->loadList();
        $data['collector_list'] = $this->process_model->load_collector_list();
        $data['loan_types'] = $this->process_model->load_loan_types();
        $data['loan_application_form'] = $this->process_model->load_LoanApplicationForm();
        $data['asset_details'] = $this->process_model->load_assets();
        $data['m_form_list'] = $this->process_model->load_marketing_form_list();
//        exit($data['max_id']);
//         echo "<pre>"; print_r($data);  exit();
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('loanApplication');
        $this->load->view('template/footer');
    }

    public function submitLoanApplicationForm() {
        $submit = $this->input->post('submit');
        $update = $this->input->post('update');
        $remove = $this->input->post('remove');

        if (!empty($submit) && $submit == 'submit') {
//                echo 'submit';                exit();
            $this->addLoanApplicationForm();
        } else if (!empty($update) && $update == 'update') {
//            exit('update');
            $this->updateLoanApplicationForm();
//            echo 'update'.$this->input->post('id_assetsList');
        } else if (!empty($remove) && $remove == 'remove') {
            $this->removeLoanApplicationForm();
//            echo 'remove';
        }
    }

    function validate_loanApplication_form($status) {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        
        $this->form_validation->set_rules('id_customer', 'Customer', 'required|trim');
        $this->form_validation->set_rules('applieded_date', 'date', 'required|trim');
        $this->form_validation->set_rules('loan_amount', 'loan amount', 'required|trim');
        $this->form_validation->set_rules('id_collector', 'collector', 'required|trim');
        $this->form_validation->set_rules('issued_officer', 'issued officer', 'required|trim');
        $this->form_validation->set_rules('issuing_type', 'type', 'required|trim');
        $this->form_validation->set_rules('id_loan_type', 'Loan Package', 'required|trim');
        $this->form_validation->set_rules('payment_type', 'payment type', 'required|trim');
        $this->form_validation->set_rules('payment_date', 'payment date', 'required|trim');
        $this->form_validation->set_rules('daily_payment', 'daily payment', 'trim|numeric');
        $this->form_validation->set_rules('gurantor_1_name', 'gurantor one name', 'required|trim');
//        $this->form_validation->set_rules('gurantor_2_name', 'marketing form no', 'required|trim');
        $this->form_validation->set_rules('gurantor_1_nic', 'gurantor one NIC', 'required|trim');
//        $this->form_validation->set_rules('gurantor_2_nic', 'Loan Amount', 'required|trim');
        $this->form_validation->set_rules('gurantor_1_tp', 'gurantor one TP', 'required|trim');
//        $this->form_validation->set_rules('gurantor_2_tp', 'asset details', 'required|trim');
        $this->form_validation->set_rules('gurantor_1_address', 'gurantor one address', 'required|trim');
//        $this->form_validation->set_rules('gurantor_2_address', 'marketing form no', 'required|trim');
        $this->form_validation->set_rules('relative_name', 'relative name', 'required|trim');
        $this->form_validation->set_rules('relative_type', 'relative type', 'required|trim');
        $this->form_validation->set_rules('relative_nic', 'relative nic', 'required|trim');
        $this->form_validation->set_rules('relative_tp', 'relative tp', 'required|trim');
        $this->form_validation->set_rules('relative_address', 'relative address', 'required|trim');
        $this->form_validation->set_rules('id_asset', 'Asset no', 'required|trim');
        
        if ($status == 'insert') {            
            $this->form_validation->set_rules('id_marketing_form', 'marketing form no', 'required|trim');
            $this->form_validation->set_rules('loan_no', 'Loan no', 'required|trim|callback_check_uniqueness_of_loan_no');
//            $this->form_validation->set_rules('loan_no', 'Loan no', 'required|trim|is_unique[loan_application_form.loan_no]');
            
        } 
        if ($status == 'edit') {
            $this->form_validation->set_rules('loan_no', 'loan no', 'required|trim');
//            $this->form_validation->set_rules('id_marketing_form_2', 'marketing form no', 'required|trim');
            $this->form_validation->set_rules('id_loan_application_form', 'Id of loan application form', 'required|trim' , array('required'=> ' * Id of the loan application form was not found ! &nbsp; Please Select the loan application  and update again.'));
        }
        if ($status == 'remove') {
            $this->form_validation->set_rules('id_loan_application_form', 'id_loan_application_form', 'required|trim', array('required'=> ' * Id of the loan application form was not found ! &nbsp; Please Select the loan application  and remove again.'));
        }
        return $this->form_validation->run();
    }
    
    function check_uniqueness_of_loan_no() {

        $loan_no = $this->input->post('loan_no');
        $this->form_validation->set_message('check_uniqueness_of_loan_no', 'Loan no has been used previously.');
        return $this->process_model->check_uniqueness_of_loan_no($loan_no);
    }
    
    public function addLoanApplicationForm() {
        if ($this->validate_loanApplication_form('insert')) {
            $result = $this->process_model->addLoanApplicationForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result['result']) {

                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
//                $this->loanApplication();
//                redirect('Process/loanApplication');
                redirect('Process/loanSummary/'.$result['result_id']);
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
                $this->index();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->loanApplication();
//            redirect('Process/loanApplication');
        }
    }
    
    public function updateLoanApplicationForm() {
        if ($this->validate_loanApplication_form('edit')) {
            $result = $this->process_model->updateLoanApplicationForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Updated successfully!.");
//                $this->loanApplication();
                redirect('Process/loanApplication');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Update. Please try again.");
                $this->loanApplication();
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->loanApplication();
        }
    }
    public function removeLoanApplicationForm() {
        if ($this->validate_form('remove')) {
            $result = $this->process_model->removeLoanApplicationForm();
//            echo "<pre>"; print_r($result);  exit();
            if ($result) {

                $this->session->set_flashdata("success_msg", "Removed successfully!.");
                redirect('Process');
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
    // ******************************** end of loan Application******************************************
    // ******************************** loan Summary ******************************************
     public function loanSummary($loan_id = null){
         // to check session values
//         echo '<pre>';
//         print_r($_SESSION['penalty_payment']);
//         print_r($_SESSION['exceed_penalty_payment']);
//         exit();
         
         $data['is_loan_selected'] = FALSE;
         if($loan_id != null){
//             exit($loan_id);
             $data['loan_data'] = $this->process_model->load_loan_data($loan_id);
             $data['is_loan_selected'] = TRUE;
             $is_schedule_confirmed = $data['loan_data'][0]->is_schedule_confirmed;
//             exit($is_schedule_confirmed);
             if($is_schedule_confirmed == '0'){
                $data["instalment_details_arr"] = $this->calculate_loan_shedule_2($data['loan_data']);
             } else {
                 $data["instalment_details_arr"] = $this->get_saved_loan_shedule($loan_id);
             }
         }
         $data['all_loan_data'] = $this->process_model->load_LoanApplicationForm();
//          echo "<pre>"; print_r($data["instalment_details_arr"]);  exit();
         $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('loanSummary');
        $this->load->view('template/footer');
        
     }
     
     public function get_saved_loan_shedule($loan_id){
        $return_array = array();
        $loan_datails = $this->process_model->load_Loan_datails($loan_id);
//         echo "<pre>"; print_r($loan_datails);  exit();
        $return_array['instalment_dates'] = $this->process_model->load_Loan_dates($loan_id);
        $return_array['rounded_instalment_amount'] = $loan_datails[0]->average_instalment_amount;
        $return_array['final_instalment'] = $loan_datails[0]->final_instalment_amount;
        $return_array['total_payment'] = $loan_datails[0]->total_comfirmed_payment;
        
        return $return_array;
//         echo "<pre>"; print_r($return_array);  exit();
     }
     public function calculate_loan_shedule($loan_data){
    /*     $payment_term = $loan_data[0]->payment_term; // weekly or daily
         $interest_rate = $loan_data[0]->interest_rate; 
         $duration = $loan_data[0]->duration; 
         
//         $loan_amount = $loan_data[0]->loan_amount; 
         $loan_amount = 50000; 
         
         
         $total_months = '';
         if($payment_term == "Weekly"){
             $total_months = $duration / 4;
         } else if($payment_term == "Daily"){
             $total_months = $duration / 24;
         }
         
         $total_payment = (($loan_amount / 100 )*  $interest_rate *$total_months) + $loan_amount ;
         
         $instalment_amount  = $total_payment / $duration;
         echo($payment_term.'</br>'.$interest_rate.'</br>'.$duration.'</br>'.$loan_amount.'</br>'.$total_months.'</br>'.$total_payment);
         exit('</br></br></br></br>$instalment_amount = '.$instalment_amount.'</br>$total_payment = '.$total_payment);
    */     
        // refere = http://www.php.net/manual/en/class.datetime.php 
        // refere = http://sg2.php.net/manual/en/datetime.add.php 
        // refere = http://www.sitepoint.com/working-with-dates-and-times/
         
         $applieded_date = $loan_data[0]->applieded_date;
         $holidays = $this->process_model->load_holidays();
         
         
         
         $holiday_values = array();
        foreach ($holidays as $h_day) {
            $holiday_dates[] = $h_day->date;
        }
        echo "<pre>"; print_r($holiday_dates);
        
//        print_r(array_column($my_values, 'date'));
//         $key = array_search(5465, array_column($userdb, 'uid'));
         $key = array_search('2015-09-13', $holiday_dates); // return the key if vlaue exists.
//         $key = array_search('sunday', array_column($holidays, 'name'));
         echo $key;
         echo "<br>";
        echo in_array('2015-09-27', $holiday_dates, TRUE); // return true of false.
         echo "<br>";
         
         
//         $arr = array(new stdClass(), new stdClass());
//        $arr[0]->colour = 'red';
//        $arr[1]->colour = 'green';
//        $arr[1]->state = 'enabled';
//        print_r($arr);
        
//        echo in_array_field('2015-09-27', 'date', $holidays);
//        exit();
//         echo multidimensional_search($holidays, array('date'=>'2015-08-13')); // 1 
// echo "<pre>"; print_r($holidays);  exit();
//         Object oriented style
//        $date = new DateTime('2000-01-01');
        $date = new DateTime($applieded_date);
        $date->add(new DateInterval('P10D'));
//        echo $date->format('Y-m-d') . "<br>\n";
//         $next_date = $date->format('Y-m-d');
//        while(in_array($next_date, $holiday_dates, TRUE)) {
//             echo $next_date.' exist<br>';
////             $next_date->add(new DateInterval('P1D'));
//             date_add($next_date, date_interval_create_from_date_string('10 days'));
//         }
         
//        Procedural style
//         $date = date_create('2000-01-01');
//        $date = date_create($applieded_date);
//        date_add($date, date_interval_create_from_date_string('10 days'));
//        echo date_format($date, 'Y-m-d');
        $applieded_date = '2015-09-03';
        $next_date = date_create($applieded_date);
        date_add($next_date, date_interval_create_from_date_string('10 days'));
        $next_date = date_format($next_date, 'Y-m-d');
         
         
         while(in_array($next_date, $holiday_dates, TRUE)) {
             echo $next_date.' exist<br>';
//             $next_date->add(new DateInterval('P1D'));
             $next_date = date_create($next_date);
             date_add($next_date, date_interval_create_from_date_string('7 days'));
             $next_date = date_format($next_date, 'Y-m-d');
         }
         
         
         
        exit($next_date);
    }
    
     public function calculate_loan_shedule_2($loan_data){
         
         $payment_term = $loan_data[0]->payment_term; // weekly or daily
         $interest_rate = $loan_data[0]->interest_rate; 
         // after changing duration field to months...this had to be reomoved.
//         $duration = $loan_data[0]->duration;  
         
         $total_months = $loan_data[0]->duration;  

         $loan_amount = $loan_data[0]->loan_amount; 
//         $loan_amount = 50000; 
         
//         after changing duration field to months...folowing has to be added.
         // here duration == amount of installments
         $duration = 0;
        if($payment_term == "Weekly"){
//            echo 'w';
             $duration =  $total_months * 4;
         } else if($payment_term == "Daily"){
//             echo 'd';
             $duration = $total_months * 24;
         }
//         echo $duration;
//                  exit( $duration );
//         after changing duration field to months...folowing has to be reomoved.
/*         $total_months = '';
         if($payment_term == "Weekly"){
             $total_months = $duration / 4;
         } else if($payment_term == "Daily"){
             $total_months = $duration / 24;
         }
*/         
         $total_payment = (($loan_amount / 100 )*  $interest_rate *$total_months) + $loan_amount ;
         
         $instalment_amount = $total_payment / $duration;
         
         $rounded_instalment_amount = round($instalment_amount);
         $difference = $instalment_amount - $rounded_instalment_amount;
         $total_difference = $difference * $duration;
         $final_instalment = $rounded_instalment_amount + $total_difference;
         $final_instalment = round($final_instalment);
         
//        echo($payment_term . '</br>$interest_rate = ' . $interest_rate . '</br>$duration = ' . $duration . '</br> $loan_amount = ' . $loan_amount . '</br>$total_months = ' . $total_months);
//        echo('</br></br></br></br>$instalment_amount = ' . $instalment_amount . '</br>$total_payment = ' . $total_payment);
//        echo('</br></br></br></br>$rounded_instalment_amount = ' . $rounded_instalment_amount . '</br>$difference = ' . $difference . '</br> $total_difference = ' . $total_difference . '</br>$final_instalment = ' . $final_instalment);


        $applieded_date = $loan_data[0]->applieded_date;
         $holidays = $this->process_model->load_holidays();
//         echo '<br>'.$applieded_date;
         // convert stdClass calss array to index array
        $holiday_values = array();
        foreach ($holidays as $h_day) {
            $holiday_dates[] = $h_day->date;
        }
                  
        $instalment_dates = array();
        $next_date = date_create($applieded_date);
        date_add($next_date, date_interval_create_from_date_string('1 days'));
        $next_date = date_format($next_date, 'Y-m-d');
        
        for($i = 1; $i <= $duration;  $i++){
            /*
             * get next_weekly_payment_date for next loop by adding 7 days. 
             * but if more than 7 days are concesecutive holidays : the system will gentrate an error/bug...
             */
            if( $payment_term == 'Weekly'){
                $next_weekly_payment_date = date_create($next_date);
                date_add($next_weekly_payment_date, date_interval_create_from_date_string('7 days')); 
                $next_weekly_payment_date = date_format($next_weekly_payment_date, 'Y-m-d');
            }
            
            
            // if next day is a holiday, - add a date and check again as a loop.         
            
            while (in_array($next_date, $holiday_dates, TRUE)) {
                $next_date = date_create($next_date);
                date_add($next_date, date_interval_create_from_date_string('1 days'));
                $next_date = date_format($next_date, 'Y-m-d');
            }
            
            
            // add next date to $instalment_dates array().
            $instalment_dates[$i] = $next_date;
            // again add a date to $next_date (to use in next for loop).
            if( $payment_term == 'Weekly'){
//                date_add($next_date, date_interval_create_from_date_string('7 days')); 
                $next_date = $next_weekly_payment_date;
            }
            else if ($payment_term == 'Daily') {
                $next_date = date_create($next_date);
                date_add($next_date, date_interval_create_from_date_string('1 days'));
                $next_date = date_format($next_date, 'Y-m-d');
            }
        }
        
        
//        echo "<pre>"; print_r($instalment_dates); exit();
        
        $return_array = array();
        $return_array['instalment_dates'] = $instalment_dates;
        $return_array['rounded_instalment_amount'] = $rounded_instalment_amount;
        $return_array['final_instalment'] = $final_instalment;
        $return_array['total_payment'] = $total_payment;
        
//        echo "<pre>"; print_r($return_array); exit();
        return $return_array;
//        print_r(array_column($my_values, 'date'));
//         $key = array_search(5465, array_column($userdb, 'uid'));
//         $key = array_search('2015-09-13', $holiday_dates); // return the key if vlaue exists.
//         $key = array_search('sunday', array_column($holidays, 'name'));
//         echo $key;
//         echo "<br>";
//        echo in_array('2015-09-27', $holiday_dates, TRUE); // return true of false.
//         echo "<br>";
         
         
         
         
         
         
//         $arr = array(new stdClass(), new stdClass());
//        $arr[0]->colour = 'red';
//        $arr[1]->colour = 'green';
//        $arr[1]->state = 'enabled';
//        print_r($arr);
        
//        echo in_array_field('2015-09-27', 'date', $holidays);
//        exit();
//         echo multidimensional_search($holidays, array('date'=>'2015-08-13')); // 1 
// echo "<pre>"; print_r($holidays);  exit();
//         Object oriented style
//        $date = new DateTime('2000-01-01');
//        $date = new DateTime($applieded_date);
//        $date->add(new DateInterval('P10D'));
//        echo $date->format('Y-m-d') . "<br>\n";
//         $next_date = $date->format('Y-m-d');
//        while(in_array($next_date, $holiday_dates, TRUE)) {
//             echo $next_date.' exist<br>';
////             $next_date->add(new DateInterval('P1D'));
//             date_add($next_date, date_interval_create_from_date_string('10 days'));
//         }
         
//        Procedural style
//         $date = date_create('2000-01-01');
//        $date = date_create($applieded_date);
//        date_add($date, date_interval_create_from_date_string('10 days'));
//        echo date_format($date, 'Y-m-d');
//        $applieded_date = '2015-09-03';
//        $next_date = date_create($applieded_date);
//        date_add($next_date, date_interval_create_from_date_string('10 days'));
//        $next_date = date_format($next_date, 'Y-m-d');
//         while(in_array($next_date, $holiday_dates, TRUE)) {
//             echo $next_date.' exist<br>';
////             $next_date->add(new DateInterval('P1D'));
//             $next_date = date_create($next_date);
//             date_add($next_date, date_interval_create_from_date_string('7 days'));
//             $next_date = date_format($next_date, 'Y-m-d');
////        exit($next_date);
//         }
    }


     // ******************************** end of loan Summary ******************************************
     // ******************************** confirmLoanSchedule form ******************************************
     
    public function confirmLoanSchedule() {
        
        $this->load->library('form_validation');

        
//        $this->form_validation->set_rules('id_customer', 'Customer', 'required|trim', 
//                array('required'=> ' * Id of the Customer was not found ! &nbsp; Form submission failed.'));
        $this->form_validation->set_rules('id_loan_application_form', 'id_loan_application_form', 'required|trim',
                array('required'=> ' * Id of the loan application form was not found ! &nbsp; &nbsp; Form submission failed.'));
//        $this->form_validation->set_rules('loan_no', 'loan_no', 'required|trim', 
//                array('required'=> ' *  loan nunber was not found ! &nbsp; Please  again.'));
        
        if ($this->form_validation->run()) {
            $result = $this->process_model->saveLoanSchedule();
//            echo "<pre>"; print_r($result);  
//            exit('yy');
            if ($result) {

                $id_loan_application_form =  $this->input->post('id_loan_application_form');
                $this->session->set_flashdata("success_msg", "Submitted successfully!.");
//                $this->loanSummary($id_loan_application_form);
                redirect('Process/loanSummary'.'/'.$id_loan_application_form);
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submit. Please try again.");
//                $this->loanSummary();
                redirect('Process/loanSummary');
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->loanSummary();
        }
    }
      
     // ******************************** end of confirmLoanSchedule form ******************************************
     // ******************************** Customer Payment Form ******************************************
      
     public function customerPaymentForm($loan_id = null, $payment_date = null){
//         $this->load->library( 'nativesession' );
//         $this->nativesession->set( 'uname', 'uname' );
//         $data = $this->nativesession->get( 'uname');
//         $_SESSION['a'] = 1;
//         $_SESSION['a'] += 1;
         
         $data['is_loan_selected'] = FALSE;
         $data['confirmed_loan_data'] = $this->process_model->load_confirmed_loan_data();
//         exit($loan_id.' - '. $payment_date);
         if($loan_id != null){
//             echo date('Y-m-d').'<br>';
             $data['is_loan_selected'] = TRUE;
             $data['loan_data'] = $this->process_model->load_loan_data($loan_id);
             
             $data['payment_date'] = $payment_date;             
             
             if($payment_date == null){
                 $payment_date = date('Y-m-d');
                 $data['payment_date'] = date('Y-m-d');
             }
//             $data["instalment_details_arr"] = $this->get_saved_loan_shedule($loan_id);
             $data["document_charge"] = $this->process_model->get_document_charges($loan_id);
//             $data["total_surcharge2"] = $this->process_model->calculate_total_surcharge($loan_id,$payment_date);
             $data["total_surcharge"] = $this->process_model->calculate_late_payment_charge($loan_id,$payment_date);
             $data["exceed_panalty"] = $this->process_model->calculate_exceed_panalty($loan_id,$payment_date);
             
             $this->load->model('report_model');
             
             $outstanding = $this->report_model->get_outstanding($loan_id);
             $panelty_and_exceed_original = $this->report_model->get_panelty_and_exceed_for_the_date($loan_id, $payment_date);
             $outstanding += $panelty_and_exceed_original;
             $data["outstanding"] =$outstanding;
//             $data["arrears"] = '';
             $data["arrears"] = $this->report_model->get_arrears($loan_id,$payment_date);
//             exit($outstanding.' - '.$loan_id);
//             echo '<br>dfsffsds<br>';
//             echo($data["total_surcharge"]).' = total_surcharge<br>';
//             echo($data["total_surcharge2"]).' = total_surcharge2<br>';
//             echo($data["exceed_panalty"]).' = exceed_panalty<br><pre>';
//            echo '<pre>';
//             echo '<br> $_SESSION["penalty_payment"])'; print_r($_SESSION['penalty_payment']);
//             echo '<br> $_SESSION["late_penalty_payment"])'; print_r($_SESSION['late_penalty_payment']);
//             echo '<br> $_SESSION["exceed_penalty_payment"])'; print_r($_SESSION['exceed_penalty_payment']);
//             echo '</pre>';
//             exit('<br><strong>testing.....</strong>');
             $data["remained_payments"] = $this->process_model->get_remained_payment_shedule($loan_id);
             
             $data["payment_id"] = $this->process_model->get_max_cp_id();
//             echo "<pre>"; print_r($data["remained_payments"]);
//             echo "<pre>"; print_r($data["document_charge"]);
//             exit($data["payment_id"]);
//             echo date(DATE_ISO8601).'<br>';
//             exit($loan_id);
         }
//         echo "<pre>"; print_r($data['loan_data'] );  
//            exit('yy');
        
        $this->load->view('template/header',$data);
        $this->load->view('template/navigation');
        $this->load->view('customerPayment');
        $this->load->view('template/footer');
            
     }

     public function customerPayment(){
         $loan_id = $this->input->post('id_loan_application_form');
         $payment_date = $this->input->post('payment_date');
         if ($this->validate_customer_payment()) {
            $result = $this->process_model->save_customer_payment();
//            echo "<pre>"; print_r($result);  exit();
//            if (TRUE) {
            if ($result) {

                $this->session->set_flashdata("success_msg", "Submited the payment successfully!.");
//                $this->customerPaymentForm();
                redirect('Process/customerPaymentForm');
            } else {
                //send error message to view
                $this->session->set_flashdata("error_msg", "Unable to Submited. Please try again.");
                $this->customerPaymentForm($loan_id, $payment_date);
            }
        } else {
            // return to form.
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->customerPaymentForm($loan_id, $payment_date );
        }
     }
     
     public function validate_customer_payment(){
         $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');
        
        
        $this->form_validation->set_rules('id_loan_application_form', 'id_loan_application_form', 'trim|required', array( 'required' => 'Id for the loan was not found! Please try again.'));
        $this->form_validation->set_rules('paid_items_amount', 'paid_items_amount', 'required|trim', array( 'required' => 'form submition error! Please try again.'));
        $this->form_validation->set_rules('payment_date', 'payment date', 'required|trim');
        $this->form_validation->set_rules('cp_no', 'Cus-Pay No', 'required|trim|is_unique[customer_payment.cp_no]');
        $this->form_validation->set_rules('payment_amount', 'payment amount', 'required|trim|is_numeric|callback_check_payments');
        $this->form_validation->set_rules('balance', 'balance', 'required|trim');
        
        return $this->form_validation->run();
     }

     
      function check_payments() {

                     $payment_amount = $this->input->post('payment_amount');
                     $open_balance = $this->input->post('open_balance');
                     $slr = $this->input->post('slr');
                     $total_value = $this->input->post('total_value');
                     $balance_amount = $this->input->post('balance');

                     $total_payment_amount = (float) $payment_amount + (float) $open_balance + (float) $slr;
//                     echo $total_payment_amount.'<br>';

                     $paid_items_amount = $this->input->post('paid_items_amount');
//        echo $paid_items_amount;
                     $details_array = array();
                     $total_instalment_amount = 0;

                     for ($i = 1; $i <= $paid_items_amount; $i++) {

//                               $instalment_type = $this->input->post('instalment_type_' . $i);

                               $pay_amount = $this->input->post('instalment_amount_' . $i);
                               $total_instalment_amount += (float) $pay_amount;
                     }
//                     echo $total_payment_amount.'<br>';
                     if (($total_payment_amount == $total_value) && ($total_payment_amount == (float) $balance_amount + (float) $total_instalment_amount)) {
//                               exit('true');
                               return true;
                     } else {
//                               exit('false');
                               $this->form_validation->set_message('check_payments', 'Payment reconciliation is unsuccessful!');
//                               $this->session->set_flashdata("error_msg", "Payment reconciliation is unsuccessful! Please submit again.");
                               return false;
                     }
           }

     public function check_uniqueness_of_cp_no(){
//         echo 'false';
         $this->process_model->check_uniqueness_of_cp_no();
     }

// ******************************** end of Customer Payment Form ******************************************
// 
// 
// 
// ******************************** Begining of Customer Payment Delete Form ******************************************

    public function showPayments( $data = array()){
//        $this->session->set_flashdata("success_msg", "Payments Deleted successfully!.");
//        $this->session->set_flashdata("error_msg", "Error occured!.");
        $this->load->model('report_model');
        $data['loans'] = $this->report_model->loadLoans();
//        echo '<pre>';            print_r($data['loans']);            exit();
//        $data = '';
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('customerPayment_delete');
        $this->load->view('template/footer');
    }
     
    public function customerPaymentList(){
    
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');

        $this->form_validation->set_rules('loan', 'Loan No', 'required|trim');
        if ($this->form_validation->run()) {
//            exit('ok');
            $this->load->model('report_model');
            $data['loan'] = $this->report_model->get_Loan_data();
            $data['collections'] = $this->report_model->get_customerRecipt_data();
            $data['report_date'] = date("Y/m/d");
//            echo '<pre>';            print_r($data['collections']);            exit();
             $this->showPayments($data);
        } else {
            //send error message to view
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->showPayments();
}
    }
    
    public function deleteCustomerPayments(){
        $id_loan_application_form = $this->input->post('id_loan_application_form');
//        echo '<br>';
        $row_count =  $this->input->post('row_count');
//        echo '<br>';
        $i = 0;
        $payment_check_box = '';
        for($i++; $i<= $row_count; $i++){
            if(isset($_POST['payment_check_box_'.$i]) && !empty($_POST['payment_check_box_'.$i])){
                $payment_check_box = $_POST['payment_check_box_'.$i];
//                echo '<br>';
                break;
            }
        }
        if(empty($payment_check_box)|| $payment_check_box == ''){
            $this->session->set_flashdata("error_msg", "NO selected payments to delete!.");
            redirect('Process/showPayments');
//            $this->showPayments();
        }
        $res = $this->process_model->delete_customer_payments($id_loan_application_form,$row_count,$payment_check_box);
        if($res){
//            exit('yes');
            $this->session->set_flashdata("success_msg", "Payments Deleted successfully!.");
//            $this->showPayments();
            redirect('Process/showPayments');
        }else {
//            exit('no');
            $this->session->set_flashdata("error_msg", "Error occured!.");
//            $this->showPayments();
            redirect('Process/showPayments');
        }
    }
 
// ******************************** End of Customer Payment Delete ****************************************************


// ******************************** Loan Delete ****************************************************
 public function showLoans( $data = array()){
        $this->load->model('report_model');
        $data['loans'] = $this->report_model->loadLoans();
//        echo '<pre>';            print_r($data['loans']);            exit();
//        $data = '';
        $this->load->view('template/header', $data);
        $this->load->view('template/navigation');
        $this->load->view('loan_delete');
        $this->load->view('template/footer');
 }
 
 public function displayLoanDetails(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block validation_errors" style="color:red;"><i class="fa fa-times-circle-o fa-fw"></i> ', '</div>');

        $this->form_validation->set_rules('loan', 'Loan No', 'required|trim');
        if ($this->form_validation->run()) {

            $this->load->model('report_model');
            $data['loan'] = $this->report_model->get_Loan_data();
            $data['collections'] = $this->report_model->get_customerRecipt_data();
//            $data['report_date'] = date("Y/m/d");
//             echo '<pre>';            print_r($data['loan']);            exit();
            $this->showLoans($data);
             
        } else {
            //send error message to view
            $this->session->set_flashdata("error_msg", "Form submission error!.");
            $this->showLoans();
        }
    }
    
    public function deleteLoan(){
        $id_loan_application_form = $this->input->post('id_loan_application_form');
//        echo '<br>';
//        exit();
        if(empty($id_loan_application_form)|| $id_loan_application_form == ''){
            $this->session->set_flashdata("error_msg", "Loan number was not found to delete!.");
            redirect('Process/showLoans');
        }
        $res = $this->process_model->delete_loan($id_loan_application_form);
        if($res){
            $this->session->set_flashdata("success_msg", "Loan Deleted successfully!.");
            redirect('Process/showLoans');
        }else {
            $this->session->set_flashdata("error_msg", "Error occured!.");
            redirect('Process/showLoans');
        }
    }
// ******************************** End of Loan Delete ****************************************************
     
     
     
     
     
     
     
}
// end of class 
