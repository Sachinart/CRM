<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	var $data = array();
	public function __construct(){
		parent::__construct();
		$this->load->view('common/library'); // Call library view to include all required files
		//$this->check_session();
	}
	
	public function index()
	{
		$data['title'] = 'Secure login';
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('ip_address');
		$this->session->sess_destroy();
		
		$this->load->view('login',$data);
	}
	
}