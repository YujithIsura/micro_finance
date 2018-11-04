<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Developer: Yujith
 * Date : 2018-05-25
 * Create Loan Type
 */

class Add_loan_model extends CI_Model {


    public function addForm() {
        
        $serialNoNew =  $this->getRealSerialNumber("Loan");
        
        $data = array(
            'loan_serial' => $serialNoNew,
            'borrower_id' => $this->input->post('borrower_id'),
            'id_loan_type' => $this->input->post('loan_type'),
            'disbursed_by' => $this->input->post('disbursed_by'),
            'created_date' => date('Y-m-d'),
            'release_date' => $this->input->post('loan_releas_date'),
            'principal_amount' => $this->input->post('principal_amount'),
            'interest_method' => $this->input->post('interest_method'),
            'interest_charged' => $this->input->post('interest_charged'),
            'interest_type' => $this->input->post('interest_type'),
            'interest_period' => $this->input->post('interest_period'),
            'loan_interest' => $this->input->post('loan_interest'),
            'duration_period' => $this->input->post('duration_period'),
            'loan_duration' => $this->input->post('loan_duration'),
            'repayment_cycle' => $this->input->post('repayment_cycle'),
            'loan_repament' => $this->input->post('loan_repament'),
            
        );
//        echo '<pre>';print_r($data);exit();
        return $this->db->insert('Loan_tbl', $data);
    }
    
    public function updateForm() {
        
     
        $data = array(
            
            'borrower_id' => $this->input->post('borrower_id'),
            'id_loan_type' => $this->input->post('loan_type'),
            'disbursed_by' => $this->input->post('disbursed_by'),
            'created_date' => date('Y-m-d'),
            'release_date' => $this->input->post('loan_releas_date'),
            'principal_amount' => $this->input->post('principal_amount'),
            'interest_method' => $this->input->post('interest_method'),
            'interest_charged' => $this->input->post('interest_charged'),
            'interest_type' => $this->input->post('interest_type'),
            'interest_period' => $this->input->post('interest_period'),
            'loan_interest' => $this->input->post('loan_interest'),
            'duration_period' => $this->input->post('duration_period'),
            'loan_duration' => $this->input->post('loan_duration'),
            'repayment_cycle' => $this->input->post('repayment_cycle'),
            'loan_repament' => $this->input->post('loan_repament'),
            
        );
        $where['loan_id']= $this->input->post('loan_id');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('Loan_tbl', $data, $where);
    }
    public function removeForm() {
        
        $where['loan_id']= $this->input->post('loan_id');
        return $this->db->delete('Loan_tbl', $where);
    }
    
     public function getRealSerialNumber($form){
        $this->db->trans_start();
        $serialNo   =   $this->getSerialNumber($form);
        
        $realSerial =   $this->validateSerial($serialNo,$form);
        
        $this->db->trans_complete();
        
        return $realSerial;
    }
    
    public function updateSerial($form){
        $form   =   $this->db->escape($form);
        $sql    =   $this->db->query("UPDATE loan_serial SET num=num+1 WHERE form=$form");
    }
     
    public function validateSerial($serialNo,$form){
        $this->db->trans_start();

        while($this->checkSerial($serialNo,$form)==false){
            
            $this->updateSerial($form);
            $serialNo   =   $this->getSerialNumber($form);
        }
        
        $this->db->trans_complete();
        
        return $serialNo;
    }
    
     public function checkSerial($serialNo,$form){
        
        $res    =   $this->get_serial($serialNo);
        
        if(count($res)>0){
            return false;
        }else{
            return true;
        }
    }
   
    public function getSerialNumber($form){
        $form2  =   $this->db->escape($form);
        
        $res    =   $this->db->query("SELECT * FROM loan_serial WHERE form=$form2")->result();
        
        if(isset($res[0])){
            $serial =   $res[0]->start.$res[0]->num;
            return $serial;
        }else{
            return "";
        }
        
    }
      
    public function get_serial($serial){
        $serial =   $this->db->escape($serial);
        return $this->db->query("SELECT * FROM Loan_tbl WHERE loan_serial=$serial")->result();
    }
    
