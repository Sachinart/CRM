<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_model{

    protected $tableName = 'member'; // Table name of customer
   
    function __construct(){
        parent::__construct();

        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }

	public function changePass(){
		$id = $this->input->post('id');
		$pass = $this->input->post('inpPassword');
		$confirmPass = $this->input->post('inpConfirmPassword');
		if($pass==$confirmPass){
			$pass = password_hash($pass, PASSWORD_BCRYPT);
			$fields = array(
				'password' 	=> $pass
			); 
			$this->db->where('id',$id);
			$this->db->update('members',$fields);
			if($this->db->affected_rows()>0){
				return array('success' => 1,'rtnMsg' => "Password Changed");
			}
			else{
				// if no change is done
				return array('success' => 0,'rtnMsg' => "Password cannot be changed, please contact administrator");
			}	
		}
		else{
			return array('success' => 0,'rtnMsg' => "Password does not match, please type the same password in both fields");
		}
	}
}