<?php

class Security_model extends CI_Model{
	
	
	public function set_login_time($user_name){
		
		$ip		=	$_SERVER['REMOTE_ADDR'];
		
		$data	=	array("last_ip"=>$ip,
						  "last_activity"=>date("Y-m-d H:i:s"),
						  "logged"=>1,
						  "login_time"=>date("Y-m-d H:i:s")
						  );
						  
		$where['userName']	=	$user_name;
		
		$this->db->update("useracc",$data,$where);
		
	}
	public function remove_login_time($user_name){
		
		$ip		=	$_SERVER['REMOTE_ADDR'];
		
		$data	=	array("logged"=>0);
						  
		$where['userName']	=	$user_name;
		
		$this->db->update("useracc",$data,$where);
		
	}
	
	public function set_last_access($user_name){
		
		$data	=	array("last_activity"=>date("Y-m-d H:i:s"));
						  
		$where['userName']	=	$user_name;
		
		$this->db->update("useracc",$data,$where);
		
	}
	
	
}