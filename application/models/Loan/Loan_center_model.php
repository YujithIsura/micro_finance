<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Loan_center_model extends CI_Model {
    
     public function loadApprovedLoans() {
            $res ="select lt.*,bt.`name`,lp.`loan_product_name` from `loan_tbl` lt left join `loan_product` lp on lt.`id_loan_product`=lp.`id_loan_product`
left join `borrower` bt on lt.`borrower_id`=bt.`id_borrower` where lt.approved='A'";
//            echo $res;exit();
        return $this->db->query("$res")->result();
    }
    
     public function loadLoanListByLoanId() {
         $id = $this->input->post('loan_id');
            $res ="select lt.*,bt.`name`,bt.`borrower_photo`,bt.`contact_no`,lp.`loan_product_name` from `loan_tbl` lt left join `loan_product` lp on lt.`id_loan_product`=lp.`id_loan_product`
left join `borrower` bt on lt.`borrower_id`=bt.`id_borrower` where lt.loan_id=$id";
//            echo $res;exit();
        return $this->db->query("$res")->result();
    }
    
     public function loadLoanCollateral() {
         $id = $this->input->post('loan_id');
            $res ="SELECT lt.*,lc.*,al.name AS 'assetName' FROM `loan_tbl` lt LEFT JOIN `loan_collateral` lc ON lt.`loan_id` = lc.`h_id`
                    LEFT JOIN `assetslist` al ON lc.`collateral_type`=al.`id_assetsList` WHERE lt.loan_id = $id";
//            echo $res;exit();
        return $this->db->query("$res")->result();
    }

}

// end of class

