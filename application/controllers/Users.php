<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{
	
    protected $tableName = 'members'; // Table name of users
    public function __construct(){
        parent::__construct();
		$this->check_session();
		/* if($_SESSION['role']!=1){
			redirect(base_url().'error404');
		} */
        // One model customer is loaded in an array, we can add as many as we want through the array
        $this->load->model(array('user_model'));
    }

    public function index(){
        $id 		= NULL;
        $firstName 	= NULL;
        $lastName 	= NULL;
        $email 		= NULL;
        $username 	= NULL;
        $role 		= NULL;

        extract($_POST);

        // Get data from table
        $data['fields'] = array(
            'id',
            'firstName',
            'lastName',
            'email',
            'username',
			'role'
        );

        //setOutput(true, "");
		
		$data['title'] = 'Users';
		//$data['success'] = true;
		//$data['rtnMsg'] = "";
		$data = setOutput(true, "",$data);
        $data['order'] = 'firstName asc';

        // Process get data from db
        $data['results'] = $this->user_model->getUsers($data);

        //var_dump($data['results']); die;

        $this->load->view('users/index',$data);
    }
	
	public function add(){
		$p = getPriviledges();
		if($p->userAdd != 1){
			redirect(base_url().'denial');
		}
        $inpFirstName 	= NULL;
        $inpLastName 	= NULL;
        $inpEmail 		= NULL;
        $inpUserName 	= NULL;
        $inpRole 		= NULL;
        $inpPassword 	= NULL;
		
		// Priviledges
		$inpCustAdd		= NULL;
		$inpCustEdit	= NULL;
		$inpCustDel		= NULL;
		$inpQuotAdd		= NULL;
		$inpQuotEdit	= NULL;
		$inpQuotDel		= NULL;
		$inpQuotCmtAdd	= NULL;
		$inpQuotCmtEdit	= NULL;
		$inpQuotCmtDel	= NULL;
		$inpOrderAdd	= NULL;
		$inpOrderEdit	= NULL;
		$inpOrderDel	= NULL;
		$inpUserAdd		= NULL;
		$inpUserEdit	= NULL;
		$inpUserDel		= NULL;

        extract($_POST); // To fetch records from form in view('add_customer') using POST method
        
        $params['inpFirstName'] = $inpFirstName;
        $params['inpLastName']	= $inpLastName;
        $params['inpEmail'] 	= $inpEmail;
        $params['inpUserName']	= $inpUserName;
        $params['inpRole']		= $inpRole;
        $params['inpPassword']	= password_hash($inpPassword, PASSWORD_BCRYPT);
		
		// Priviledges
		if(isset($inpCustAdd))
			$params['inpCustAdd'] = "1";
		else
			$params['inpCustAdd'] = "0";
		if(isset($inpCustEdit))
			$params['inpCustEdit'] = "1";
		else
			$params['inpCustEdit'] = "0";
		if(isset($inpCustDel))
			$params['inpCustDel'] = "1";
		else
			$params['inpCustDel'] = "0";
		
		if(isset($inpQuotAdd))
			$params['inpQuotAdd'] = "1";
		else
			$params['inpQuotAdd'] = "0";
		if(isset($inpQuotEdit))
			$params['inpQuotEdit'] = "1";
		else
			$params['inpQuotEdit'] = "0";
		if(isset($inpQuotDel))
			$params['inpQuotDel'] = "1";
		else
			$params['inpQuotDel'] = "0";
		
		if(isset($inpQuotCmtAdd))
			$params['inpQuotCmtAdd'] = "1";
		else
			$params['inpQuotCmtAdd'] = "0";
		if(isset($inpQuotCmtEdit))
			$params['inpQuotCmtEdit'] = "1";
		else
			$params['inpQuotCmtEdit'] = "0";
		if(isset($inpQuotCmtDel))
			$params['inpQuotCmtDel'] = "1";
		else
			$params['inpQuotCmtDel'] = "0";
		
		if(isset($inpOrderAdd))
			$params['inpOrderAdd'] = "1";
		else
			$params['inpOrderAdd'] = "0";
		if(isset($inpOrderEdit))
			$params['inpOrderEdit'] = "1";
		else
			$params['inpOrderEdit'] = "0";
		if(isset($inpOrderDel))
			$params['inpOrderDel'] = "1";
		else
			$params['inpOrderDel'] = "0";
		
		if(isset($inpUserAdd))
			$params['inpUserAdd'] = "1";
		else
			$params['inpUserAdd'] = "0";
		if(isset($inpUserEdit))
			$params['inpUserEdit'] = "1";
		else
			$params['inpUserEdit'] = "0";
		if(isset($inpUserDel))
			$params['inpUserDel'] = "1";
		else
			$params['inpUserDel'] = "0";
		
		$data = array();
		$data = setOutput(true, "",$data);
		
        if(isset($save)){
			$data = $this->user_model->insert($params);
            $data = setOutput($data['success'], $data['rtnMsg'], $data);
			$this->load->view('users/add',$data);
        }
        else{	
            $this->load->view('users/add',$data);
        }		
	}

    public function edit($id){
        $p = getPriviledges();
		if($p->userEdit != 1){
			redirect(base_url().'denial');
		}
        $data['fields'] = $this->user_model->edit($id);
        $this->load->view('users/update', $data);
    }

    public function update($id){
		$p = getPriviledges();
		if($p->userEdit != 1){
			redirect(base_url().'denial');
		}
        $data = $this->user_model->update();
		$data = setOutput($data['success'],$data['rtnMsg'],$data);
		$data['fields'] = $this->db->get_where($this->tableName, array('id'=>$id))->row();
        $this->load->view('users/update', $data);
    }

    public function delete($id){
		$p = getPriviledges();
		if($p->userDel != 1){
			redirect(base_url().'denial');
		}
        
		$data = $this->user_model->delete($id);
		$data['results'] 	= $this->db->get_where("members")->result_array();
		$data['title'] 		= 'Users';
		$data = setOutput($data['success'], $data['rtnMsg'], $data);
		$this->load->view('users/index',$data);
    }
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}

}