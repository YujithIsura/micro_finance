<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Borrower_model extends CI_Model {


    public function addForm() {
        
         $img = "http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png";

        $config['upload_path'] = 'uploads/borrower_photos/';
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
            $img = base_url() . "uploads/borrower_photos/" . $file_name;

            $upload_data = $this->upload->data();
            $img = base_url() . "uploads/borrower_photos/" . $upload_data['file_name'];
        }
       
        $data = array(
            'title' => $this->input->post('title'),
            'name' => $this->input->post('name'),
            'nic' => $this->input->post('nic'),
            'id_areaList' => $this->input->post('id_areaList'),
            'id_marketing_officer' => $this->input->post('id_marketing_officer'),
//            'relative_type' => $this->input->post('relative_type'),
            'contact_no' => $this->input->post('contact_no'),
            'contact_no_2' => $this->input->post('contact_no_2'),
            'gender' => $this->input->post('gender'),
            'job' => $this->input->post('job'),
            'joined_date' => $this->input->post('joined_date'),
            'distance' => $this->input->post('distance'),
            'address' => $this->input->post('address'),
            'communication_address' => $this->input->post('communication_address'),
            'status' => $this->input->post('status'),
            'borrower_photo' => $img
        );

//        echo '<pre>'; print_r($data);exit();
        return $this->db->insert('borrower', $data);
    }
    
    public function updateForm() {
        
         $oldimg = $this->input->post('oldimg');
         if($this->input->post('attach')!='0'){
        $config['upload_path'] = 'uploads/';
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
            $img = base_url() . "uploads/" . $file_name;

            $upload_data = $this->upload->data();
            $img = base_url() . "uploads/" . $upload_data['file_name'];
        }
         }else{
            $img = $oldimg;
         }
        $data = array(
            'title' => $this->input->post('title'),
            'name' => $this->input->post('name'),
            'nic' => $this->input->post('nic'),
            'id_areaList' => $this->input->post('id_areaList'),
            'id_marketing_officer' => $this->input->post('id_marketing_officer'),
//            'relative_type' => $this->input->post('relative_type'),
            'contact_no' => $this->input->post('contact_no'),
            'contact_no_2' => $this->input->post('contact_no_2'),
            'joined_date' => $this->input->post('joined_date'),
            'gender' => $this->input->post('gender'),
            'job' => $this->input->post('job'),
            'distance' => $this->input->post('distance'),
            'address' => $this->input->post('address'),
            'communication_address' => $this->input->post('communication_address'),
            'status' => $this->input->post('status'),
             'borrower_photo' => $img
        );

        $where['id_borrower']= $this->input->post('id_borrower');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('borrower', $data, $where);
    }
    public function removeForm() {
        $data = array(
            'status' => 0,
        );
        $where['id_borrower']= $this->input->post('id_borrower');
        return $this->db->update('borrower', $data, $where);
    }

    public function blackListCustomer() {
        $data = array(
            'status' => 0,
            'is_in_blacklist' => 1,
        );
        $where['id_customer']= $this->input->post('id_customer');
        return $this->db->update('customer', $data, $where);
    }

    public function loadList() {
        return $res = $this->db->select('*')
                        ->from('borrower')
//                        ->where('status = 1')
                        ->where('is_in_blacklist = 0')
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

//  ----------------------------------  olemi---------------------------------

    }

// end of class

