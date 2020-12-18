<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controls extends CI_Controller {
	
	var $data = array();
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('role')!=1){
			redirect(base_url().'error404');
		}
		$this->check_session();
		$this->load->model(array('control_model'));
	}
	
	public function index()
	{
		$data['title'] = 'CRM | Controls';
		$this->load->view('controls',$data);
	}
	
	public function addEmails(){
		$data = $this->control_model->addEmails();
		$data = setOutput($data['success'], $data['rtnMsg'], $data);
		$data['title'] = 'CRM | Controls';
		$this->load->view('controls',$data);
	}
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}
	
}