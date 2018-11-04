<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setup_user_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserList() {
        $sql = $this->db->query("SELECT * FROM useracc");
        return $sql->result();
    }

    public function get_user_for_update($id) {
        $id = $this->db->escape($id);
        return $this->db->query("SELECT * FROM useracc WHERE id =$id")->result();
    }

    public function viewUser_getselectedSites($id) {
        $id = $this->db->escape($id);
        return $this->db->query("SELECT * FROM useracc_site WHERE id =$id")->result();
    }

    public function loadSites() {

        return $this->db->query("SELECT `siteName`  FROM `site` WHERE `siteName`!=''")->result();
    }

    public function insert() {
            $error = "";
            $username = $this->input->post('uname');
            $npass = $this->input->post('npassword');
            $cpass = $this->input->post('cpassword');
            $status = $this->input->post('usertype');

            if ($username == "" OR $npass == "" OR $cpass == "" OR $status == "") {
                $error = "1";
                $this->session->set_flashdata("error_msg", "Please Fill All Fields");
            }
            if ($npass != $cpass) {
                $error = "1";
                $this->session->set_flashdata("error_msg", "Password not match");
            }
            $username2 = $this->db->escape($username);
            $result = $this->db->query("SELECT * FROM useracc WHERE userName=$username2")->num_rows();

            if ($result > 0) {
                $error = "1";
                $this->session->set_flashdata("error_msg", "Username already excists!");
            }
            if ($error != "1") {
                if (strtolower($status) == "admin") {
                    $this->saveInUserPermissionTbl($username);
                    $this->adminPermission($username);
                } else {
                    $this->saveInUserPermissionTbl($username);
                }


                $dataArray = array(
                    'userName' => $this->input->post('uname'),
                    'password' => md5($this->input->post('npassword')),
                    'status' => $this->input->post('usertype'),
                );


                $this->db->insert('useracc', $dataArray);
                
                $this->session->set_flashdata("success_msg", "Successfully Created The User");
            }
       
    }

    public function checkPassword() {

        $password = $this->input->post('password');
        $cpassword = $this->input->post('cpassword');
        if ($password = $cpassword) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
     public function savePwPopup() {
        $userName = $this->input->post('username');
        $password = $this->input->post('password1');
        $cpassword = $this->input->post('cpassword1');
        $prePassword = $this->input->post('prepassword1');
        $prePassword1 = md5($prePassword);
        $que = "SELECT `password`,`id` FROM `useracc` WHERE `userName`='$userName' AND `password`='$prePassword1'";
        $exist = $this->db->query("$que")->result();
        
        $count = count($exist);
//        echo $password.$cpassword;exit();
        if ($count < 1) {
            echo 'notexist';
        }elseif ($password != $cpassword) {
            echo 'notmach';
        }
        else {
            if($password = $cpassword){
                $id = $exist[0]->id;
            $data = array(
                'password' => md5($this->input->post('cpassword1')),
            );
            
            $this->db->where("id", $id);
           $Result = $this->db->update('useracc', $data);
            }

            if (!empty($Result)) {
                echo 'TRUE';
            } else {
                echo 'FALSE';
            }
        }
    }


    public function UpdateUser($id) {
        if ($this->input->post('usertype1') != "") {


            $dataArray = array(
                'password' => md5($this->input->post('cpassword1')),
                'status' => $this->input->post('usertype1'),
            );

            $this->db->where("id", $id);
            $this->db->update('useracc', $dataArray);
           return true;
        }
    }

    public function remove($id) {
        try {
            $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('useracc');
        } catch (Exception $exc) {
//            echo $exc->getMessage();
//            echo '<br>';
//            echo $exc->getCode();
            if ($exc->getCode() == 500) {
                $this->session->set_flashdata("error_msg", "Unable to remove. Please First delete Transactions");
                redirect(base_url('Setup_user_control/update_view/' . $id));
//                echo 'cnt delete this';
            } else {
                echo $exc->getMessage();
//                echo '<br>';
//                exit();
                return FALSE;
            }
//            exit('s');
        }
    }

    public function permission($id) {
        $id = $this->db->escape($id);
        return $this->db->query("SELECT * FROM useracc WHERE id =$id")->result();
    }

    function getPermissionSave($id) {
        $uname = $id;
        $uname2 = $this->db->escape($uname);
        $result = $this->db->query("SELECT * FROM user_permission_save WHERE userName=$uname2");
        return $result->result();
    }

    function getPermissionEdit($id) {
        $uname = $id;
        $uname2 = $this->db->escape($uname);
        $result = $this->db->query("SELECT * FROM user_permission_edit WHERE userName=$uname2");
        return $result->result();
    }

    function getPermissionView($id) {
        $uname = $id;
        $uname2 = $this->db->escape($uname);
        $result = $this->db->query("SELECT * FROM user_permission_view WHERE userName=$uname2");
        return $result->result();
    }

    function getPermissionDelete($id) {
        $uname = $id;
        $uname2 = $this->db->escape($uname);
        $result = $this->db->query("SELECT * FROM user_permission_delete WHERE userName=$uname2");
        return $result->result();
    }


    public function adminPermission($userid) {
        $data1 = array(
            "dashboard" => 1,
            "appLoanApplication" => 1,
            "myCompany" => 1,
            "borrowerlist" => 1,
            "loanofficerlist" => 1,
            "arealist" => 1,
            "collateraltypelist" => 1,
            "loanproductlist" => 1,
            "guaranterlist" => 1,
            "loancollaterallist" => 1,
        );
        $data2 = array(
            "dashboard" => 1,
            "appLoanApplication" => 1,
            "myCompany" => 1,
            "borrowerlist" => 1,
            "loanofficerlist" => 1,
            "arealist" => 1,
            "collateraltypelist" => 1,
            "loanproductlist" => 1,
            "guaranterlist" => 1,
            "loancollaterallist" => 1,
        );
        $data3 = array(
            "dashboard" => 1,
            "appLoanApplication" => 1,
            "myCompany" => 1,
            "borrowerlist" => 1,
            "loanofficerlist" => 1,
            "arealist" => 1,
            "collateraltypelist" => 1,
            "loanproductlist" => 1,
            "guaranterlist" => 1,
            "loancollaterallist" => 1,
        );
        $data4 = array(
            "dashboard" => 1,
            "appLoanApplication" => 1,
            "myCompany" => 1,
            "borrowerlist" => 1,
            "loanofficerlist" => 1,
            "arealist" => 1,
            "collateraltypelist" => 1,
            "loanproductlist" => 1,
            "guaranterlist" => 1,
            "loancollaterallist" => 1,
        );

        $userid = $userid;

        $this->db->where("userName", $userid);
        $this->db->update("user_permission_save", $data1);

        $this->db->where("userName", $userid);
        $this->db->update("user_permission_edit", $data2);

        $this->db->where("userName", $userid);
        $this->db->update("user_permission_view", $data3);

        $this->db->where("userName", $userid);
        $this->db->update("user_permission_delete", $data4);
    }

    public function ConfirmPermission() {
        
        $userid = $this->input->post("userid");
        $borrowerlistSave = $this->input->post("Add0");
        $borrowerlistEdit = $this->input->post("Edit0");
        $borrowerlistView = $this->input->post("View0");
        $borrowerlistDelete = $this->input->post("Delete0");

        $loanofficerlistSave = $this->input->post("Add1");
        $loanofficerlistEdit = $this->input->post("Edit1");
        $loanofficerlistView = $this->input->post("View1");
        $loanofficerlistDelete = $this->input->post("Delete1");

        $guaranterlistSave = $this->input->post("Add2");
        $guaranterlistEdit = $this->input->post("Edit2");
        $guaranterlistView = $this->input->post("View2");
        $guaranterlistDelete = $this->input->post("Delete2");

        $collateraltypelistSave = $this->input->post("Add3");
        $collateraltypelistEdit = $this->input->post("Edit3");
        $collateraltypelistView = $this->input->post("View3");
        $collateraltypelistDelete = $this->input->post("Delete3");

        $loanproductlistSave = $this->input->post("Add4");
        $loanproductlistEdit = $this->input->post("Edit4");
        $loanproductlistView = $this->input->post("View4");
        $loanproductlistDelete = $this->input->post("Delete4");

        $arealistSave = $this->input->post("Add5");
        $arealistEdit = $this->input->post("Edit5");
        $arealistView = $this->input->post("View5");
        $arealistDelete = $this->input->post("Delete5");

        $loancollaterallistSave = $this->input->post("Add6");
        $loancollaterallistEdit = $this->input->post("Edit6");
        $loancollaterallistView = $this->input->post("View6");
        $loancollaterallistDelete = $this->input->post("Delete6");

        $this->saveInUserPermissionTbl2();

        $data1 = array(
            "borrowerlist" => $borrowerlistSave,
            "loanofficerlist" => $loanofficerlistSave,
            "guaranterlist" => $guaranterlistSave,
            "collateraltypelist" => $collateraltypelistSave,
            "arealist" => $arealistSave,
            "loanproductlist" => $loanproductlistSave,
            "loancollaterallist" => $loancollaterallistSave,
        );

        $data2 = array(
            "borrowerlist" => $borrowerlistEdit,
            "loanofficerlist" => $loanofficerlistEdit,
            "guaranterlist" => $guaranterlistEdit,
            "collateraltypelist" => $collateraltypelistEdit,
            "arealist" => $arealistEdit,
            "loanproductlist" => $loanproductlistEdit,
            "loancollaterallist" => $loancollaterallistEdit,
        );

        $data3 = array(
             "borrowerlist" => $borrowerlistView,
            "loanofficerlist" => $loanofficerlistView,
            "guaranterlist" => $guaranterlistView,
            "collateraltypelist" => $collateraltypelistView,
            "arealist" => $arealistView,
            "loanproductlist" => $loanproductlistView,
            "loancollaterallist" => $loancollaterallistView,
        );

        $data4 = array(
            "borrowerlist" => $borrowerlistDelete,
            "loanofficerlist" => $loanofficerlistDelete,
            "guaranterlist" => $guaranterlistDelete,
            "collateraltypelist" => $collateraltypelistDelete,
            "arealist" => $arealistDelete,
            "loanproductlist" => $loanproductlistDelete,
            "loancollaterallist" => $loancollaterallistDelete,
        );
        
        $this->db->where("userName", $userid);
        $this->db->update("user_permission_save", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $this->db->where("userName", $userid);
        $this->db->update("user_permission_edit", $data2);
        //echo $this->db->last_query()."<br/><br/>";
        $this->db->where("userName", $userid);
        $this->db->update("user_permission_view", $data3);
        //echo $this->db->last_query()."<br/><br/>";
        $this->db->where("userName", $userid);
        $this->db->update("user_permission_delete", $data4);
        //echo $this->db->last_query()."<br/><br/>";
//        $this->confirmPer2();
    }

    public function confirmPer2() {
        $data1 = array();
        $data1 = NULL;
        $userid = $this->input->post("userid");

        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsAdd" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_save_1", $data1);
        ////echo $this->db->last_query()."<br/><br/>";

        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsEdit" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_edit_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsDelete" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_delete_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsView" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_view_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtablePrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsPrint" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_print_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsExport" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_export_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        $data1 = array();
        $data1 = NULL;
        for ($i = 0; $i < 7; $i++) {
            $item = $this->input->post("tvtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("tcustableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("tbtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 8; $i++) {
            $item = $this->input->post("tcomtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("ractableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rvtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $item = $this->input->post("rcustableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $item = $this->input->post("rsaltableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 9; $i++) {
            $item = $this->input->post("rptableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rintableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }


        for ($i = 0; $i < 4; $i++) {
            $item = $this->input->post("rbtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $item = $this->input->post("rtxtableEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

        for ($i = 0; $i < 12; $i++) {
            $item = $this->input->post("otherreportsEmail" . $i);
            if (strpos($item, "#") > -1) {
                $items = explode("#", $item);
                if (isset($items[0])) {
                    $data1[$items[0]] = $items[1];
                }
            }
        }

//        print_r($data1);

        $this->db->where("uname", $userid);
        $this->db->update("useraccount_email_1", $data1);
        //echo $this->db->last_query()."<br/><br/>";
        //
//        print_r($data1);
//        
    }

    public function saveInUserPermissionTbl($userid) {
        $userid2 = $this->db->escape($userid);
        $result = $this->db->query("SELECT * FROM user_permission_save WHERE userName=$userid2")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_save", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_edit WHERE userName=$userid2")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_edit", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_view WHERE userName=$userid2")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_view", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_delete WHERE userName=$userid2")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_delete", $data);
        }
    }

    public function saveInUserPermissionTbl2() {
        $userid = $this->input->post("userid");
        $result = $this->db->query("SELECT * FROM user_permission_save WHERE userName='$userid'")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_save", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_edit WHERE userName='$userid'")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_edit", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_view WHERE userName='$userid'")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_view", $data);
        }
        $result = $this->db->query("SELECT * FROM user_permission_delete WHERE userName='$userid'")->num_rows();

        if ($result < 1) {
            $data = array("userName" => $userid);
            $this->db->insert("user_permission_delete", $data);
        }
    }


}

?>