     public function appLoan() {
        $this->db->trans_start();
        $table_size = $this->input->post('table_size');
//        print_r($table_size.'f');exit();
        for ($i = 0; $i < $table_size; $i++) {
            $chk_box = $this->input->post('checkbox' . $i);
            $serialNo = $this->input->post('serial' . $i);
            $loanSerial = $this->input->post('loan_serial' . $i);
            
//            echo $loanSerial;exit();

            if (isset($chk_box)) {
                $sql = $this->db->query("SELECT * FROM Loan_tbl WHERE loan_id='" . $serialNo . "'");
                if ($sql->num_rows() > 0) {
//                    echo '<pre>';
                    $sql = $this->db->query("UPDATE  Loan_tbl SET approved=1 WHERE loan_id='" . $serialNo . "'");
                    $this->saveLoanSchedule($serialNo,$loanSerial);//save loan schedule for repayment.
//                    print_r($sql->result());
                } 
            } 
        }
        return $this->db->trans_complete();
    }
    
     public function saveLoanSchedule($serialNo,$loanSerial) {
         $interest = 0;
         $due = 0;
         $pending_due = 0;
         $principal_bal = 0;
         $principal_due = 0;
         $last_bal = 0;
         $pri = 0;
         $pri_bal = 0;
         $sheduleCount = $this->input->post('sheduleCount');
         $release_date = $this->input->post('release_date');
         $release_date = date('Y-m-d', strtotime(date($release_date)." -1 month"));
         $no_of_repayment = $this->input->post('no_of_repayment');
         $repayment_cycle = $this->input->post('repayment_cycle');
         $principal_amount = $this->input->post('principal_amount');
         $interest_period = $this->input->post('interest_period');
         $loan_interest = $this->input->post('loan_interest');
          

            function getCutoffDate($date) {
                $days = cal_days_in_month(CAL_GREGORIAN, $date->format('n'), $date->format('Y'));
                $date->add(new DateInterval('P' . $days .'D'));
                return $date;
            }

//            for($i = 1; $i < $sheduleCount-1; $i++) {
//                $date = getCutoffDate($date);
//                echo $date->format('Y-m-d') . '<br>';
//                echo $i . '<br>';
//            }
         
          $principal =  round(($principal_amount/$no_of_repayment),2);
                               if($interest_period == 'Year'){
                                  $interest = round((($principal_amount/100*$loan_interest)/$no_of_repayment),2);
                               }
                               $due = $interest+$principal;
                               $last_bal = round($principal_amount-($principal*$no_of_repayment),2);
//;                                print_r($last_bal.'-'.$principal.'*'.$no_of_repayment);exit();
                            for($i=1;$i<($no_of_repayment+1);$i++){
                                   $pending_due+=$due;
                                   $principal_due+=$principal;
                                  if($i==$no_of_repayment){$pri = round(($principal+$last_bal),2);}else{$pri = $principal;}
                                  if($i==$no_of_repayment){ $pri_bal = round(($pri_bal-$pri),2);}else{ $pri_bal = round(($principal_amount-$principal_due),2);}
                                   $date = new DateTime($release_date);
                                   $date = getCutoffDate($date);
                                    $release_date = $date->format('Y-m-d');

                                   $data[$i] = array(
                                       'loan_id' => $serialNo,
                                       'loan_serial' => $loanSerial,
                                       'repayment_date' => $release_date,
                                        'principal_amount' => $pri,
                                        'loan_interest' => $interest,
                                        'due_amount' => $due,
                                        'pending_due' => $pending_due,
                                        'total_due' => $pending_due,
                                        'principal_balance' => $pri_bal,
                                        'opening_balance' => 0,
                                   );
        $this->db->insert('loan_schedule', $data[$i]);
                                }
//                                $array = array_values($data);
//                              
//        echo '<pre>';print_r($data);exit();
                              
                              
                              
                               
    }
    
