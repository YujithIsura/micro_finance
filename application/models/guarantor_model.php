<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Guarantor_model extends CI_Model {
    
    


    public function addForm() {
       
         $img = "http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png";

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
       
        $data = array(
            'created_date' => date('Y-m-d'),
            'title' => $this->input->post('title'),
            'guarantor_name' => $this->input->post('guarantor_name'),
            'nic' => $this->input->post('nic'),
            'area_id' => $this->input->post('area_id'),
            'dob' => $this->input->post('dob'),
            'contact_no1' => $this->input->post('contact_no1'),
            'contact_no2' => $this->input->post('contact_no2'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'job' => $this->input->post('job'),
            'address' => $this->input->post('address'),
            'guarantor_photo' => $img
        );

//        echo '<pre>';
//        print_r($data);
//            exit();
        return $this->db->insert('guarantor', $data);
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
            'created_date' => date('Y-m-d'),
            'title' => $this->input->post('title'),
            'guarantor_name' => $this->input->post('guarantor_name'),
            'nic' => $this->input->post('nic'),
            'area_id' => $this->input->post('area_id'),
            'dob' => $this->input->post('dob'),
            'contact_no1' => $this->input->post('contact_no1'),
            'contact_no2' => $this->input->post('contact_no2'),
            'email' => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'job' => $this->input->post('job'),
            'address' => $this->input->post('address'),
            'guarantor_photo' => $img
        );
        $where['guarantor_id']= $this->input->post('guarantor_id');
//        echo '<pre>';
//        print_r($data);
//        print_r($where);
//            exit();
        return $this->db->update('guarantor', $data, $where);
    }
    public function removeForm() {
       
        $where['guarantor_id']= $this->input->post('guarantor_id');
        return $this->db->delete('guarantor', $where);
    }

    public function loadList() {
        return $res = $this->db->query("SELECT g.*,a.`name` AS area_name FROM `guarantor` g LEFT JOIN `arealist` a ON g.`area_id`=a.`id_areaList`")->result();
                       
    }

//  ---------------------------------- 2018-05-27 ---------------------------------
    // get Loan product for update
    public function getGuarantor($id){
        return $this->db->query("select * from `guarantor` where `guarantor_id`=$id")->result();
    }

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
    
     public function loadArea() {
        return $res = $this->db->select('*')
                        ->from('arealist')
                        ->where('status = 1')
                        ->get()->result();
    }

}

// end of class

