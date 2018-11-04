<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Developer: Yujith
 * Date : 2018-07-02
 * Save Loan Repayment.
 */

class Repayment_model extends CI_Model {


    public function SaveRepayment() {
        $loan_id = $this->input->post('loan_id');
        $cus_pay_amount = $this->input->post('repayment_amount');
        $principal_amount = $this->input->post('principal_amount');
        print_r($principal_amount);exit();
        $loan_interest = $this->input->post('loan_interest');
        $collection_date = $this->input->post('collection_date');
        $shedule_date = $this->getScheduleDate($loan_id);
        $today = date('Y-m-d');
         $loanSchedule = $this->getLoanSchedule($loan_id);
         $cnt=0;
         $due_penalty=0;
        $result =  $this->getLoan_tbl_data($loan_id);
        $openingBal =  $result[0]->opening_balance; 
        
        $result2 =  $this->getLoan_data($loan_id);
//        print_r($result2);exit();
        
         $opening_balance = 0;
        if(!empty($loanSchedule)){
        foreach ($loanSchedule as $value) { 
        
        if($cnt==0){
        $new_cus_pay = $cus_pay_amount+$openingBal;
        }else{
         $new_cus_pay = $opening_balance;   
        }
        
        if(!empty($result2)){
        $repayment_order = $result2[0]->repayment_order;
    //    $penalty_grace_period = $result2[0]->grace_period;
        $repayment_order = explode(',',$repayment_order);
     //   $date = date_create($shedule_date);
     //   date_add($date, date_interval_create_from_date_string($penalty_grace_period.' days'));
      //  $shedule_date_for_penalty = date_format($date, 'Y-m-d');
        
        if($cnt==0){
        $penalty_deduct = $this->getPenalty($loan_id,$collection_date,$shedule_date);
        }else{
         $penalty_deduct = 0;   
        }
//        print_r($penalty_deduct);exit();
        $fees = 100;//get fees when compleate add fees option
        $fees_paid = 1;//if fees paid on loan schedule. fees will not be deducted any more
        
        $remaining_bal = $new_cus_pay;
        $paid_principal = 0;
        $paid_intarest = 0;
        $paid_penalty = 0;
        $paid_fees = 0;
        $due_principal = 0;
        $due_intarest = 0;
        $due_penalty = 0;
        $due_fees = 0;
        $remaining_bal_principal = 0;
        if($cnt>0){
        $totPay = $principal_amount + $penalty_deduct + $loan_interest;
//        exit($totPay.'/'.$opening_balance.'/'.$cnt);
       }else{
        $totPay = 0;   
       }
      
       
        if($value->is_paid==0){
        for($i=0;$i<4;$i++){
        if($remaining_bal>=$totPay){
            
        if($repayment_order[$i]=='Principal'){
          if($remaining_bal>=$principal_amount){
              echo $principal_amount.'ff';exit();
                $remaining_bal = $remaining_bal-$principal_amount;
                $paid_principal = $principal_amount;
                $due_principal = 0;
          }else{
                $remaining_bal_principal = $remaining_bal;//temparary remaining bal 
                $remaining_bal = $remaining_bal-$principal_amount;
                if($remaining_bal<0){//for minus remaining values
                    $paid_principal = 0;
                    $due_principal = $principal_amount;
                }else{
                    $paid_principal = $remaining_bal_principal;
                    $due_principal = $principal_amount-$paid_principal;
                }
          }
        }elseif($repayment_order[$i]=='Penalty'){
          if($remaining_bal>=$penalty_deduct){
                $remaining_bal = $remaining_bal-$penalty_deduct;
                $paid_penalty = $penalty_deduct;
                $due_penalty = 0;
          }else{
                $remaining_bal_penalty = $remaining_bal;
                $remaining_bal = $remaining_bal-$penalty_deduct;
                if($remaining_bal<0){
                    $paid_penalty = 0;
                    $due_penalty = $penalty_deduct;
                }else{
                    $paid_penalty = $remaining_bal_penalty;
                    $due_penalty = $penalty_deduct-$paid_penalty;
                }
          }
        }elseif($repayment_order[$i]=='Fees'){
          if($remaining_bal>=$fees && $fees_paid!=1){
                $remaining_bal = $remaining_bal-$fees;
                $paid_fees = $fees;
                $due_fees = 0;
          }elseif($remaining_bal>=$fees && $fees_paid==1){//fees only charge on first repayment
                $paid_fees = 0;
                $due_fees = 0;
          }else{
                $remaining_bal_fees = $remaining_bal;
                $remaining_bal = $remaining_bal-$fees;
                if($remaining_bal<0){
                    $paid_fees = 0;
                    $due_fees = $fees;
                }else{
                    $paid_fees = $remaining_bal_fees;
                    $due_fees = $fees-$paid_fees;
                }
          }          
        }elseif($repayment_order[$i]=='Interest'){
          if($remaining_bal>=$loan_interest){
                $remaining_bal = $remaining_bal-$loan_interest;
                $paid_intarest = $loan_interest;
                $due_intarest = 0;
          }else{
                $remaining_bal_interest = $remaining_bal;
                $remaining_bal = $remaining_bal-$loan_interest;
                if($remaining_bal<0){
                    $paid_intarest = 0;
                    $due_intarest = $loan_interest;
                }else{
                    $paid_intarest = $remaining_bal_interest;
                    $due_intarest = $loan_interest-$paid_intarest;
                }
          }          
        }
        $opening_balance = $remaining_bal;
//        $opening_balance2 .= $remaining_bal.'/';
         if($cnt==1){
          exit($opening_balance);
       }  
        }else{
            break;
        }
        }
        
//        if($cnt==1){
//            exit($opening_balance.'/'.$totPay);
//        }
         $repayment_detail_array[$cnt] = array(
            'paid_principal' => $paid_principal,
            'paid_intarest' => $paid_intarest,
            'paid_penalty' => $paid_penalty,
            'paid_fees' => $paid_fees,
            'due_principal' => $due_principal,
            'due_intarest' => $due_intarest,
            'due_penalty' => $due_penalty,
            'due_fees' => $due_fees
        );
        
        }
     
//        echo '<pre>';print_r($opening_balance2);echo '</pre>';
        
        }
        
       
        $cnt++;
        }
        echo '<pre>';print_r($repayment_detail_array);exit();
         if($opening_balance>=$totPay){
        $due_amount = $due_intarest + $due_principal;
//        print_r($cus_pay_amount.'-'.$collection_date.'-'.$shedule_date.'-'.$new_cus_pay);exit();
        $data1 = array(
            'loan_id' => $loan_id,
            'borrower' => $this->input->post('borrower_id'),
            'repayment_amount' => $this->input->post('repayment_amount'),
            'deposit_to' => $this->input->post('deposit_to'),
            'repayment_method' => $this->input->post('repayment_method'),
            'collection_date' => $this->input->post('collection_date'),
            'collected_by' => $this->input->post('collected_by'),
            'description' => $this->input->post('description'),
            'opening_balance' => (double)number_format((float)$opening_balance, 2, '.', '')
            
        );
//        echo '<pre>';print_r($data);exit();
        $this->db->insert('repayment_headar', $data1);
        $h_id = $this->db->insert_id();
        
        $data2 = array(
            'h_id' => $h_id,
            'loan_id' => $loan_id,
            'collection_date' => $this->input->post('collection_date'),
            'loan_serial' => $this->input->post('loan_serial'),
            'paid_principal' => (double)number_format((float)$paid_principal, 2, '.', ''),
            'paid_intarest' => (double)number_format((float)$paid_intarest, 2, '.', ''),
            'paid_penalty' => (double)number_format((float)$paid_penalty, 2, '.', ''),
            'paid_fees' => (double)number_format((float)$paid_fees, 2, '.', ''),
            'due_principal' => (double)number_format((float)$due_principal, 2, '.', ''),
            'due_intarest' => (double)number_format((float)$due_intarest, 2, '.', ''),
            'due_penalty' => (double)number_format((float)$due_penalty, 2, '.', ''),
            'due_fees' => (double)number_format((float)$due_fees, 2, '.', '')
            
        );
//        echo '<pre>';print_r($data);exit();
        $this->db->insert('repayment_detail', $data2);
        
        $data3 = array(
            'opening_balance' => (double)number_format((float)$opening_balance, 2, '.', '')
            
        );
        $where['loan_id'] = $loan_id;
        $this->db->update('Loan_tbl', $data3, $where);
        
        $res = $this->db->query("SELECT MIN(id) AS id FROM `loan_schedule` WHERE `is_paid`=0 AND `loan_id`=$loan_id")->result();
        $in_id = $res[0]->id;
//        $in_id2 .= $in_id.'/';
        
        $data4 = array(
            'opening_balance' => (double)number_format((float)$opening_balance, 2, '.', ''),
            'due_amount' => (double)number_format((float)$due_amount, 2, '.', ''),
            'is_paid' => 1
            
        );
//        $where['loan_id'] = $loan_id;
         $this->db->update('loan_schedule', $data4, array('loan_id' => $loan_id,'id' => $in_id));
        
        }
//        print_r($in_id2);exit();
        return true;
        }
        
    }

