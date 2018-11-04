<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Collateral_model extends CI_Model {
    
    


    public function addForm() {
       
         $img = "https://imgplaceholder.com/420x320/ff7f7f/333333/fa-image";

        
        $config['upload_path'] = 'uploads/collateral_photos/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $config['max_size'] = 100000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $file_name = sha1(uniqid() . rand());
        $config['file_name'] = $file_name;
//       echo '<pre>'; print_r($config);
        $this->load->library('upload', $config);
         $this->upload->initialize($config);
        if (!$this->upload->do_upload('filename')) {
            $data['imageError'] =  $this->upload->display_errors();
            print_r($data['imageError']);
        } else {
            $img = base_url() . "uploads/collateral_photos/" . $file_name;

            $upload_data = $this->upload->data();
            $img = base_url() . "uploads/collateral_photos/" . $upload_data['file_name'];
        }
       for($i=0;$i<5;$i++){
        $current_status_date = $this->input->post('current_status_date'.$i);
        if($current_status_date!=''){
            break;
        }
       }
       $current_status = $this->input->post('group103');
        $data = array(
            'h_id' => $this->input->post('loan_id'),
            'collateral_type' => $this->input->post('collateral_type'),
            'product_name' => $this->input->post('product_name'),
            'register_date' => $this->input->post('register_date'),
            'value' => $this->input->post('value'),
            'serial_no' => $this->input->post('serial_no'),
            'model_name' => $this->input->post('model_name'),
            'colour' => $this->input->post('colour'),
            'condition' => $this->input->post('condition'),
            'manufact_date' => $this->input->post('manufact_date'),
            'description' => $this->input->post('description'),
            'current_status' => $current_status,
            'current_status_date' => $current_status_date,
            'vehicle_registration_no' => $this->input->post('vehicle_registration_no'),
            'mileage' => $this->input->post('mileage'),
            'engin_no' => $this->input->post('engin_no'),
            'collateral_photo' => $img
        );

//        echo '<pre>';
//        print_r($data);
//            exit();
        return $this->db->insert('loan_collateral', $data);
    }
    
    public function updateForm() {
        $oldimg = $this->input->post('oldimg');

        if($this->input->post('attach')!='0'){
        $config['upload_path'] = 'uploads/collateral_photos/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $config['max_size'] = 100000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $file_name = sha1(uniqid() . rand());
        $config['file_name'] = $file_name;
//       echo '<pre>'; print_r($config);
        $this->load->library('upload', $config);
         $this->upload->initialize($config);
        if (!$this->upload->do_upload('filename')) {
            $data['imageError'] =  $this->upload->display_errors();
            print_r($data['imageError']);
        } else {
            $img = base_url() . "uploads/collateral_photos/" . $file_name;

            $upload_data = $this->upload->data();
            $img = base_url() . "uploads/collateral_photos/" . $upload_data['file_name'];
        }
        }else{
            $img = $oldimg;
        }
       for($i=0;$i<5;$i++){
        $current_status_date = $this->input->post('current_status_date'.$i);
        if($current_status_date!=''){
            break;
        }
       }
       
       $current_status = $this->input->post('group103');
         $data = array(
            'h_id' => $this->input->post('loan_id'),
            'collateral_type' => $this->input->post('collateral_type'),
            'product_name' => $this->input->post('product_name'),
            'register_date' => $this->input->post('register_date'),
            'value' => $this->input->post('value'),
            'serial_no' => $this->input->post('serial_no'),
            'model_name' => $this->input->post('model_name'),
            'colour' => $this->input->post('colour'),
            'condition' => $this->input->post('condition'),
            'manufact_date' => $this->input->post('manufact_date'),
            'description' => $this->input->post('description'),
            'current_status' => $current_status,
            'current_status_date' => $current_status_date,
            'vehicle_registration_no' => $this->input->post('vehicle_registration_no'),
            'mileage' => $this->input->post('mileage'),
            'engin_no' => $this->input->post('engin_no'),
            'collateral_photo' => $img
        );

        $where['id']= $this->input->post('loan_collateral_id');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('loan_collateral', $data, $where);
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

    public function get_list() {

        return $res = $this->db->select('*')
                        ->from('maintanance_service')
//            ->where('status = 1')
                        ->get()->result();
    }

    public function loadCollateralType() {

        return $res = $this->db->select('*')
                        ->from('assetslist')
//            ->where('status = 1')
                        ->get()->result();
    }
    
    
     public function loadCollateralList() {
         
            $res ="SELECT lt.*,lc.*,al.name AS 'assetName' FROM `loan_tbl` lt INNER JOIN `loan_collateral` lc ON lt.`loan_id` = lc.`h_id`
                    INNER JOIN `assetslist` al ON lc.`collateral_type`=al.`id_assetsList` ";
//            echo $res;exit();
        return $this->db->query("$res")->result();
    }
    
     public function loadCollateralDataById($id) {
         
            $res ="SELECT lt.*,lc.*,al.name AS 'assetName' FROM `loan_tbl` lt LEFT JOIN `loan_collateral` lc ON lt.`loan_id` = lc.`h_id`
                    LEFT JOIN `assetslist` al ON lc.`collateral_type`=al.`id_assetsList` WHERE lc.id=$id ";
//            echo $res;exit();
        return $this->db->query("$res")->result();
    }

  


}

// end of class

