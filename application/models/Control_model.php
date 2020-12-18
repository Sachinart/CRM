<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Control_model extends CI_model{

    function __construct(){
        parent::__construct();
        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }

	public function addEmails(){
		$quotEmails 	= $this->input->post('inpQuotEmails');
		$emailValidFlag = 0;
		
		// Check if input emails are valid
		$quotEmailList 	= (explode(",",$quotEmails));
		foreach($quotEmailList as $email){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				return array('success' => 0 , 'rtnMsg' => 'Invalid email inputs');
			}
			$emailValidFlag = 1;
		}
		
		if($emailValidFlag){
			$moduleName = 'quotation';
			$fields = array(
				'moduleName' 	=> $moduleName,
				'emails' 		=> $this->input->post('inpQuotEmails'),
				'CreationDate'  => getUTC()
			); 
			
			$condition = array(
				'moduleName' 	=> $moduleName,
				'emails' 		=> $this->input->post('inpQuotEmails')
			);
			
			// Check whether fields with same emails already exists
			$query 	 = $this->db->get_where('alertEmails', $condition);
			$results = $query->result_array();
			if(!empty($results))
			{
				return array('success' => 0 , 'rtnMsg' => 'Emails already exists'); 
			}
			else{
				// Check whether same module exists or not
				$condition = array(
					'moduleName' 	=> $moduleName,
				);
				$module  = $this->db->get_where('alertEmails', $condition)->row();
				if($module && $module->moduleName == 'quotation'){ // if exist update it
					$this->db->query("UPDATE alertEmails set emails = concat(emails,',".$this->input->post('inpQuotEmails')."')");
					return array('success' => 1 , 'rtnMsg' => 'Emails successfully updated'); 
					//$this->db->update('alertEmails',$fields);
				}else{
					// If doesn't exist, insert it
					$this->db->insert('alertEmails', $fields );
					return array('success' => 1 , 'rtnMsg' => 'Emails successfully inserted'); 						
				}
			}
		}
		
	}
}