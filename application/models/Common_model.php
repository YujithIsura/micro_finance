<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Common_model extends CI_Model {

    public function validate_user($username){
        
        $user_data	=	$this->db->query("SELECT * FROM useracc WHERE userName=".$this->db->escape($username))->result();
        if($user_data){
        $last_act	=	$user_data[0]->last_activity;
        }else{
            return false;
        }
        $date1 = $last_act;

        $date2 = date("Y-m-d H:i:s");

        $diff = abs(strtotime($date2) - strtotime($date1));

        //$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

        $to_time = strtotime($date2);
        $from_time = strtotime($date1);

        $minuts = round(abs($to_time - $from_time) / 60,2);

        if($user_data[0]->logged==1 && $minuts<20){
            return false;
        }else{
            return true;
        }
    }

    public function check_user($user_name, $password) {
        try {
            $res	=	$this->validate_user($user_name);


            $this->db->select('id,userName,status');
            $this->db->from('useracc');

            $this->db->where('userName', $user_name);
            $this->db->where('password', md5($password));
            $query = $this->db->get();
            
            if ($query->num_rows() == 1) {
                $result = $query->result();

//                $homeCurrency = $this->db->query("SELECT curanSymble,rate FROM curancyedit WHERE homecurancy='yes' ")->result();
//                $user=$result[0]->userName;
//                $noOfSites = $this->db->query("SELECT count(siteName) as site_count FROM useracc_site where userName = '$user'")->result();

                $ses_user_data = array(
                    'userName' => $result[0]->userName,
                    'user_type' => $result[0]->status,
                    'id' => $result[0]->id,
                );
                if($res OR $user_name=='super admin'){
                    $this->session->set_userdata('session_user_data', $ses_user_data);
                }


                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $exc) {
            $this->session->set_flashdata('message', 'error');
            redirect('security');
        }
    }
   
    public function login_log($username){
        $username	=	htmlentities($username);
        $time		=	htmlentities(date("Y-m-d H:i:s"));
        $ip			=	htmlentities($_SERVER['REMOTE_ADDR']);
        $browser	=	htmlentities($_SERVER['HTTP_USER_AGENT']);

        $data		=	array("user"=>$username,
            "time"=>$time,
            "ip"=>$ip,
            "user_agent"=>$browser);

        $this->db->insert("login_log",$data);
    }
}