    public function getLoan_tbl_data($loan_id) {
        $result = $this->db->query("SELECT * FROM `Loan_tbl` WHERE loan_id='$loan_id'")->result();
        return $result; 
    }

    public function getLoan_data($loan_id) {
        $result = $this->db->query("SELECT 
  * 
FROM
  `loan_schedule` ls 
  LEFT JOIN `Loan_tbl` lt 
    ON ls.loan_id = lt.`loan_id` 
  LEFT JOIN `loan_product` lp 
    ON lt.`id_loan_product` = lp.`id_loan_product` 
WHERE lt.loan_id = '$loan_id' 
  AND ls.is_paid <> 1 
ORDER BY ls.`repayment_date` ")->result();
        return $result; 
    }

    public function getScheduleDate($loan_id) {
        $result = $this->db->query("SELECT * FROM `loan_schedule` WHERE loan_id='$loan_id' AND is_paid<>1 ORDER BY `repayment_date`")->result();
//        echo '<pre>';print_r($result);exit();
        if(!empty($result)){
        $result = $result[0]->repayment_date;   
        }
        return $result; 
    }
    
     public function getLoanSchedule($id) {
        return  $this->db->query("SELECT * FROM `loan_schedule` WHERE loan_id=$id")->result();
    }

    public function getPenalty($loan_id,$collection_date,$shedule_date) {
        $result = $this->db->query("SELECT * FROM `loan_schedule` ls
                                    LEFT JOIN `Loan_tbl` lt ON ls.loan_id=lt.`loan_id`
                                    LEFT JOIN  `loan_product` lp ON lt.`id_loan_product`=lp.`id_loan_product`
                                    WHERE lt.loan_id='$loan_id' AND ls.is_paid<>1 ORDER BY ls.`repayment_date`")->result();
//        echo '<pre>';print_r($result);exit();
        if(!empty($result)){
        $cal_penalty_on = $result[0]->cal_penalty_on;   
        $panalty_rate = $result[0]->panalty_rate;   
        $grace_period = $result[0]->grace_period;  
        $recurring_period = $result[0]->recurring_period;  
        $recurring_on = $result[0]->recurring_on;  
        $multi = $this->getMultipliar($loan_id,$collection_date,$cal_penalty_on);
        
          
        $shedule_date = new DateTime($shedule_date);
        $collection_date  = new DateTime($collection_date);
        $dDiff = $shedule_date->diff($collection_date);
        $months = $dDiff->y * 12 + $dDiff->m + $dDiff->d / 30;
        $weeks = $dDiff->y * 48 + $dDiff->m + $dDiff->d / 7;
        $yearDiff = $dDiff->y;
        $monthDiff = (Int) $months;
        $weeksDiff = (Int) $weeks;
        $dateDiff = $dDiff->days;
        $cal_penalty_on=1;
        $penalty=0;
        if($grace_period<=$dateDiff){
            if($recurring_on=='Months'){//Cal penalty with recurring 
              
                   if($dDiff->format('%R')=='+'){
                       if($recurring_period<$monthDiff){
                           $devidorM = (int)($monthDiff/$recurring_period);//penalty repeat time
                        $penalty = ($panalty_rate/100)*$multi*$devidorM;
                       }else{
                        $penalty = ($panalty_rate/100)*$multi;   
                       }
                   }else{
                       $penalty = 0;
                   }
            }elseif($recurring_on=='Years'){
                
                   if($dDiff->format('%R')=='+'){
                       if($recurring_period<$yearDiff){
                            $devidorY = (int)($yearDiff/$recurring_period);
                        $penalty = ($panalty_rate/100)*$multi*$devidorY;
                       }else{
                        $penalty = ($panalty_rate/100)*$multi;   
                       }
                   }else{
                       $penalty = 0;
                   }
            }elseif($recurring_on=='Days'){
                
                   if($dDiff->format('%R')=='+'){
                       if($recurring_period<$dateDiff){
                           $devidorD = (int)($dateDiff/$recurring_period);
                        $penalty = ($panalty_rate/100)*$multi*$devidorD;
                       }else{
                        $penalty = ($panalty_rate/100)*$multi;   
                       }
                   }else{
                       $penalty = 0;
                   }
            }
            elseif($recurring_on=='Weeks'){
                
                   if($dDiff->format('%R')=='+'){
                       if($recurring_period<$weeksDiff){
                           $devidorD = (int)($weeksDiff/$recurring_period);
                        $penalty = ($panalty_rate/100)*$multi*$devidorD;
                       }else{
                        $penalty = ($panalty_rate/100)*$multi;   
                       }
                   }else{
                       $penalty = 0;
                   }
            }
          
        }else{
          $penalty = 0;  
        }
        }
        return $penalty; 
    }
    
    function getMultipliar($loan_id,$collection_date,$cal_penalty_on){//Get multiply amount according to overdue amount

//        $this->db->reconnect();
//        $result1 = $this->db->query("CALL Repayment_Due_principal_amount('$loan_id','$collection_date')")->result();
//        $this->db->free_db_resource();
//        $due_principal = $result1[0]->duePrincipal;
//        
//        $this->db->reconnect();
//        $result2 = $this->db->query("CALL Repayment_Due_Interest_amount('$loan_id','$collection_date')")->result();
//        $this->db->free_db_resource();
//        $due_interest = $result2[0]->dueInterest;
        
        $due_principal=1000;
        $due_interest=500;//to be removed after find procedures
        if($cal_penalty_on==1){//Cal penalty on Overdue Principal Amount 
            $multi = $due_principal;
        }elseif($cal_penalty_on==2) {//Cal penalty on Overdue Principal Amount + Overdue Interest 
            $multi = $due_principal+$due_interest;
        }else{
            $multi = $due_principal+$due_interest;
        }
        return $multi;
    }
   

}

// end of class

