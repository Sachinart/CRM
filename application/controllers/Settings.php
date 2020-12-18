<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	var $data = array();
	public function __construct(){
		parent::__construct();
		$this->check_session();
		$this->load->model(array('Setting_model'));
	}
	
	public function index()
	{
		$data['title'] = 'CRM | Settings';
		$this->load->view('settings',$data);
	}
	
	public function changePass(){
		$data['fields'] = $this->Setting_model->changePass();
		/* if($success){
			$rtnMsg = "Password Changed";
		}
		else{
			$rtnMsg = "Password cannot be changed, please contact administrator";
		} */
		$data['title'] = 'CRM | Settings';
		//$data['success'] = $data['fields']['success'];
		//$data['rtnMsg'] = $data['fields']['rtnMsg'];
		$data = setOutput($data['fields']['success'], $data['fields']['rtnMsg'],$data);
		$this->load->view('settings',$data);
	}
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}
	
}