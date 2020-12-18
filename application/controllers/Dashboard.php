<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	// Use this construct for every controller to include all CSS and JS files
	function __construct(){
        parent::__construct();

        $this->check_session();
		$this->load->model(array('dashboard_model'));
	}
	
	public function index()
	{
		$data['rowsCount'] = $this->dashboard_model->index();
		$this->load->view('dashboard',$data);
	}
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}
}
