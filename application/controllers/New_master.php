<?php

class New_master extends MY_Controller{
	
	public function index(){
            
        $this->load->view('template/header');
        $this->load->view('template/navigation');
        $this->load->view('MasterTable/new_master');
        $this->load->view('template/footer');
		
	}
}