     public function rejLoan() {
        $this->db->trans_start();
        $table_size = $this->input->post('table_size');
//        print_r($table_size.'f');exit();
        for ($i = 0; $i < $table_size; $i++) {
            $chk_box = $this->input->post('checkbox' . $i);
            $serialNo = $this->input->post('serial' . $i);
//            echo $serialNo;exit();

            if (isset($chk_box)) {
                $sql = $this->db->query("SELECT * FROM Loan_tbl WHERE loan_id='" . $serialNo . "'");
                if ($sql->num_rows() > 0) {
//                    echo '<pre>';
                    $sql = $this->db->query("UPDATE  Loan_tbl SET approved=2 WHERE loan_id='" . $serialNo . "'");
//                    print_r($sql->result());
                } 
            } 
        }
        return $this->db->trans_complete();
    }

    public function loadList() {
        return $res = $this->db->select('*')
                        ->from('loan_type')
//                        ->where('status = 1')
                        ->get()->result();
    }

    public function getLoanSchedule($id) {
        return  $this->db->query("SELECT * FROM `loan_schedule` WHERE loan_id=$id")->result();
    }
    
    
    public function loadLoanList() {
        return $res = $this->db->query("SELECT lt.*,bt.`name`,ty.`loan_type_name` FROM `Loan_tbl` lt LEFT JOIN borrower bt
ON lt.borrower_id=bt.`id_borrower`
LEFT JOIN `loan_type` ty
ON lt.id_loan_type=ty.`id_loan_type`")->result();
                        
    }
    
    public function loadLoanListByLoanId($bId) {
        return $res = $this->db->query("SELECT 
  lt.*,
  bt.`name`,
  ty.`loan_product_name`,
  ls.`principal_amount` AS loan_principal,
  ls.`loan_interest` AS ln_intarest 
FROM
  `Loan_tbl` lt 
  LEFT JOIN borrower bt 
    ON lt.borrower_id = bt.`id_borrower` 
  LEFT JOIN `loan_product` ty 
    ON lt.id_loan_product = ty.`id_loan_product` 
  LEFT JOIN `loan_schedule` ls 
    ON ls.`loan_id` = lt.`loan_id` 
WHERE lt.loan_id = $bId
GROUP BY lt.`serialNo` 

")->result();
                        
    }
    
    public function getLoanData() {
       $loan_id = $this->input->post('loan_id');
       
        $res = $this->db->query("SELECT lt.*,bt.`name`,ty.`loan_type_name` FROM `Loan_tbl` lt LEFT JOIN borrower bt
ON lt.borrower_id=bt.`id_borrower`
LEFT JOIN `loan_type` ty
ON lt.id_loan_type=ty.`id_loan_type` WHERE lt.loan_id=$loan_id ")->result();
       echo json_encode($res);
                        
    }
    
    public function loadLoanForApproval() {
        return $res = $this->db->query("SELECT lt.*,bt.`name`,ty.`loan_type_name` FROM `Loan_tbl` lt LEFT JOIN borrower bt
ON lt.borrower_id=bt.`id_borrower`
LEFT JOIN `loan_type` ty
ON lt.id_loan_type=ty.`id_loan_type`
WHERE approved=0")->result();
                        
    }

    public function borrowerList() {
        return $res = $this->db->select('*')
                        ->from('borrower')
                        ->where('is_in_blacklist != 1')
                        ->get()->result();
    }
    
//    ---------------------------------- Get Repayment Order for Loan Type ----------------------
     public function getRepayment_order(){
         $id = $this->input->post('id_loan_type');
        $result= $this->db->query("SELECT repayment_order FROM `loan_type` WHERE id_loan_type=$id")->result();
        
          $result2 = explode(',', $result[0]->repayment_order);
        echo json_encode($result2);
//         echo "<pre>";         print_r($result); exit();
    }
//    ---------------------------------- Check Duplicate Loan Type ----------------------
     public function checkDuplicate(){
         $loan_type_name = $this->input->post('loan_type_name');
        $result= $this->db->query("SELECT * FROM `loan_type` WHERE `loan_type_name`='$loan_type_name'")->result();
//        echo count($result);exit();
          if(count($result)>0){
              $result2 = "True";
          }else{
              $result2 = "Fauls";
          }
        echo json_encode($result2);
//         echo "<pre>";         print_r($result); exit();
    }
    
    

//  ----------------------------------  olemi---------------------------------

    public function get_list() {

        return $res = $this->db->select('*')
                        ->from('maintanance_service')
//            ->where('status = 1')
                        ->get()->result();
    }

    public function update_task_list() {
        try {
            $begining_rows = $this->input->post('begining_rows');
            $total_table_rows = $this->input->post('total_table_rows');
            $i = 1;

            $this->db->trans_start();

            for ($i; $i <= $begining_rows; $i++) {

                if ($this->input->post('status_' . $i) == '1') {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $task = array(
                    'name' => $this->input->post('name_' . $i),
                    'discription' => $this->input->post('discription_' . $i),
                    'status' => $status,
                );
                $where['id_maintanance_service'] = $this->input->post('id_' . $i);
                $this->db->update('maintanance_service', $task, $where);
            }

            if ($total_table_rows > $begining_rows) {
                if ($this->input->post('status_' . $i) == '1') {
                    $status = 1;
                } else {
                    $status = 0;
                }
                for ($i; $i <= $total_table_rows; $i++) {
                    $task = array(
                        'name' => $this->input->post('name_' . $i),
                        'discription' => $this->input->post('discription_' . $i),
                        'status' => $status,
                    );
                    $this->db->insert('maintanance_service', $task);
                }
            }

            return $this->db->trans_complete();
        } catch (Exception $exc) {
//            $this->session->set_flashdata('message', 'error');
//            redirect('security');
            return FALSE;
        }
    }

    public function UpdateJob() {
        try {
            $this->db->trans_start();

            $id_job = $this->input->post('id_job');
            $repair_service = $this->input->post('repair_service');
            $maintanence_service = $this->input->post('maintanence_service');

            $repair_service_val = (!empty($repair_service) && $repair_service == 'repair_service') ? 1 : 0;
            $maintanence_service_val = (!empty($maintanence_service) && $maintanence_service == 'maintanence_service') ? 1 : 0;

            $data = array(
                'job_number' => $this->input->post('job_number'),
                'repair_service' => $repair_service_val,
                'maintanence_service' => $maintanence_service_val,
                'date_start' => $this->input->post('date_start'),
                'date_end' => $this->input->post('date_end'),
                'job_note' => $this->input->post('job_note'),
            );

            $where['id_job'] = $this->input->post('id_job');
//            echo '<pre>';            print_r($where);           
//            exit();
            $this->db->update('job', $data, $where);


            $query = "SELECT * FROM init_item "
                    . " WHERE init_item.status = 1 AND"
                    . " init_item.is_used = 1 AND"
                    . " init_item.used_job_id = " . $id_job;
            $data = $this->db->query($query);
            $reult = $data->result();

            foreach ($reult as $r) {
                $id_array['ItemID'] = $r->ItemID;
                $change_array['is_used'] = '0';
                $final_reult = $this->db->update('init_item', $change_array, $id_array);
            }
//         echo '<pre>';  print_r($reult);  
//         echo '<pre>';  print_r($final_reult);  

            if (isset($_POST['items_used'])) {
                $items_used = $_POST['items_used'];
//                print_r($items_used);
                foreach ($items_used as $item) {
                    $id_item['ItemID'] = $item;
                    $values_array['is_used'] = '1';
                    $values_array['used_job_id'] = $id_job;
                    $values_array['used_date'] = $this->input->post('date_start');
                    $final_reult = $this->db->update('init_item', $values_array, $id_item);
//                    echo '<pre>';  print_r($values_array);  
                }
            }
            /*    if (isset($_POST['items_used'])) {
              if (is_array($_POST['items_used'])) {
              foreach ($_POST['items_used'] as $value) {
              echo $value;
              }
              } else {
              $value = $_POST['items_used'];
              echo $value;
              }
              }
             */
            return $this->db->trans_complete();
        } catch (Exception $exc) {
//            $this->session->set_flashdata('message', 'error');
//            redirect('security');
            return FALSE;
        }
    }

    public function removeJob() {
        try {
            $this->db->trans_start();

            $id_job = $this->input->post('id_job');

            $query = "SELECT * FROM init_item "
                    . " WHERE init_item.status = 1 AND"
                    . " init_item.is_used = 1 AND"
                    . " init_item.used_job_id = " . $id_job;
            $data = $this->db->query($query);
            $reult = $data->result();

            foreach ($reult as $r) {
                $id_array['ItemID'] = $r->ItemID;
                $change_array['is_used'] = '0';
                $this->db->update('init_item', $change_array, $id_array);
            }

            $data = array('status' => 0);

            $where['id_job'] = $this->input->post('id_job');

            $this->db->update('job', $data, $where);

            return $this->db->trans_complete();
        } catch (Exception $exc) {
//            $this->session->set_flashdata('message', 'error');
//            redirect('security');
            return FALSE;
        }
    }

    public function save_new_job() {

        $this->db->trans_start();
//        $vehicle_id = $this->input->post('vehicle_id');
//        $job_number = $this->input->post('job_number');
        $repair_service = $this->input->post('repair_service');
        $maintanence_service = $this->input->post('maintanence_service');
//        $date_start = $this->input->post('date_start');
//        $job_note = $this->input->post('job_note');

        $repair_service_val = (!empty($repair_service) && $repair_service == 'repair_service') ? 1 : 0;
        $maintanence_service_val = (!empty($maintanence_service) && $maintanence_service == 'maintanence_service') ? 1 : 0;

        $data = array(
            'vehicle_id' => $this->input->post('vehicle_id'),
            'job_number' => $this->input->post('job_number'),
            'repair_service' => $repair_service_val,
            'maintanence_service' => $maintanence_service_val,
            'date_start' => $this->input->post('date_start'),
            'job_note' => $this->input->post('job_note'),
        );

//            echo '<pre>';            print_r($data);           
//            exit();
        $this->db->insert('job', $data);
        $job_id = $this->db->insert_id();

        if (!empty($maintanence_service) && $maintanence_service == 'maintanence_service') {
            $task_list = $this->db->select('id_maintanance_service')
                            ->from('maintanance_service')
                            ->where('status = 1')
                            ->get()->result();

            foreach ($task_list as $task_list_item) {
//                    echo $task_list_item->id_maintanance_service;
                $maintanence_data = array(
                    'job_id' => $job_id,
                    'maintanence_service_id' => $task_list_item->id_maintanance_service,
                    'progress_level' => '0',
                    'status' => 1,
                );
                $this->db->insert('job_maintanence_service', $maintanence_data);
            }
//                print_r($task_list);       
//                exit();
        }
        return $this->db->trans_complete();
    }

    public function load_jobs() {
        return $res = $this->db->select('*')
                        ->from('job')
                        ->join('vehicle', 'job.vehicle_id = vehicle.vehicle_id')
                        ->join('customer', 'customer.customer_id = vehicle.customer_id')
                        ->where('job.status = 1')
                        ->get()->result();
//echo '<pre>'; print_r($res); 
// exit();        
    }

    public function load_job_data($job) {
//        echo 'model '.$job;
        return $res = $this->db->select('*')
                        ->from('job')
                        ->join('vehicle', 'job.vehicle_id = vehicle.vehicle_id')
                        ->join('customer', 'customer.customer_id = vehicle.customer_id')
                        ->where('job.status = 1')
                        ->where('job.id_job = ', $job)
                        ->get()->result();
//echo '<pre>'; print_r($res); 
// exit();        
    }

    public function load_tasks($job) {
        return $res = $this->db->select('*')
                        ->from('job_maintanence_service')
                        ->join('maintanance_service', 'maintanance_service.id_maintanance_service = job_maintanence_service.maintanence_service_id')
                        ->where('job_maintanence_service.job_id =', $job)
                        ->get()->result();
//echo '<pre>'; print_r($res); 
// exit();        
    }

}

// end of class

