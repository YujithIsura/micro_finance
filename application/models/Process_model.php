<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Developer : Kapilka Kusumsiri
 * Date : 2015-03-11  
 */

class Process_model extends CI_Model {

//  -----------------------------------  olemi------------------------------
//  -----------------------------------  olemi------------------------------
    public function load_borrower_data() {

        $id_borrower = $this->input->post('id_borrower');
//        echo $id_customer;        return;
        $res = $this->db->select('borrower.name,borrower.nic,borrower.contact_no,borrower.gender,borrower.address,arealist.name as area_name, marketing_officer.name as marketing_officer_name,communication_address,job')
                        ->from('borrower')
                        ->join('arealist', 'arealist.id_areaList = borrower.id_areaList')
                        ->join('marketing_officer', 'marketing_officer.id_marketing_officer = borrower.id_marketing_officer')
                        ->where('id_borrower =', $id_borrower)
                        ->get()->result();
        echo json_encode($res);
    }

    public function load_active_loan_amount() {

        $id_customer = $this->input->post('id_customer');
//        echo $id_customer;        return;
        $res = $this->db->select("count('loan_no') AS loan_amount")
                        ->from('loan_application_form')
                        ->where('id_customer =', $id_customer)
                        ->where('loan_level = ', 'active')
                        ->where('status =', 1)
                        ->get()->result();
        echo json_encode($res);
    }

    public function load_marketing_form() {

        return $res = $this->db->select('customer.id_customer,id_marketing_form,customer.nic,customer.contact_no,customer.name,applied_loan_amount,approved_loan_amount,marketing_form_no,arealist.name as area_name, marketing_officer.name as marketing_officer_name')
                        ->from('marketing_form')
                        ->join('customer', 'marketing_form.id_customer = customer.id_customer')
                        ->join('arealist', 'arealist.id_areaList = customer.id_areaList')
//                        ->from('customer')
                        ->join('marketing_officer', 'marketing_officer.id_marketing_officer = customer.id_marketing_officer')
                        ->get()->result();
    }

    public function load_marketing_form2() {
        $res = $this->db->select('customer.nic,customer.contact_no,customer.gender,customer.address,arealist.name as area_name, marketing_officer.name as marketing_officer_name')
                        ->from('customer')
                        ->join('arealist', 'arealist.id_areaList = customer.id_areaList')
                        ->join('marketing_officer', 'marketing_officer.id_marketing_officer = customer.id_marketing_officer')
                        ->where('id_customer =', $id_customer)
                        ->get()->result();
        echo json_encode($res);
    }

    public function load_marketing_form_data() {

        $id_marketing_form = $this->input->post('id_marketing_form');
        $res = $this->db->select('*')
                        ->from('marketing_form')
                        ->where('id_marketing_form =', $id_marketing_form)
                        ->get()->result();
        echo json_encode($res);
    }

    public function load_assets() {

        return $res = $this->db->select('*')
                        ->from('asset')
//                        ->join('customer','customer.id_customer = asset.id_customer')
                        ->where('asset.status =', '1')
                        ->get()->result();
        echo '<pre>';
        print_r($res);
        exit();
    }

