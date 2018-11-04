<?php
/*
 * Developer : Thiwanka Sandaruwan.
 * Date : 2016-02-18  
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed!!!!!');

class Mycompany_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function listCompany() {
        $sql = $this->db->query('SELECT *FROM company');
        return $sql->result();
    }

    public function insertData() {
      //#################################################
      //        set the Image Upload  
      //#################################################
     
        $config['upload_path'] = '../stockonline/assets/img/logo/';
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']    = '5000';
        $config['overwrite'] = TRUE;

        $new_name = 'olemi2';
        $config['file_name'] = $new_name;

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
           
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();
            $data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
            
        }   
       
       //################################################


      //#################################################
      //        set the Name Session  
      //#################################################                      
                           
                $company =$this->input->post('company_md_txt');
            
                $ses_user_data = array(             
                    'comName' => $company,                   
                      
                );  
                $this->session->set_userdata('session_user_data',$ses_user_data);

      //##################################################


        $id = 0;
        $this->db->trans_start();
        $data = array(
            'comName' => $this->input->post('company_md_txt'),
            'legalName' => $this->input->post('legal_md_txt'),
            'address' => $this->input->post('address_md_txt'),
            'phone' => $this->input->post('phone_md_txt'),
            'fax' => $this->input->post('fax_md_txt'),
            'email' => $this->input->post('email_md_txt'),
            'web' => $this->input->post('web_md_txt'),
            'month' => $this->input->post('financial_md_txt'),
            'country' => $this->input->post('country_md_txt'),
            'currency' => $this->input->post('currency_md_txt'),
            'logo' => $this->input->post('logo'),
            'tinNo' => $this->input->post('tin_no'),
            'vatNo' => $this->input->post('vat_no'),
            'svatNo' => $this->input->post('svat_no'),
            'brNo' => $this->input->post('br_no'),
            
        );


        $this->db->insert('company',$data);
        $id = $this->db->insert_id();       
     
        return $this->db->trans_complete();
    }

    public function GetselectUpdate($id) {
      
        return $this->db->query("SELECT * From company where id ='$id'")->result();

    }

  
    public function updateData($cusID) {
      //##################################################
      //            set the image upload  
      //##################################################
        $config['upload_path'] = '../assets/img/logo/';
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']    = '5000';
        $config['overwrite'] = TRUE;

        $new_name = 'olemi2';
        $config['file_name'] = $new_name;

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
           
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();
            $data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
            
        }  
    //###################################################


     


        $this->db->trans_start();
        //echo $cusID; exit('cus id ok');
        $data = array(
            'comName' => $this->input->post('company_md_txt'),
            'legalName' => $this->input->post('legal_md_txt'),
            'address' => $this->input->post('address_md_txt'),
            'phone' => $this->input->post('phone_md_txt'),
            'fax' => $this->input->post('fax_md_txt'),
            'email' => $this->input->post('email_md_txt'),
            'web' => $this->input->post('web_md_txt'),
            'month' => $this->input->post('financial_md_txt'),
            'country' => $this->input->post('country_md_txt'),
            'currency' => $this->input->post('currency_md_txt'),
            'logo' => $this->input->post('logo'),
            'tinNo' => $this->input->post('tin_no'),
            'vatNo' => $this->input->post('vat_no'),
            'svatNo' => $this->input->post('svat_no'),
            'brNo' => $this->input->post('br_no'),
        );
        $where['id'] = $cusID;
        $this->db->update('company', $data, $where);

      //#################################################
      //        set the Name Session  
      //#################################################                      
                           
                $company =$this->input->post('company_md_txt');
            
                $ses_user_data = array(             
                    'comName' => $company,                   
                      
                );  
                $this->session->set_userdata('session_user_data',$ses_user_data);

      //##################################################

        return $this->db->trans_complete();
    }

 
    public function isCustomerExist() {
        $customer = $this->input->post('customer');
        $res = $this->db->query("SELECT `cusName` FROM vender1 WHERE `cusName`='$customer' ORDER BY `cusName`");
        $count = $res->num_rows();
//          echo '<pre>';echo $count;exit('sdgsdgsdgsdgd'); 
        if ($count > 0) {
            echo 'exist';
        } else {
            echo 'Notexist';
        }
    }

    public function saveTermsPopup() {
        $terms = $this->input->post('terms');
        $exist = $this->db->query("SELECT `terms` FROM `termslist` WHERE `terms`='$terms'");
        $count = $exist->num_rows();
        if ($count > 0) {
            echo 'exist';
        } else {
            $data = array(
                'terms' => $this->input->post('terms'),
//            'type' => $this->input->post('terms'),
                'S_NetDue' => $this->input->post('txtNetDu'),
                'S_Discount' => $this->input->post('txtDisc_prsnt'),
                'S_Paid_Days' => $this->input->post('txtDisc_paid'),
            );
            $Result = $this->db->insert('termslist', $data);
            if ($Result == TRUE) {
                echo 'TRUE';
            } else {
                echo 'FALSE';
            }
        }
    }

    public function saveRepPopup() {
        $data = array(
            'cusName' => $this->input->post('rep_name'),
            'cusInitial' => $this->input->post('initials'),
            'cusType' => $this->input->post('repType'),
        );
        $Result = $this->db->insert('cusref', $data);
        if ($Result == TRUE) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }

    public function saveAddCurrencyPopup() {
        $data = array(
            'curanName' => $this->input->post('curr_name'),
            'curanSymble' => $this->input->post('curr_symbols'),
            'rate' => $this->input->post('curr_rate'),
            'discription' => $this->input->post('curr_description'),
        );
        $Result = $this->db->insert('curancyedit', $data);
        if ($Result == TRUE) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }

    public function loadCurrency() {
        return $this->db->query("SELECT curanSymble,homecurancy FROM curancyedit ")->result();
    }

    public function loadTerms() {
        return $this->db->query("SELECT * FROM termslist ")->result();
    }

    public function loadRef() {
        return $this->db->query("SELECT `cusInitial` FROM cusref ORDER BY `cusInitial`")->result();
    }



}
