<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->view('common/library'); // Call library view to include all required files
		//$this->check_session();
	}
	
	public function index()
	{
		$this->load->view('404');
	}
	
}