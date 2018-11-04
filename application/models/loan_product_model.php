<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Loan_product_model extends CI_Model {
    
    


    public function addForm() {
        $repayment_order = "";
        $name = $this->input->post('repayment_order');
        
            foreach ($name as $n){
                $repayment_order.=$n.',';
            }
       
        $data = array(
            'loan_product_name' => $this->input->post('loan_product_name'),
            'disbursed_by' => $this->input->post('disbursed_by'),
            'min_principle_ammount' => $this->input->post('min_principle_ammount'),
            'max_principle_ammount' => $this->input->post('max_principle_ammount'),
            'dif_principle_ammount' => $this->input->post('dif_principle_ammount'),
            'interest_method' => $this->input->post('interest_method'),
            'interest_charged' => $this->input->post('interest_charged'),
            'interest_type' => $this->input->post('interest_type'),
            'interest_period' => $this->input->post('interest_period'),
            'min_interest' => $this->input->post('min_interest'),
            'max_interest' => $this->input->post('max_interest'),
            'dif_interest' => $this->input->post('dif_interest'),
            'duration_period' => $this->input->post('duration_period'),
            'min_duration' => $this->input->post('min_duration'),
            'max_duration' => $this->input->post('max_duration'),
            'dif_duration' => $this->input->post('dif_duration'),
            'repayment_cycle' => $this->input->post('repayment_cycle'),
            'min_repayment' => $this->input->post('min_repayment'),
            'max_repayment' => $this->input->post('max_repayment'),
            'dif_repayment' => $this->input->post('dif_repayment'),
            'repayment_order' => $repayment_order,
            'cal_penalty_on' => $this->input->post('cal_penalty_on'),
            'panalty_rate' => $this->input->post('panalty_rate'),
            'grace_period' => $this->input->post('grace_period'),
            'recurring_period' => $this->input->post('recurring_period'),
            'recurring_on' => $this->input->post('recurring_on')
        );

//        echo '<pre>';
//        print_r($data);
//            exit();
        return $this->db->insert('loan_product', $data);
    }
    
    public function updateForm() {
        $repayment_order = "";
        $name = $this->input->post('repayment_order');
        
            foreach ($name as $n){
                $repayment_order.=$n.',';
            }
            
        $data = array(
            'loan_product_name' => $this->input->post('loan_product_name'),
            'disbursed_by' => $this->input->post('disbursed_by'),
            'min_principle_ammount' => $this->input->post('min_principle_ammount'),
            'max_principle_ammount' => $this->input->post('max_principle_ammount'),
            'dif_principle_ammount' => $this->input->post('dif_principle_ammount'),
            'interest_method' => $this->input->post('interest_method'),
            'interest_charged' => $this->input->post('interest_charged'),
            'interest_type' => $this->input->post('interest_type'),
            'interest_period' => $this->input->post('interest_period'),
            'min_interest' => $this->input->post('min_interest'),
            'max_interest' => $this->input->post('max_interest'),
            'dif_interest' => $this->input->post('dif_interest'),
            'duration_period' => $this->input->post('duration_period'),
            'min_duration' => $this->input->post('min_duration'),
            'max_duration' => $this->input->post('max_duration'),
            'dif_duration' => $this->input->post('dif_duration'),
            'repayment_cycle' => $this->input->post('repayment_cycle'),
            'min_repayment' => $this->input->post('min_repayment'),
            'max_repayment' => $this->input->post('max_repayment'),
            'dif_repayment' => $this->input->post('dif_repayment'),
            'repayment_order' => $repayment_order,
            'cal_penalty_on' => $this->input->post('cal_penalty_on'),
            'panalty_rate' => $this->input->post('panalty_rate'),
            'grace_period' => $this->input->post('grace_period'),
            'recurring_period' => $this->input->post('recurring_period'),
            'recurring_on' => $this->input->post('recurring_on')
        );

        $where['id_loan_product']= $this->input->post('id_loan_product');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('loan_product', $data, $where);
    }
    public function removeForm() {
        $data = array(
            'status' => 0,
        );
        $where['id_loan_type']= $this->input->post('id_loan_type');
        return $this->db->update('loan_type', $data, $where);
    }

    public function loadList() {
        return $res = $this->db->select('*')
                        ->from('loan_product')
//                        ->where('status = 1')
                        ->get()->result();
    }

//  ---------------------------------- 2018-05-27 ---------------------------------
    // get Loan product for update
    public function getLoanProduct($id){
        return $this->db->query("select * from `loan_product` where `id_loan_product`=$id")->result();
    }
    
    function getLoanProductDetail(){
        $id = $this->input->post('id_loan_product');
        $result = $this->db->query("select * from `loan_product` where `id_loan_product`=$id")->result();
        echo json_encode($result);
    }

   




  

}

// end of class