    public function load_assetsList() {

        return $res = $this->db->select('*')
                        ->from('assetslist')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function load_marketing_form_list() {

        $array = array();

        $result = $this->db->select('id_marketing_form ')
                        ->from('loan_application_form')
                        ->where('loan_application_form.status = 1')
                        ->where('loan_application_form.loan_level =', 'active')
                        ->get()->result();
        foreach ($result as $r) {
//            $array[$r->id_marketing_form]='';
            array_push($array, $r->id_marketing_form);
        }
        if (empty($array)) {
            $array = '';
        }
//        echo '<pre>'; 
//        print_r($result);   
//        print_r($array);
//        exit();

        return $res = $this->db->select('id_marketing_form , marketing_form_no, id_customer, id_asset, approved_loan_amount, applied_loan_amount ')
                        ->from('marketing_form')
                        ->where('marketing_form.status = 1')
//                        ->where_not_in('id_marketing_form','')
                        ->where_not_in('id_marketing_form', $array)
                        ->get()->result();
        print_r($res);
        exit();
    }

    public function load_holidays() {
        return $res = $this->db->select('date,name')
                        ->from('holiday')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function get_max_id() {
        return $res = $this->db->select_max('id_marketing_form')
                        ->from('marketing_form')
                        ->get()->row('id_marketing_form');
    }

    public function load_application_form_data() {
        $id_loan_application_form = $this->input->post('id_loan_application_form');
        $res = $this->db->select('loan_application_form.*, marketing_form.marketing_form_no, marketing_form.applied_loan_amount  , marketing_form.approved_loan_amount ')
                        ->join('marketing_form', 'marketing_form.id_marketing_form = loan_application_form.id_marketing_form ')
                        ->from('loan_application_form')
                        ->where('id_loan_application_form =', $id_loan_application_form)
                        ->get()->result();
        echo json_encode($res);
    }

    public function load_asset_details() {
        $id_asset = $this->input->post('id_asset');
        $res['asset']= $res1 = $this->db->select('asset.*,customer.*,assetslist.name AS asset_name')
                        ->from('asset')
                        ->join('customer', 'customer.id_customer = asset.id_customer')
                        ->join('assetslist', 'assetslist.id_assetslist = asset.id_assetsTypelist')
                        ->where('asset.id_asset =', $id_asset)
                        ->get()->result();
        
        $res['loan'] = $res2 = $this->db->select('loan_no,id_loan_application_form')
                        ->from('loan_application_form')
//                        ->join('asset', 'asset.id_asset = loan_application_form.id_asset')
                        ->where('id_asset =', $id_asset)
//                        ->limit(1)
                        ->order_by('id_loan_application_form','desc')
                        ->get()->result();
//        echo '<pre>';
//        print_r($res2);
//        echo json_encode($res1);
//        echo '<br>';
//        echo json_encode($res2);
//        echo '<br>';
        echo json_encode($res);
    }

//  -----------------------------------  olemi------------------------------

    public function addForm() {
        $data = array(
            'id_customer' => $this->input->post('id_customer'),
            'applied_loan_amount' => $this->input->post('applied_loan_amount'),
            'approved_loan_amount' => $this->input->post('approved_loan_amount'),
            'id_asset' => $this->input->post('id_asset'),
//            'id_assetsList' => $this->input->post('id_assetsList'),
//            'asset_details' => $this->input->post('asset_details'),
            'marketing_form_no' => $this->input->post('marketing_form_no'),
        );

//        echo '<pre>';
//        print_r($data);
//            exit();
        return $this->db->insert('marketing_form', $data);
    }
 
    public function updateForm() {
        $data = array(
            'id_customer' => $this->input->post('id_customer'),
            'applied_loan_amount' => $this->input->post('applied_loan_amount'),
            'approved_loan_amount' => $this->input->post('approved_loan_amount'),
            'id_asset' => $this->input->post('id_asset'),
//            'id_assetsList' => $this->input->post('id_assetsList'),
//            'asset_details' => $this->input->post('asset_details'),
        );

        $where['id_marketing_form'] = $this->input->post('id_marketing_form');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('marketing_form', $data, $where);
    }

    public function removeForm() {
        $data = array(
            'status' => 0,
        );
        $where['id_customer'] = $this->input->post('id_customer');
        return $this->db->update('marketing_form', $data, $where);
    }

    public function loadList() {
        return $res = $this->db->select('*')
                        ->from('customer')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function loadArea() {
        return $res = $this->db->select('*')
                        ->from('arealist')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function loadMarketingOfficer() {
        return $res = $this->db->select('*')
                        ->from('marketing_officer')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function is_asset_compatible(){
        
        $id_customer =  $this->input->post('id_customer');
        $id_asset = $this->input->post('id_asset');
        $query = "SELECT * FROM asset WHERE id_customer = '".$id_customer."' AND  id_asset ='".$id_asset."'";
        $num_rows = $this->db->query($query)->num_rows();

        if ($num_rows > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    public function check_uniqueness_of_loan_no($loan_no){

        $query = "SELECT * FROM `loan_application_form` WHERE `status` = 1 AND `loan_no`= '".$loan_no."'";
        $num_rows = $this->db->query($query)->num_rows();

        if ($num_rows > 0){
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    

//  ----------------------------------  loan application---------------------------------

    public function load_collector_list() {

        return $res = $this->db->select('*')
                        ->from('collector')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function load_loan_types() {

        return $res = $this->db->select('*')
                        ->from('loan_type')
                        ->where('status = 1')
                        ->get()->result();
    }

    public function load_LoanApplicationForm() {

        return $res = $this->db->select('*')
                        ->from('loan_application_form')
                        ->join('customer', 'customer.id_customer = loan_application_form. id_customer')
                        ->join('loan_type', 'loan_type.id_loan_type = loan_application_form. id_loan_type')
                        ->where('loan_application_form.loan_level = ', 'active')
                        ->where('loan_application_form.status = 1')
                        ->get()->result();
    }

    public function load_confirmed_loan_data() {

        return $res = $this->db->select('*')
                        ->from('loan_application_form')
                        ->join('customer', 'customer.id_customer = loan_application_form. id_customer')
                        ->join('loan_type', 'loan_type.id_loan_type = loan_application_form. id_loan_type')
                        ->where('loan_application_form.is_schedule_confirmed = 1')
                        ->where('loan_application_form.loan_level = ', 'active')
                        ->where('loan_application_form.status = 1')
                        ->get()->result();
    }

    public function load_loan_data($loan_id) {

        return $res = $this->db->select('(collector. name) as collector_name,'
                                . '(marketing_officer. name) as marketing_officer_name,'
                                . '(arealist. name) as areaList_name,'
                                . 'loan_type. loan_type_name,loan_type. payment_term, loan_type. interest_rate, loan_type.duration ,'
                                . ' loan_application_form.* ,customer.* ')
                        ->from('loan_application_form')
                        ->join('customer', 'customer.id_customer = loan_application_form. id_customer')
                        ->join('collector', 'collector.id_collector = loan_application_form. id_collector')
                        ->join('loan_type', 'loan_type.id_loan_type = loan_application_form. id_loan_type')
                        ->join('marketing_officer', 'marketing_officer.id_marketing_officer = customer. id_marketing_officer')
                        ->join('arealist', 'arealist.id_areaList = customer. id_areaList')
                        ->where('loan_application_form.status = 1')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->get()->result();
        echo '<pre>';
        print_r($res);
        exit();
    }

    public function addLoanApplicationForm() {
		$this->load->model("Smsgateway");
        $data = array(
            'id_marketing_form' => $this->input->post('id_marketing_form'),
            'id_customer' => $this->input->post('id_customer'),
            'loan_no' => $this->input->post('loan_no'),
            'applieded_date' => $this->input->post('applieded_date'),
            'loan_amount' => $this->input->post('loan_amount'),
            'id_collector' => $this->input->post('id_collector'),
            'issued_officer' => $this->input->post('issued_officer'),
            'issuing_type' => $this->input->post('issuing_type'),
            'loan_payment_type' => $this->input->post('payment_type'),
            'loan_payment_date' => $this->input->post('payment_date'),
            'loan_daily_payment' => number_format((double)$this->input->post('daily_payment'), 2, '.', ''),
            'id_loan_type' => $this->input->post('id_loan_type'),
            'gurantor_1_name' => $this->input->post('gurantor_1_name'),
            'gurantor_2_name' => $this->input->post('gurantor_2_name'),
            'gurantor_1_nic' => $this->input->post('gurantor_1_nic'),
            'gurantor_2_nic' => $this->input->post('gurantor_2_nic'),
            'gurantor_1_tp' => $this->input->post('gurantor_1_tp'),
            'gurantor_2_tp' => $this->input->post('gurantor_2_tp'),
            'gurantor_1_address' => $this->input->post('gurantor_1_address'),
            'gurantor_2_address' => $this->input->post('gurantor_2_address'),
            'relative_name' => $this->input->post('relative_name'),
            'relative_type' => $this->input->post('relative_type'),
            'relative_nic' => $this->input->post('relative_nic'),
            'relative_tp' => $this->input->post('relative_tp'),
            'relative_address' => $this->input->post('relative_address'),
            'id_asset' => $this->input->post('id_asset'),
            'reducedamount' => $this->input->post('reducedamount'),
        );


        $return = $this->db->insert('loan_application_form', $data);
		
        if($return){
            $return_id = $this->db->insert_id();
            $return_arr = array(
                'result' => TRUE,
                'result_id' => $return_id
            );
			
			$contact_no		=	$this->input->post("contact_no");
			$loanAm			=	$this->input->post("approved_loan_amount");
			$reducedamount  =	$this->input->post('reducedamount');
			$ugot			=	$this->input->post("approved_loan_amount")-$this->input->post('reducedamount');
			$id 			= 	$this->input->post('loan_no');
		
			$content		=	"Obage naya mudala :".(int)$loanAm."\nGinum ankaya:".$id."\nAdukala mudala :".(int)$reducedamount."\nOba athata labu mudala :".(int)$ugot."\n Wimaseem : 0777183180,0777120123,0773145155\n";
			$this->Smsgateway->sendSms($content,$contact_no);
			
			
        } else {
            $return_arr = array(
                'result' => FALSE,
                'result_id' => ''
            );
        }
        
		
        
//        echo '<pre>';
//        print_r($return_arr);
//        exit();
        return $return_arr;
        
    }

    public function updateLoanApplicationForm() {
        $data = array(
//            'id_marketing_form' => $this->input->post('id_marketing_form'),
            'id_customer' => $this->input->post('id_customer'),
            'loan_no' => $this->input->post('loan_no'),
            'applieded_date' => $this->input->post('applieded_date'),
            'loan_amount' => $this->input->post('loan_amount'),
            'id_collector' => $this->input->post('id_collector'),
            'issued_officer' => $this->input->post('issued_officer'),
            'issuing_type' => $this->input->post('issuing_type'),
            'id_loan_type' => $this->input->post('id_loan_type'),
            'loan_payment_type' => $this->input->post('payment_type'),
            'loan_payment_date' => $this->input->post('payment_date'),
            'loan_daily_payment' => number_format((double)$this->input->post('daily_payment'), 2, '.', ''),
            'gurantor_1_name' => $this->input->post('gurantor_1_name'),
            'gurantor_2_name' => $this->input->post('gurantor_2_name'),
            'gurantor_1_nic' => $this->input->post('gurantor_1_nic'),
            'gurantor_2_nic' => $this->input->post('gurantor_2_nic'),
            'gurantor_1_tp' => $this->input->post('gurantor_1_tp'),
            'gurantor_2_tp' => $this->input->post('gurantor_2_tp'),
            'gurantor_1_address' => $this->input->post('gurantor_1_address'),
            'gurantor_2_address' => $this->input->post('gurantor_2_address'),
            'relative_name' => $this->input->post('relative_name'),
            'relative_type' => $this->input->post('relative_type'),
            'relative_nic' => $this->input->post('relative_nic'),
            'relative_tp' => $this->input->post('relative_tp'),
            'relative_address' => $this->input->post('relative_address'),
            'id_asset' => $this->input->post('id_asset'),
        );

        $where['id_loan_application_form'] = $this->input->post('id_loan_application_form');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('loan_application_form', $data, $where);
    }

//  ----------------------------------  olemi---------------------------------
//  ----------------------------------  olemi LoanSchedule---------------------------------

    public function saveLoanSchedule() {

        $id_loan_application_form = $this->input->post('id_loan_application_form');
        $instalment_count = $this->input->post('instalment_count');

        $query_1 = "SELECT `is_schedule_confirmed` FROM `loan_application_form` WHERE `id_loan_application_form` = '$id_loan_application_form' ";
        $is_schedule_confirmed = $this->db->query($query_1)->result();
        //Double check if loan is confirmed
        if ($is_schedule_confirmed[0]->is_schedule_confirmed  == 1){
            return TRUE;
        }
        
        // calculate document charges
        $loan_amount = $this->db->select('loan_amount')
                        ->from('loan_application_form')
                        ->where('loan_application_form.id_loan_application_form = ', $id_loan_application_form)
                        ->where('status =', 1)
                        ->get()->result();

        $loan_amount = $loan_amount[0]->loan_amount;
        $document_charge = $loan_amount / 100 * 1.5;
        $document_charge = round($document_charge);
//        exit($instalment_count);
//        exit($loan_amount[0]->loan_amount);
        $this->db->trans_start();
        for ($i = 1; $i <= $instalment_count; $i++) {
            // save document charges for first installment
            if ($i == 1) {
                $doc_charge = array(
                    'id_loan_application_form' => $id_loan_application_form,
                    'date' => $this->input->post('instalment_date_' . $i),
                    'default_payment' => $document_charge,
                    'payment_type' => 'document_charge'
                );
                $this->db->insert('loan_schedule', $doc_charge);
//                don't put continue;
//                 echo '<pre>';
//        print_r($doc_charge);
////        print_r($where);
//            exit();
            }

            $data = array(
                'id_loan_application_form' => $id_loan_application_form,
                'date' => $this->input->post('instalment_date_' . $i),
                'default_payment' => $this->input->post('instalment_amount_' . $i),
            );
//            echo '<pre>';
//        print_r($data);
//        print_r($doc_charge);
//            exit();

            $this->db->insert('loan_schedule', $data);
        }

        $update_data = array(
            'is_schedule_confirmed' => '1',
            'average_instalment_amount' => $this->input->post('instalment_amount_1'),
            'final_instalment_amount' => $this->input->post('instalment_amount_' . $instalment_count),
            'total_comfirmed_payment' => $this->input->post('total_comfirmed_payment'),
            'no_of_instalments' => $instalment_count
        );
//           echo '<pre>';
//        print_r($update_data);
////        print_r($where);
//            exit();
        $where['id_loan_application_form'] = $id_loan_application_form;
        $this->db->update('loan_application_form', $update_data, $where);

        return $this->db->trans_complete();
    }

    public function load_Loan_datails($loan_id) {

        return $res = $this->db->select('total_comfirmed_payment,average_instalment_amount,final_instalment_amount')
                        ->from('loan_application_form')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->get()->result();
    }

    public function load_Loan_dates($loan_id) {

        $dates = $this->db->select('date')
                        ->from('loan_schedule')
                        ->where('payment_type = ', 'instalment')
                        ->where('status =', 1)
                        ->where('id_loan_application_form = ', $loan_id)
                        ->get()->result();
        $date_array = array();
        $i = 0;
        foreach ($dates as $date) {
            $i++;
            $date_array[$i] = $date->date;
        }

        return $date_array;
//        echo '<pre>';
//        print_r($date_array);
////        print_r($where);
//            exit();
    }

//  ----------------------------------  olemi LoanSchedule--------------------------------- 
//  ----------------------------------  olemi customer payment --------------------------------- 
    public function get_max_cp_id() {
        return $dates = $this->db->select_max('id_customer_payment')
                        ->from('customer_payment')
                        ->get()->row()->id_customer_payment;
//                ->result();
//        echo '<pre>';
//        print_r($dates);
//        exit();
    }

    public function get_remained_payment_shedule($loan_id) {
        return $dates = $this->db->select('*')
                        ->from('loan_schedule')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('payment_type = ', 'instalment')
                        ->where('payment_status = ', 'not_paid')
                        ->where('status =', 1)
//                        ->order_by('payment_type,id_loan_schedule')
                        ->get()->result();
//        echo '<pre>';
//        print_r($dates);
//        exit();
    }

    public function get_document_charges($loan_id) {
        return $data = $this->db->select('*')
                        ->from('loan_schedule')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('payment_type = ', 'document_charge')
                        ->where('payment_status = ', 'not_paid')
                        ->where('status =', 1)
//                        ->order_by('payment_type,id_loan_schedule')
                        ->get()->result();
//         return round($dates);
//        echo '<pre>';
//        print_r($dates);
        //        exit();
    }

    public function calculate_late_payment_charge($loan_id, $payment_date) {
//        $loan_id = 22;  
//        echo '<br><br><br><br>-----------------------------------------------<br>';
//        echo $payment_date.'<br>';
//        echo $loan_id.'<br>';
        $late_payments = $this->db->select('id_loan_schedule,date,default_payment')
                        ->from('loan_schedule')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('payment_type = ', 'instalment')
                        ->where('payment_status = ', 'not_paid')
                        ->where('late_panelty_paid != ', 1)
                        ->where('status = ', 1)
                        ->where('date <= ', $payment_date)
//                        ->order_by('payment_type,id_loan_schedule')
                        ->get()->result();
        
        $payment_type_arr = $this->db->select('payment_term,average_instalment_amount,penalty_interest_rate')
                        ->from('loan_application_form')
                        ->join('loan_type', 'loan_application_form.id_loan_type = loan_type.id_loan_type')
                        ->where('loan_application_form.id_loan_application_form', $loan_id)
                        ->get()
//                        ->row()->payment_term;
                        ->result();

        $payment_type = $payment_type_arr[0]->payment_term;
        $default_payment = $payment_type_arr[0]->average_instalment_amount;
        
        $overPayment = $this->db->select('open_balance')
                        ->from('loan_application_form')
                        ->where('loan_application_form.id_loan_application_form', $loan_id)
                        ->get()
                        ->row()->open_balance;

        $penalty_rate = (float)$payment_type_arr[0]->penalty_interest_rate;
//        $penalty_rate = (float)$penalty_rate;
//        echo $penalty_rate.'<br>';
        

//        echo $payment_type.' - '.$loan_id.'</br>';
//        echo '<br><pre>$late_payments= ';        print_r($payment_type_arr);  
//        exit();
        
        $_SESSION['late_penalty_payment'] = '';
        $late_payment_penalty_array = array();
        $total_surcharge = 0;
        $fine_remained = 0;
        $over_payment_redused = FALSE;
        $has_previous_panelty_payments = FALSE;
        $i = 0;

        //************************ new part **********************************//
        // sathi waarika wala anthimata panelty gewuu waarikayee ethiri panelty gannaya kirima 
        // anthimata gewuu penalty waarika ganiima
        if ($payment_type == 'Weekly') {

            // get last panelty paid shedule and check if payments are not paid
            $panelty_paid_final_id_loan_schedule = $this->db->select('id_loan_schedule,default_payment,payment_status,date')
                            ->from('loan_schedule')
                            ->where('id_loan_application_form = ', $loan_id)
                            ->where('payment_type = ', 'instalment')
//                            ->where('payment_status = ', 'not_paid')
                            ->where('late_panelty_paid = ', 1)
                            ->where('status = ', 1)
                            ->order_by('id_loan_schedule', 'desc')
                            ->limit('1')
                            ->get()->result();
//            echo '<br><pre>$panelty_paid_final_id_loan_schedule=  ';
//            print_r($panelty_paid_final_id_loan_schedule);            echo '</pre>';

            if (!empty($panelty_paid_final_id_loan_schedule)){
                $has_previous_panelty_payments = TRUE;
            }
            
            if (!empty($panelty_paid_final_id_loan_schedule) && $panelty_paid_final_id_loan_schedule[0]->payment_status == 'not_paid') {

                //                 echo '<br> <b>week</b> <br>';
                //  To get final panelty paid date
                $paid_last_penalty = $this->db->select('*')
                                ->from('customer_payment')
                                ->join('customer_payment_items', 'customer_payment.id_customer_payment= customer_payment_items.id_customer_payment')
                                ->where('customer_payment.id_loan_application_form = ', $loan_id)
                                ->where('payment_type = ', 'late_payment')
                                ->where('customer_payment.status = ', 1)
                                ->where('customer_payment_items.status = ', 1)
                                ->order_by('customer_payment.id_customer_payment', 'desc')
                                ->limit('1')
                                ->get()->result();
//                                 echo $loan_id.'<br><pre>$paid_last_penalty= ';        print_r($paid_last_penalty);
                //                   exit();
                                   
                // last penelty paid week eken pasu eelanga waarika dinaya ganima                 
                if (!empty($paid_last_penalty)) {
                    
                    $next_payments = $this->db->select('id_loan_schedule,date,')
                                    ->from('loan_schedule')
                                    ->where('id_loan_application_form = ', $loan_id)
                                    ->where('payment_type = ', 'instalment')
                                    ->where('payment_status = ', 'not_paid')
                                    ->where('late_panelty_paid != ', 1)
                                    ->where('status = ', 1)
                                    ->where('id_loan_schedule > ', $panelty_paid_final_id_loan_schedule[0]->id_loan_schedule)
//                                    ->where('date > ', $paid_last_penalty[0]->payment_date)
                                    ->limit('1')
                                    ->order_by('id_loan_schedule')
                                    ->get()->result();

//                                        echo '<br><pre>$next_payments=  ';        print_r($next_payments);

                    if (!empty($next_payments)){
                        // anthima waarikaya nowee nam.
                        if ($next_payments[0]->date > $payment_date) {
//                          echo '$payment_date/$calculate_till= '.$payment_date;
                            $calculate_till = $payment_date;
                        } else {  
    //                                                echo 'next payment date/$calculate_till = '.$next_payments[0]->date;
                            $calculate_till = $next_payments[0]->date;
                        }
                    } else { 
                        // anthima waarikaya nam.
//                        echo $panelty_paid_final_id_loan_schedule[0]->date;
                        $calculate_till = date_create($panelty_paid_final_id_loan_schedule[0]->date);
                        date_add($calculate_till, date_interval_create_from_date_string('7 days'));
                        $calculate_till = date_format($calculate_till, 'Y-m-d');
                    }
//                    echo '<br>'.$calculate_till;

                    $late_days_of_paid_week = $this->calculate_late_days_for_week_payment($paid_last_penalty[0]->payment_date, $calculate_till, $loan_id);
//                                        echo '<br>late_day= '.$paid_last_penalty[0]->payment_date;
//                                        echo '<br>late_days_of_paid_week= '.$late_days_of_paid_week;

                    if ($late_days_of_paid_week > 0) {

                        // create session array 
                        // get this loan shedule
                        //                        $panelty_paid_final_id_loan_schedule = $this->db->select('id_loan_schedule,default_payment')
                        //                            ->from('loan_schedule')
                        //                            ->where('id_loan_application_form = ', $loan_id)
                        //                            ->where('payment_type = ', 'instalment')
                        ////                            ->where('payment_status = ', 'not_paid')
                        //                            ->where('late_panelty_paid = ', 1)
                        //                            ->where('status = ', 1)
                        //                            ->order_by('id_loan_schedule','desc')
                        //                            ->limit('1')
                        //                            ->get()->result();
                        //                            ->get()->row('id_loan_schedule');
                        //                        echo $panelty_paid_final_id_loan_schedule;
                        //                         echo '<br><pre>$panelty_paid_final_id_loan_schedule=  ';        print_r($panelty_paid_final_id_loan_schedule);

                        $default_payment_1 = $panelty_paid_final_id_loan_schedule[0]->default_payment;
                        //                        echo $default_payment;
                        // if first payment reduce overpayment from default payment                        
                        $default_payment_1 = $default_payment_1 - $overPayment;


                        //                        echo $overPayment.'<br> $default_payment =  '.$default_payment.'<br>';                       
                        $fine_remained = $default_payment_1 / 6 * $penalty_rate / 100 * ($late_days_of_paid_week );
//                        $fine_remained = $default_payment_1 / 6 * 15 / 100 * ($late_days_of_paid_week );
                        // 2 = grace period(1) + today ;
//                                                echo '<br> $fine_remained =  '.round($fine_remained);
                        //                    exit();

                        $over_payment_redused = TRUE;

                        $total_surcharge = $total_surcharge + $fine_remained;
//                                                echo '<br> $total_surcharge =  '.$total_surcharge.'<br>';
                        // create session array 
                        $late_payment_penalty_array[$i] = array(
                            'id_loan_schedule' => $panelty_paid_final_id_loan_schedule[0]->id_loan_schedule,
                            'id_loan_application_form' => $loan_id,
                            'penalty_from' => $paid_last_penalty[0]->payment_date,
                            'penalty_to' => $calculate_till,
                            'penalty_amount' => $fine_remained,
                            'no_of_late_days' => $late_days_of_paid_week,
                            'penalty_type' => 'late_payment',
                        );
                        //                        echo '<br><pre>$late_payment_penalty_array=  ';        print_r($late_payment_penalty_array);
                    }
                }
            }
        }
        //***********************end of new part**********************************//
        //  nogewuu waarika walata panelty gananaya kirima
        
//        echo 'end of new part ------------------------------------<br>';
//        echo '<pre> $late_payments array ';
//        print_r($late_payments);
//        echo '</pre>';

        
        foreach ($late_payments as $late_payment) {
            $i++;
            $id_loan_schedule = $late_payment->id_loan_schedule;
            $late_date = $late_payment->date;


            if ($payment_type == 'Weekly') {

                $late_days = $this->calculate_late_days_for_week_payment($late_date, $payment_date, $loan_id);
//                                    echo '<br>$late_payment arr [no]= '.$i.' - $late_days = '.$late_days.'  <br>';                                 
//                                    echo '<br>calculate_late_days_for_week_payment  / $late_date= '.$late_date.' - '.$payment_date.' = $payment_date<br>';                                 
//                                    exit();    
                if ($late_days > 0) {
                    $default_payment = $late_payment->default_payment;
//                    echo '$default_payment   = '.$default_payment;
                    // if first payment reduce overpayment from default payment 
                    
                    // palamu waarikaya nam ha over payment eka adukara nathinam..
                    // over payment....
                    if (($i == 1) && ( $over_payment_redused != TRUE)) {
//                            $default_payment = ($default_payment )- $overPayment;
                        
                        // awlak thibee
//                        if (($default_payment - $fine_remained ) > 0) {
//                            $default_payment = ($default_payment - $fine_remained ) - $overPayment;
//                                echo 'first $default_payment  = '.$default_payment;
//                            echo 'first <br>$fine_remained= '.$fine_remained;
//                        } else {
//                            $default_payment = $default_payment - $overPayment;
//                                echo '<br> $default_payment   = '.$default_payment;
//                            echo 'first <br>';
//                        }
                            $default_payment = $default_payment - $overPayment;
//                            echo '<br> $overPayment =  '.$overPayment.'   $default_payment =  '.$default_payment.'<br>';                 
                    }

//                        echo '$default_payment   = '.$default_payment;
                                 
                    $fine = $default_payment / 6 * $penalty_rate / 100 * ($late_days );
//                    $fine = $default_payment / 6 * 15 / 100 * ($late_days );
                    // 2 = grace period(1) + today ;
//                        echo '<br> $fine =  '.round($fine);
                    //                    exit();
//                        echo '<br> $total_surcharge =  '.$total_surcharge.'<br>';
                    $total_surcharge = $total_surcharge + $fine;
//                        echo '<br> $total_surcharge + fine =  '.$total_surcharge.'<br>';
//                        exit();
                    // save data as array to put on sessions
                    $late_payment_penalty_array[$i] = array(
                        'id_loan_schedule' => $id_loan_schedule,
                        'id_loan_application_form' => $loan_id,
                        'penalty_from' => $late_date,
                        'penalty_to' => $_SESSION['penelty_payment_date'],
                        'penalty_amount' => $fine,
                        'no_of_late_days' => ($late_days),
                        'penalty_type' => 'late_payment',
                    );
                }
            } 
            else {
                // if daily...
                $late_days = $this->calculate_late_days_for_daily_payment($late_date, $payment_date, $id_loan_schedule);

                if ($late_days > 1) {

                    $default_payment = $late_payment->default_payment;
                    // reduce overpayment from default payment from first payment
                    if ($i == 1) {
                        $default_payment = $default_payment - $overPayment;
                    }

                    //                echo '<br> $default_payment =  '.$default_payment.'<br>';
                    $fine = $default_payment * $penalty_rate / 100;
//                    $fine = $default_payment * 15 / 100;
                    $total_surcharge = $total_surcharge + $fine;
                    //                echo '<br> $fine =  '.$fine.'<br>';
                    // save data as array to put on sessions
                    $late_payment_penalty_array[$i] = array(
                        'id_loan_schedule' => $id_loan_schedule,
                        'id_loan_application_form' => $loan_id,
                        'penalty_from' => $late_date,
                        'penalty_to' => $payment_date,
                        'penalty_amount' => $fine,
                        //                    	'no_of_late_days' => $late_days,
                        'penalty_type' => 'late_payment',
                    );
                }
            }
        }

        // if weekly- remove graceperiod fine from total fine......
//        if ($payment_type == 'Weekly' && !empty($late_payments)) {
        if ($payment_type == 'Weekly' && !empty($total_surcharge) && ($total_surcharge>0)) {
//                    echo '<br>---$total_surcharge= '.$total_surcharge;
//            $first_payment = $late_payments[0]->default_payment;
            $first_payment = $default_payment;
            $grace_day_fine = $first_payment / 6 * $penalty_rate / 100;
//            $grace_day_fine = $first_payment / 6 * 15 / 100;
            $total_surcharge = $total_surcharge - $grace_day_fine;
//            echo '<br>---$total_surcharge - grace = '.$total_surcharge;
            if($has_previous_panelty_payments == TRUE){
                // remove previous grace_day_fine again
                $total_surcharge = $total_surcharge + $grace_day_fine;
//                echo '<br>---$total_surcharge + grace= '.$total_surcharge;
            }
            
            $total_surcharge = ($total_surcharge > 0) ? $total_surcharge : '0.00';
//                    echo '<br>$first_payment= '.$first_payment.'<br>$grace_day_fine= '.$grace_day_fine.'<br>$total_surcharge= '.$total_surcharge;
        }


//            echo '<br><pre>';        print_r($late_payment_penalty_array);  echo '<br></pre>';  
        $_SESSION['late_penalty_payment'] = $late_payment_penalty_array;
//               echo '<br>'.round($total_surcharge).'<br>';
//               echo '<br><pre>$late_payment_penalty_array 2=  ';        print_r($late_payment_penalty_array);
//                echo '-------------------------------------------------------<br><br><br></pre>';
//               exit();
        return round($total_surcharge);

    }

    public function calculate_late_days_for_week_payment($late_date, $payment_date, $loan_id) {
        $_SESSION['penelty_payment_date'] = '';
//        echo '<br>function calculate_late_days_for_week_payment ------------------------------------<br>';
//        $loan_id = 9;
//        echo '<br><br>$late_date = '.$late_date.'  ----   $payment_date = '.$payment_date.'<br>';
//        echo '<br>$loan_id= '. $loan_id.'<br>';
//        exit($id_loan_schedule);
//        echo '<br>';        print_r($last_penalty_date);        exit('');
//        $applieded_date = '2015-09-03';
        
                
        // to remove $max_panelty_date + 7 
         $next_payment_date = $this->db->select('date,id_loan_schedule')
                                    ->from('loan_schedule')
                                    ->where('id_loan_application_form = ', $loan_id)
                                    ->where('payment_type = ', 'instalment')
                                    ->where('payment_status = ', 'not_paid')
//                                    ->where('late_panelty_paid != ', 1)
                                    ->where('status = ', 1)
                                    ->where('date > ', $late_date )
                                    ->limit('1')
                                    ->order_by('id_loan_schedule')
//                                    ->get()->row()->date;
                                    ->get()->result();
         
//         echo '<br><pre>$next_payment_date arr =';
//                    print_r($next_payment_date); 
                    
         
         if(empty($next_payment_date)){
            $max_penalty_date = date_create($late_date);
            date_add($max_penalty_date, date_interval_create_from_date_string('7 days'));
            $max_penalty_date = date_format($max_penalty_date, 'Y-m-d');
//            echo '<br>$max_penalty_date = '.$max_penalty_date;
            
//             echo '<br> $next_payment_date = $max_penalty_date  ';
             $next_payment_date_2 = $max_penalty_date;
         } else {
        
             $next_payment_date_2 = $next_payment_date[0]->date;
//             echo '<br>$next_payment_date = '.$next_payment_date[0]->date;
         }
         
         
//                    exit();
        // to remove $max_panelty_date + 7 
        
/*        if ($max_penalty_date < $payment_date) {
//            echo 'get $max_penalty_date<br>';
            $penelty_payment_date = $max_penalty_date;
        } else {
            $penelty_payment_date = $payment_date;
//            echo 'get $payment_date<br>';
        }
 */       
        if ($next_payment_date_2 < $payment_date) {
            $penelty_payment_date = $next_payment_date_2;
        } else {
            $penelty_payment_date = $payment_date;
        }
//        echo('<br>$max_penalty_date= '.$max_penalty_date.'<br>');        exit();
        $_SESSION['penelty_payment_date'] = $penelty_payment_date;
//        echo('<br>$penelty_payment_date= '.$penelty_payment_date.'<br>');        


        $late_date_converted = strtotime($late_date);
        $penelty_payment_date_converted = strtotime($penelty_payment_date);

        $datediff = $penelty_payment_date_converted - $late_date_converted;
//        echo $datediff.'<br>';
        $diffrent_days = floor($datediff / (60 * 60 * 24));
//         echo '$diffrent_days-  '.$diffrent_days;
//         exit();
        // get holidays between two days
        $holidays = $this->db->select('date')
                        ->from('holiday')
                        ->where('status = 1')
                        ->where('date <= ', $penelty_payment_date)
                        ->where('date > ', $late_date)
                        ->get()->result();
//        echo '<br>$holidays = ';        print_r($holidays); 
//         echo '<br> $holidays- '.count($holidays).'<br>';
        $holiday_amount = count($holidays);
        $total_late_days = $diffrent_days - $holiday_amount;
//        echo '<br> $total_late_days- '.$total_late_days.'<br>';
//        echo ' from - '.$late_date.' to- '.$penelty_payment_date.'<br>';
//        echo '<br>end of calculate_late_days_for_week_payment ------------------------------------<br>';
        return $total_late_days;
//        exit();
//       return $return_array;
    }

    public function calculate_late_days_for_daily_payment($late_date, $payment_date, $id_loan_schedule) {
//        echo '<br><br>'.$late_date.'  ----   '.$payment_date.'<br>';
//        echo '<br>'. $id_loan_schedule;
//        exit($id_loan_schedule);
//        echo '<br>';        print_r($last_penalty_date);        exit('');

        $late_date_converted = strtotime($late_date);
        $payment_date_converted = strtotime($payment_date);

        $datediff = $payment_date_converted - $late_date_converted;
//        echo $datediff.'<br>';
        $diffrent_days = floor($datediff / (60 * 60 * 24));
//         echo '$diffrent_days-  '.$diffrent_days;
//         
        // get holidays between two days
        $holidays = $this->db->select('date')
                        ->from('holiday')
                        ->where('status = 1')
                        ->where('date < ', $payment_date)
                        ->where('date > ', $late_date)
                        ->get()->result();
//         echo '<br> $holidays- '.count($holidays);
        $holiday_amount = count($holidays);
        return $total_late_days = $diffrent_days - $holiday_amount;

//       return $return_array;
    }

    public function calculate_total_surcharge($loan_id, $payment_date) {

        // clear sessions
        $_SESSION['penalty_payment'] = '';

//        echo $_SESSION['a'];
//         exit('');
//        echo($loan_id." - ".$payment_date);
        // get late payments
        $late_payments = $this->db->select('id_loan_schedule,date,default_payment')
                        ->from('loan_schedule')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('payment_type = ', 'instalment')
                        ->where('payment_status = ', 'not_paid')
                        ->where('status = ', 1)
                        ->where('date <= ', $payment_date)
//                        ->order_by('payment_type,id_loan_schedule')
                        ->get()->result();

//        echo '<pre>';
//        print_r($late_payments);
//        exit();
//        echo '<br>$late_payments count = '.  count($late_payments);
        $total_surcharge = 0;
        $payment_penalty_array = '';
        $i = 0;
        foreach ($late_payments as $late_payment) {
            $i++;
//              calculate surchage for late payment 
//              get amount of late dates
            $id_loan_schedule = $late_payment->id_loan_schedule;
            $late_date = $late_payment->date;
            $result = $this->calculate_late_days($late_date, $payment_date, $id_loan_schedule);
//            echo '<br> $late_days'.$result['total_late_days'].'<br>'; 
//            echo '<br> $late_days'.$result['late_date'].'<br>'; 
//            exit();
            $late_days = $result['total_late_days'];
            $new_late_date = $result['late_date'];
            if ($late_days > 1) {
                $default_payment = $late_payment->default_payment;
//                echo '<br> $default_payment =  '.$default_payment.'<br>';
                $fine = $default_payment * 15 / 100 * $late_days;
                $total_surcharge = $total_surcharge + $fine;
//                echo '<br> $fine =  '.$fine.'<br>';
                // save data as array to put on sessions
                $payment_penalty_array[$i] = array(
                    'id_loan_schedule' => $id_loan_schedule,
                    'penalty_from' => $new_late_date,
                    'penalty_to' => $payment_date,
                    'penalty_amount' => $fine,
                    'no_of_late_days' => $late_days,
                    'penalty_type' => 'late_payment',
                );
            }
        }
        $_SESSION['penalty_payment'] = $payment_penalty_array;
//        echo $total_surcharge;
//        return $total_surcharge;
                exit($total_surcharge);
//              exit($late_date.' - '. $payment_date);   
//        echo '<pre>';
//        print_r($late_payments);
////        print_r($where);
//        exit();
    }

    public function calculate_late_days($late_date, $payment_date, $id_loan_schedule) {
//        echo '<br><br>'.$late_date.'  ----   '.$payment_date.'<br>';
//        echo '<br>'. $id_loan_schedule;
//        exit($id_loan_schedule);
        // get previoustly payed penalty dates if exists.
        $last_penalty_date = $this->db->select_max('penalty_to')
                        ->from('penalty_payment')
                        ->where('id_loan_schedule = ', $id_loan_schedule)
                        ->where('penalty_type = ', 'late_payment')
                        ->where('status = ', '1')
                        ->get()->result();

        // if peneltis are previously paied...
        $saved_last_penalty_date = $last_penalty_date[0]->penalty_to;

        if (!empty($saved_last_penalty_date) && $saved_last_penalty_date != 0000 - 00 - 00) {
            $late_date = $saved_last_penalty_date;
        }
//        echo '<br>';        print_r($last_penalty_date);        exit('');

        $late_date_converted = strtotime($late_date);
        $payment_date_converted = strtotime($payment_date);

        $datediff = $payment_date_converted - $late_date_converted;
//        echo $datediff.'<br>';
        $diffrent_days = floor($datediff / (60 * 60 * 24));
//         echo '$diffrent_days-  '.$diffrent_days;
//         
        // get holidays between two days
        $holidays = $this->db->select('date')
                        ->from('holiday')
                        ->where('status = 1')
                        ->where('date < ', $payment_date)
                        ->where('date > ', $late_date)
                        ->get()->result();
//         echo '<br> $holidays- '.count($holidays);
        $holiday_amount = count($holidays);
        $return_array['total_late_days'] = $diffrent_days - $holiday_amount;
        $return_array['late_date'] = $late_date;
        return $return_array;
//       return $total_late_dates = $diffrent_days - $holiday_amount;
        /*        echo '<br> tot = '.count($holidays);
          echo '<br> <pre> ';
          echo $late_date.'  ----   '.$payment_date.'<br>';
          echo '<br> '.$total_late_dates = $diffrent_days - $holiday_amount;
          echo '<br> ';
          echo '<br> ';
          print_r($holidays);
          //        echo $diffrent_days2 = round($datediff/(60*60*24));
          exit();
         */
    }

    public function calculate_late_days_test($late_date, $payment_date) {
        echo $late_date . '  ----   ' . $payment_date . '<br>';
        echo $today = date('Y-m-d');
        echo '<br>';
        $now = time(); // or your date as well
//        $your_date = strtotime("2010-01-01");
        $late_date = strtotime($late_date);
        $today = strtotime($today);
        $payment_date = strtotime($payment_date);

//        $datediff = $now - $late_date;
//        echo $payment_date.' pd ----  td '.$today.'....<br>';
        $datediff = $payment_date - $now;
        $datediff = $payment_date - $today;
//        $datediff = $payment_date - $late_date;
        echo $datediff . '<br>';
        echo $diffrent_days = floor($datediff / (60 * 60 * 24));
        echo '<br>  ';
        echo $diffrent_days2 = round($datediff / (60 * 60 * 24));
        exit();
    }

    public function calculate_exceed_panalty($loan_id, $payment_date) {
        // clear sessions
        $_SESSION['exceed_penalty_payment'] = '';


//        echo $loan_id.' --- '.$payment_date;
        //Get final payment date
        $final_payment = $this->db->select_max('date')
                        ->from('loan_schedule')
                        ->where('status =', 1)
                        ->where('payment_type =', 'instalment')
                        ->where('id_loan_application_form =', $loan_id)
                        ->get()->result();

        $final_payment_date = $final_payment[0]->date;
//         echo '<br><pre>';        print_r($final_payment);    


        // weekly - then, add 7 days to get the closing date
        // modifid on 2015-10-20  -- weekly exceed panalty date change
        $payment_type = $this->db->select('payment_term')
                        ->from('loan_application_form')
                        ->join('loan_type', 'loan_application_form.id_loan_type = loan_type.id_loan_type')
                        ->where('loan_application_form.id_loan_application_form', $loan_id)
                        ->get()
                        ->row()->payment_term;

//        echo $payment_type;
//        echo '<br><pre>';        print_r($late_payments);        exit('');
//        exit('here');
        if ($payment_type == 'Weekly') {
            // final_payment_date += 7 days
            // final_payment_date += 14 days

            $final_payment_date = date_create($final_payment_date);
//            date_add($final_payment_date, date_interval_create_from_date_string('7 days'));
            date_add($final_payment_date, date_interval_create_from_date_string('14 days'));
            $final_payment_date = date_format($final_payment_date, 'Y-m-d');
        }
        // modifid on 2015-10-20  -- end of weekly exceed panalty date change

//            echo $f1inal_payment_date;
        if ($payment_date > $final_payment_date) {
//            echo 'exceeded';

            $exceeded_penalty = $this->calculate_exceed_panalty_amount($loan_id, $payment_date, $final_payment_date);
            return $exceeded_penalty;
        } else {
//            echo 'not exceeded';
            return '';
        }
//echo '<br><pre>';print_r($final_payment);exit();
    }

    public function calculate_exceed_panalty_amount($loan_id, $payment_date, $final_payment_date) {
        $last_exceed_penalty_date = $this->db->select_max('penalty_to')
                        ->from('penalty_payment')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('penalty_type = ', 'exceeded')
                        ->where('status = ', '1')
                        ->get()->result();
//        echo '<br><pre>';print_r($last_exceed_penalty_date);
//        echo 'penalty_to= '.$last_exceed_penalty_date[0]->penalty_to;
//        exit();
        $saved_last_penalty_date = $last_exceed_penalty_date[0]->penalty_to;
        if (!empty($saved_last_penalty_date) && $saved_last_penalty_date != 0000 - 00 - 00) {
            $final_payment_date = $saved_last_penalty_date;
        }
//        echo '<br>$final_payment_date = '.$final_payment_date .'<br>$payment_date= '.$payment_date.'<br>';

        $final_payment_date_converted = strtotime($final_payment_date);
        $payment_date_converted = strtotime($payment_date);

        $datediff = $payment_date_converted - $final_payment_date_converted;
//        echo $datediff.'<br>';
        $diffrent_days = floor($datediff / (60 * 60 * 24));
//         echo '$diffrent_days-  '.$diffrent_days.'<br>';
//         exit();
        //check if holidays were there..
        $holidays = $this->db->select('date')
                        ->from('holiday')
                        ->where('status = 1')
                        ->where('date < ', $payment_date)
                        ->where('date > ', $final_payment_date)
                        ->get()->result();
//          echo '<br><pre>';print_r($holidays); echo '</pre>';
//         echo '<br> $holidays- '.count($holidays).' <br> ';
        $holiday_amount = count($holidays);
        $total_exceeded_days = $diffrent_days - $holiday_amount;
//         echo '<br> $total_exceeded_days- '.$total_exceeded_days.' <br> ';
        // calculate totoal exceeded penalty..
        // get $interest_for_a_month

        $data = $this->db->select('loan_amount,interest_rate')
                        ->from('loan_application_form')
                        ->join('loan_type', 'loan_application_form.id_loan_type = loan_type.id_loan_type')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->get()->result();
        $laon_amount = $data[0]->loan_amount;
        $interest_rate = $data[0]->interest_rate;
        $interest_for_a_month = $laon_amount * $interest_rate / 100;

        // exceed penalty = interest_for_a_month / working_days_for_a_month * exceeded_days
        // working_days_for_a_month = 25 ( a constant)
        $exceeded_penalty = $interest_for_a_month / 25 * $total_exceeded_days;

//        echo '<br>$interest_for_a_month= '.$interest_for_a_month.'<br><pre>';
////        print_r($data); 
//        echo '</pre>';
//        echo '<br>$exceeded_penalty= '.$exceeded_penalty.'<br>';
        if ($exceeded_penalty <= 0) {
            return '';
        }
        // generate session array
        $exceed_penalty_array = array(
//                    	'id_loan_schedule' => $id_loan_schedule,
            'id_loan_application_form' => $loan_id,
            'penalty_from' => $final_payment_date,
            'penalty_to' => $payment_date,
            'penalty_amount' => $exceeded_penalty,
            'no_of_late_days' => $total_exceeded_days,
            'penalty_type' => 'exceeded',
        );

        $_SESSION['exceed_penalty_payment'] = $exceed_penalty_array;
//         echo '<br><pre>';print_r($exceed_penalty_array);
//         print_r($_SESSION['exceed_penalty_payment']);
        return round($exceeded_penalty);
//        exit('dfsdf');
    }

    public function calculate_exceed_panalty_amount_test($loan_id, $payment_date, $final_payment_date) {
        $last_exceed_penalty_date = $this->db->select_max('penalty_to')
                        ->from('penalty_payment')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->where('penalty_type = ', 'exceeded')
                        ->where('status = ', '1')
                        ->get()->result();
//        echo '<br><pre>';print_r($last_exceed_penalty_date);
//        echo $last_exceed_penalty_date[0]->penalty_to;
//        exit();
        $saved_last_penalty_date = $last_exceed_penalty_date[0]->penalty_to;
        if (!empty($saved_last_penalty_date) && $saved_last_penalty_date != 0000 - 00 - 00) {
            $final_payment_date = $saved_last_penalty_date;
        }
        echo '<br>$final_payment_date = ' . $final_payment_date . '<br>$payment_date= ' . $payment_date . '<br>';

        $final_payment_date_converted = strtotime($final_payment_date);
        $payment_date_converted = strtotime($payment_date);

        $datediff = $payment_date_converted - $final_payment_date_converted;
        echo $datediff . '<br>';
        $diffrent_days = floor($datediff / (60 * 60 * 24));
        echo '$diffrent_days-  ' . $diffrent_days;
//         exit();
        //check if holidays were there..
        $holidays = $this->db->select('date')
                        ->from('holiday')
                        ->where('status = 1')
                        ->where('date < ', $payment_date)
                        ->where('date > ', $final_payment_date)
                        ->get()->result();
        echo '<br><pre>';
        print_r($holidays);
        echo '</pre>';
        echo '<br> $holidays- ' . count($holidays) . ' <br> ';
        $holiday_amount = count($holidays);
        echo $total_exceeded_days = $diffrent_days - $holiday_amount;

        // calculate totoal exceeded penalty..
        // get $interest_for_a_month

        $data = $this->db->select('loan_amount,interest_rate')
                        ->from('loan_application_form')
                        ->join('loan_type', 'loan_application_form.id_loan_type = loan_type.id_loan_type')
                        ->where('id_loan_application_form = ', $loan_id)
                        ->get()->result();
        $laon_amount = $data[0]->loan_amount;
        $interest_rate = $data[0]->interest_rate;
        $interest_for_a_month = $laon_amount * $interest_rate / 100;

        // exceed penalty = interest_for_a_month / working_days_for_a_month * exceeded_days
        // working_days_for_a_month = 25 ( a constant)
        $exceeded_penalty = $interest_for_a_month / 25 * $total_exceeded_days;

        echo '<br>$interest_for_a_month= ' . $interest_for_a_month . '<br><pre>';
        print_r($data);
        echo '</pre>';
        echo '<br>$exceeded_penalty= ' . $exceeded_penalty;

        // generate session array
        $exceed_penalty_array = array(
//                    	'id_loan_schedule' => $id_loan_schedule,
            'id_loan_application_form' => $loan_id,
            'penalty_from' => $final_payment_date,
            'penalty_to' => $payment_date,
            'penalty_amount' => $exceeded_penalty,
            'no_of_late_days' => $total_exceeded_days,
            'penalty_type' => 'exceeded',
        );

        $_SESSION['exceed_penalty_payment'] = $exceed_penalty_array;
        echo '<br><pre>';
        print_r($exceed_penalty_array);

        print_r($_SESSION['exceed_penalty_payment']);
        echo '</pre>';
        return $exceeded_penalty;
        exit('dfsdf');
    }

    public function save_customer_payment() {
        /*
         *     // To test--------    
         * 

          echo $this->input->post('paid_items_amount');
          echo '<br>';
          echo $this->input->post('payment_rows');

          $paid_items_amount = $this->input->post('paid_items_amount');
          $payment_rows = $this->input->post('payment_rows');

          if( $paid_items_amount == $payment_rows){
          $loan_level = array(
          'loan_level' => 'completed',
          );
          $where['id_loan_application_form'] = $this->input->post('id_loan_application_form');
          echo '<pre>';
          print_r($loan_level);
          print_r($where);

          //            $this->db->update('loan_application_form',$loan_level, $where);
          }
          exit('----');
         * 
         */
        $this->db->trans_start();

        /*
         * insert in 'customer_payment' table
         */
        $array = array(
            'id_loan_application_form' => $this->input->post('id_loan_application_form'),
            'id_customer' => $this->input->post('id_customer'),
            'payment_no' => $this->input->post('payment_no'),
            'cp_no' => $this->input->post('cp_no'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_amount' => $this->input->post('payment_amount'),
            'open_balance' => $this->input->post('open_balance'),
            'slr' => $this->input->post('slr'),
            'total_value' => $this->input->post('total_value'),
            'balance_amount' => $this->input->post('balance'),
            'note' => $this->input->post('note'),
            'penalty' => (float)str_replace(",","",$this->input->post('penaly_bf')),
        );
//        echo '<pre>';       
//        print_r($array);
//        exit();
        $this->db->insert('customer_payment', $array);
        $customer_payment_id = $this->db->insert_id();
//        $customer_payment_id = 890;

        /*
         * update 'loan_application_form. remained_balance' field
         */
        $balance = array(
            'open_balance' => $this->input->post('balance'),
        );
        $balance_where['id_loan_application_form'] = $this->input->post('id_loan_application_form');

        $this->db->update('loan_application_form', $balance, $balance_where);


        /*
         * 
         * Insert in 'customer_payment_items'  table
         * 
         */
		 $totalInstallements	=	0;
		 $totalArrears			=	0;
		 $totalPanelty			=	0;
		 
		 $totalArrears			=	(double)str_replace(" ","",$this->input->post("arrearsNew"));
		 $loanno				=	$this->input->post("loanno");
		 $contact				=	$this->input->post("contact");
		 $paymentAm				=	(double)str_replace(",","",$this->input->post("payment_amount"));
		 $moreDue				=	(double)$totalArrears-$paymentAm;

        $paid_items_amount = $this->input->post('paid_items_amount');
//        echo $paid_items_amount;
        $details_array = array();

        for ($i = 1; $i <= $paid_items_amount; $i++) {

            $instalment_type = $this->input->post('instalment_type_' . $i);
//            echo '<br>----------'.$instalment_type.'------<br>';
            $details_array = array(
                'id_customer_payment' => $customer_payment_id,
                'payment_type' => $instalment_type,
                'pay_amount' => $this->input->post('instalment_amount_' . $i),
                'default_date' => $this->input->post('instalment_date_' . $i),
            );

            if ($instalment_type == 'instalment') {
				
				$totalInstallements+=(double)$this->input->post('instalment_amount_' . $i);
				
			}
			
            if ($instalment_type == 'late_payment' || $instalment_type == 'exceed_penalty') {
				
				$totalPanelty+=(double)$this->input->post('instalment_amount_' . $i);
				
			}
		
            if ($instalment_type == 'document_charge' || $instalment_type == 'instalment') {
                $details_array_2 = array(
                    'id_loan_schedule' => $this->input->post('id_loan_schedule_' . $i)
                );
                $details_array = array_merge($details_array, $details_array_2);
            }

//            print_r($details_array);
//            exit();


            $this->db->insert('customer_payment_items', $details_array);



            if ($instalment_type == 'late_payment') {
                /*   ===========================================================
                 * update loan_schedule table and insert into penalty_payment table
                 */// ===========================================================
                $late_payment_array = $_SESSION['late_penalty_payment'];
//                $count = count($late_payment_array);
//                for($r = 1; $r <= $count; $r++){
                foreach ($late_payment_array as $late_payment) {
//                    echo $late_payment_array[$r]['id_loan_schedule'];
                    $update_array = array(
                        'late_panelty_paid' => 1,
                    );
                    $where_array['id_loan_schedule'] = $late_payment['id_loan_schedule'];
//                    print_r($where_array);
                    $this->db->update('loan_schedule', $update_array, $where_array);                    
                    $this->db->insert('penalty_payment', $late_payment);
                    $id_penalty_payment = $this->db->insert_id();
                    $this->db->update('penalty_payment', array('id_customer_payment' => $customer_payment_id ), array('id_penalty_payment' => $id_penalty_payment));
                }
//                exit();
            } else if ($instalment_type == 'exceed_penalty') {
                // ======================================
                //  insert into penalty_payment table
                // ======================================
                $exceed_penalty_array = $_SESSION['exceed_penalty_payment'];
//                print_r($exceed_penalty_array);
                $this->db->insert('penalty_payment', $exceed_penalty_array);
                $id_penalty_payment = $this->db->insert_id();
                $this->db->update('penalty_payment', array('id_customer_payment' => $customer_payment_id ), array('id_penalty_payment' => $id_penalty_payment));
            } else if ($instalment_type == 'document_charge' || $instalment_type == 'instalment') {
                // ======================================
                // update loan_schedule table 
                // ======================================
                $update = array(
                    'payment_status' => 'paid'
                );
                $where['id_loan_schedule'] = $this->input->post('id_loan_schedule_' . $i);
//                print_r($where);
//                print_r($update);
                $this->db->update('loan_schedule', $update, $where);
            }
//          echo '<pre>';      
        }
            if( $paymentAm != '' && is_numeric($paymentAm) && $paymentAm > 0 ){
		$this->load->model("Smsgateway");
		$content="Ginum ankaya :".$loanno."\nOba gewu mudala :".(int)$paymentAm."\nWarika :".(int)($paymentAm-$totalPanelty)."\nPramada gasthu :".(int)$totalPanelty."\nGewiya yuthu ithiri mudala :".(int)$moreDue."\n Wimaseem : 0777183180,0777120123,0773145155";
		$this->Smsgateway->sendSms($content,$contact);
            }     
        /*
         * update  table if all paymetns are completed.
         * 
         */

        $paid_items_amount = $this->input->post('paid_items_amount');
        $payment_rows = $this->input->post('payment_rows');

        if ($paid_items_amount == $payment_rows) {
            $loan_level = array(
                'loan_level' => 'completed',
            );
            $where2['id_loan_application_form'] = $this->input->post('id_loan_application_form');

            $this->db->update('loan_application_form', $loan_level, $where2);
        }

//        echo '<br> $_SESSION["penalty_payment"])'; print_r($_SESSION['penalty_payment']);
//             echo '<br> $_SESSION["late_penalty_payment"])'; print_r($_SESSION['late_penalty_payment']);
//             echo '<br> $_SESSION["exceed_penalty_payment"])'; print_r($_SESSION['exceed_penalty_payment']);
//        exit();

        return $this->db->trans_complete();
    }

    public function check_uniqueness_of_cp_no(){
//         echo 'false';
        $result_arr = array();
        $cp_no = $this->input->post('cp_no');
        $res = $this->db->query("SELECT * FROM customer_payment WHERE cp_no = '".$cp_no."'");
        $num_row = $res->num_rows();
        if($num_row > 0){
            $laon = $res->result();
            $id_laon = $laon[0]->id_loan_application_form;
            $loan_no = $this->db->query("SELECT loan_no FROM loan_application_form WHERE id_loan_application_form = '".$id_laon."'")->row();
            $result_arr[0] = FALSE;
            $result_arr[1] = $loan_no;
            echo json_encode($result_arr);
        } else {
            $result_arr[0] = TRUE;
            echo json_encode($result_arr);
        }
     }

//  ----------------------------------  end of olemi customer payment --------------------------------- 




//  ----------------------------------  begining  of olemi customer payment delete--------------------------------- 

    public function delete_customer_payments($id_loan_application_form, $row_count, $payment_check_box) {
        
        
        $deleted_cp_ids = '';
        $deletable_first_payment = $this->db->select('*')
                                    ->from('customer_payment')
                                    //   ->join('customer_payment_items', 'customer_payment.id_customer_payment= customer_payment_items.id_customer_payment')
                                    ->where('customer_payment.id_loan_application_form = ', $id_loan_application_form)
                                    ->where('customer_payment.id_customer_payment =', $payment_check_box)
                                    ->where('customer_payment.status = ', 1)
                                    //    ->where('customer_payment_items.status = ', 1)
//                                ->order_by('customer_payment.id_customer_payment', 'desc')
//                                ->limit('1')
//                                ->get()->result();
                                   ->get()->num_rows();
        
        if (empty($deletable_first_payment) or $deletable_first_payment != 1) {
            return FALSE;
        }

        $this->db->trans_start();
        // get the  payment that should be deleted and....
        // ....all the other customer payments that come after it
        $deletable_payments = $this->db->select('*')
                            ->from('customer_payment')
                            //   ->join('customer_payment_items', 'customer_payment.id_customer_payment= customer_payment_items.id_customer_payment')
                            ->where('customer_payment.id_loan_application_form = ', $id_loan_application_form)
                            ->where('customer_payment.id_customer_payment >=', $payment_check_box)
                            ->where('customer_payment.status = ', 1)
                            ->get()->result();

        $new_open_balance = $deletable_payments[0]->open_balance;
//        echo 'new ob = '.$new_open_balance;
//        echo '<br><br><br><br>$deletable_payments = <pre>';
//        print_r($deletable_payments);
//        exit();
        
        $count = -1;
        foreach ($deletable_payments as $customer_payment) {
            // foreach customer payment
            
            $deleted_cp_ids .= $customer_payment->id_customer_payment.'/';
            $count++;
            // get all customer_payment_items of each customer_payment
            $deleteable_cp_items = $this->db->select('*')
                                ->from('customer_payment_items')
                                ->where('customer_payment_items.id_customer_payment', $customer_payment->id_customer_payment)
                                ->where('customer_payment_items.status = ', 1)
                                ->get()->result();
            
            foreach ($deleteable_cp_items as $cp_item){
                //foreach customer payment item
                
                // undo each customer payment item
                $payment_type = $cp_item->payment_type;
//                echo '<br>$payment_type = '. $payment_type;
//                echo '<br>$cp_item  = <pre>';
//                print_r($cp_item);
                $id_loan_schedule = $cp_item->id_loan_schedule;
//                echo '$id_loan_schedule= '.$id_loan_schedule;
                
                if($payment_type == 'document_charge' || $payment_type == 'instalment' ){
                    // $this->changeThisSchedule($id_loan_schedule);
                    
                    $update_query = "UPDATE `loan_schedule` SET `payment_status` = 'not_paid'  WHERE  `id_loan_schedule` = ". $id_loan_schedule;
//                    $update_query = "UPDATE `loan_schedule` SET `payment_status` = 'not_paid', `late_panelty_paid` = 0 WHERE  `id_loan_schedule` = ". $id_loan_schedule;
                    $this->db->query($update_query);
                    //`late_panelty_paid` = 0 .......is it correct.........???
                    
                }else if($payment_type == 'late_payment'){
                    
                    // get affected id_loan_schedule's from penalty_payment
                     $getIdScheduleQuery = 'SELECT DISTINCT `id_loan_schedule` FROM `penalty_payment` '
                                                . 'WHERE `penalty_type` = "late_payment" '
                                                . 'AND `status` = 1 '
                                                . 'AND `id_loan_application_form` = '. $id_loan_application_form
                                                . ' AND `id_customer_payment` = '. $customer_payment->id_customer_payment;
                     
                    $paneltyPaidScheduleIds = $this->db->query($getIdScheduleQuery)->result();
//                    echo '<br>$paneltyPaidScheduleIds<pre>';
//                    print_r($paneltyPaidScheduleIds);

                    
                    // change status in penalty_payment / delete penalty_payment s
                     $lp_query = 'UPDATE `penalty_payment` '
                                    . ' SET `status` = 0 '
                                    . ' WHERE  `id_loan_application_form` = '. $id_loan_application_form
//                                    . ' AND  `id_loan_schedule` = '. $id_loan_schedule
                                    . ' AND  `penalty_type` = "late_payment" '
                                    . ' AND  `id_customer_payment` = '. $customer_payment->id_customer_payment;
                    $this->db->query($lp_query);
                    
                    // change late_panelty_paid in loan_schedule
                    // foreach deleted penalty_payment-ScheduleIds-> chande schedule status 
                    foreach ($paneltyPaidScheduleIds as $id){
                        $penaltyForScheduleQuery = 'SELECT * FROM `penalty_payment` '
                                                    . 'WHERE `penalty_type` = "late_payment" '
                                                    . 'AND `status` = 1 '
                                                    . 'AND `id_loan_schedule` = '. $id->id_loan_schedule;
                        $penaltyForSchedule = $this->db->query($penaltyForScheduleQuery)->num_rows();

                        if (empty($penaltyForSchedule) or $penaltyForSchedule  < 1) {
                            $updateSchedulePenaltyQuery = "UPDATE `loan_schedule` SET  `late_panelty_paid` = 0 WHERE  `id_loan_schedule` = ". $id->id_loan_schedule;
                            $this->db->query($updateSchedulePenaltyQuery);
                        }
                    }
                    
                    
                    
                }else if($payment_type == 'exceed_penalty'){
                    $exceed_query = 'UPDATE `penalty_payment` '
                                    . ' SET `status` = 0 '
                                    . ' WHERE  `id_loan_application_form` = '. $id_loan_application_form
                                    . ' AND   `penalty_type` = "exceeded" '
                                    . ' AND  `id_customer_payment` = '. $customer_payment->id_customer_payment;
//                                    . 'AND   `penalty_to` = '. $cp_item->default_date;
                    $this->db->query($exceed_query);
                    
                }
                
            } // end of  foreach customer payment items
            
            // CHANGE ALL CUSTOMER PAYMENT ITEMS STATUS TO 0
            $update_query = "UPDATE `customer_payment_items` SET `status` = '0' WHERE  `id_customer_payment` = ". $customer_payment->id_customer_payment;
            $this->db->query($update_query);
            
            // CHANGE CUSTOMER PAYMENT STATUS TO 0
            $cp_update_query = "UPDATE `customer_payment` SET `status` = '0' WHERE  `id_customer_payment` = ". $customer_payment->id_customer_payment;
            $this->db->query($cp_update_query);
//            echo '<br><br><br><br>$deleteable_cp_items = <pre>';
//            print_r($deleteable_cp_items);
//             exit();
            
        } // end of  foreach customer payment
        
        // update loan_application_form open balance
        $lap_update_query = "UPDATE `loan_application_form` SET `open_balance` = '".$new_open_balance."', `loan_level` = 'active' WHERE  `id_loan_application_form` = ". $id_loan_application_form;
        $this->db->query($lap_update_query);
        
        $user_activity = 'customer payment delete:: id_customer_payment: '.$deleted_cp_ids;
        $this->saveAccountInformation($user_activity);
        
        return $this->db->trans_complete();
     }
  
     public function changeThisSchedule($id_loan_schedule){
         // change payment_status = 'not_paid' and late_panelty_paid = 0  in loan_schedule
         // $thisLoanSchedule = $this->db->query('SELECT * FROM `loan_schedule` WHERE `id_loan_schedule` = '. $id_loan_schedule)->result();
         $update_query = "UPDATE `loan_schedule` SET `payment_status` = 'not_paid', `late_panelty_paid` = 0 WHERE  `id_loan_schedule` = ". $id_loan_schedule;
         
         if(!$this->db->query($update_query)){
             return FALSE;
         }
    /*     
         echo $id_loan_schedule.' $id_loan_schedule <br>';
         echo $thisLoanSchedule[0]->late_panelty_paid.' late_panelty_paid <br>';
         
         if($thisLoanSchedule[0]->late_panelty_paid == 1){
             // remove penalties for this loan_schedule
             // not ok...................has more penalty_payment records for one schedule
            return $this->removePenaltyStatus($id_loan_schedule);
         }
    */     
         return TRUE;
     }
     
     public function removePenaltyStatus($id_loan_schedule){
         // remove penalties for this loan_schedule
         // not ok....................has more penalty_payment records for one schedule
        return $this->db->query('UPDATE `penalty_payment` SET `status` = 0 WHERE  `id_loan_schedule` = '. $id_loan_schedule);
     }
     
     public function saveAccountInformation($user_activity){
         // save datails about delete function
        $data = array(
            'user' => $this->session->userdata['session_user_data']['username'],
            'activity' => $user_activity,
            'date_time' => date("Y-m-d H:i:s"),
            'remote_address' => $_SERVER['REMOTE_ADDR'],
        );

//        echo '<pre>';
//        print_r($data);
//            exit();
        return $this->db->insert('user_activity', $data);
     }
//  ----------------------------------  end of olemi customer payment delete --------------------------------- 


//  ----------------------------------  olemi loan delete --------------------------------  
     public function delete_loan($id_loan_application_form){
         
         $this->db->trans_start();
         
         $lap_update_query = "UPDATE `loan_application_form` SET  `status` = '0' WHERE  `id_loan_application_form` = ". $id_loan_application_form;
         $this->db->query($lap_update_query);
         
         $user_activity = 'loan delete:: id_loan_application_form: '.$id_loan_application_form;
         $this->saveAccountInformation($user_activity);
         
         return $this->db->trans_complete();
     }
//  ----------------------------------  end of olemi loan delete --------------------------------- 
}
 
// end of class

