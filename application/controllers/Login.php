<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	var $data = array();
	public function __construct(){
		parent::__construct();
		$this->load->view('common/library'); // Call library view to include all required files
		$this->check_session();
	}
	
		public function index()
	{
		$data['title'] = 'Secure login';
		$this->load->view('login',$data);
	}
	
	function auth(){
		
		$data['title'] = 'Secure login';
		// echo password_hash('admin',PASSWORD_BCRYPT);
		$validation = array(
			array('field' => 'username', 'rules' => 'required'),
			array('field' => 'password', 'rules' => 'required')
		);
		
		$this->form_validation->set_rules($validation);
		if($this->form_validation->run() == true){
			$user_post = $this->input->post('username');
			$pass_post = $this->input->post('password');
			
			if($this->_resolve_user_login($user_post,$pass_post)){
				$id			= $this->_get_user_ID_from_username($user_post);
				$role		= $this->_get_user_role_from_username($user_post);
				$name		= $this->_get_user_name_from_username($user_post);
				$ip_address = $this->input->ip_address();
				//$priviledges= $this->_get_user_priviledges_from_username($user_post);
			
				$create_session = array(
					'id' 		 => $id,
					'role' 		 => $role,
					'name' 		 => $name,
					'ip_address' => $ip_address,
					//'priviledges' => $priviledges
				);
				$this->session->set_userdata($create_session);
				redirect('dashboard');
			}
			else{
				$data['validate'] = "Incorrect username or password";
				$this->load->view('login',$data);
			}
			
		}
		else{
			$data['validate'] = "Please type username or password";
			$this->load->view('login',$data);
		}
	}
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if($id){
			redirect('dashboard');
		}
	}
	
	private function _resolve_user_login($username,$password){
		$this->db->where('username',$username);
		$hash = $this->db->get('members')->row('password');
		return $this->_verify_password_hash($password,$hash);
	}
	
	private function _get_user_ID_from_username($username){
		$this->db->select('id');
		$this->db->from('members');
		$this->db->where('username',$username);
		return $this->db->get()->row('id');
	}
	
	private function _get_user_role_from_username($username){
		$this->db->select('role');
		$this->db->from('members');
		$this->db->where('username',$username);
		return $this->db->get()->row('role');
	}
	
	private function _get_user_name_from_username($username){
		$this->db->select('firstName');
		$this->db->from('members');
		$this->db->where('username',$username);
		return $this->db->get()->row('firstName');
	}
	
	/* private function _get_user_priviledges_from_username($username){
		$user = $this->db->get_where('members', array('username'=>$username))->row();
		$userId = $user->id;
		$priviledges = $this->db->get_where('priviledges', array('userId'=>$userId))->row();
		return $priviledges;
	} */
	
	private function _verify_password_hash($password,$hash){
		return password_verify($password,$hash);
	}
}
