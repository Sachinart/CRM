<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller{

	protected $tableName = 'customers'; // Table name of customer
    public function __construct(){
        parent::__construct();
		$this->check_session();
        // One model customer is loaded in an array, we can add as many as we want through the array
        $this->load->model(array('customer_model'));
    }

    public function index(){
        $id = NULL;
        $firstName = NULL;
        $lastName = NULL;
        $email = NULL;
        $mobNo = NULL;
        $stateId = NULL;
        $gst = NULL;
        $pan = NULL;
        $deliveryAddr = NULL;
        $update = NULL;
        $delete = NULL;

        extract($_POST);

        // Get data from table
        $data['fields'] = array(
            'id',
            'firstName',
            'lastName',
            'email',
            'mobNo',
            'stateId',
            'gst',
            'pan',
            'deliveryAddr'
        );

        $data = setOutput(true, "",$data);
		
        $data['order'] = 'firstName asc';
		//$userId = $this->session->userdata('id');
		//$data['userId'] = $userId;
        // Process get data from db
        $data['results'] 	 = $this->customer_model->getCustomers($data);
        //var_dump($data['results']); die;

        $this->load->view('customers/index',$data);
    }
	
	public function add(){
		$p = getPriviledges();
		if($p->custAdd != 1){
			redirect(base_url().'denial');
		}
        $inpFirstName = NULL;
        $inpLastName = NULL;
        $inpEmail = NULL;
        $inpMobNo = NULL;
        $inpStateId = NULL;
        $inpGST = NULL;
        $inpPAN = NULL;
        $inpDeliveryAddr = NULL;
        $save = NULL;

        extract($_POST); // To fetch records from form in view('add_customer') using POST method
        
        $params['inpFirstName'] = $inpFirstName;
        $params['inpLastName'] = $inpLastName;
        $params['inpEmail'] = $inpEmail;
        $params['inpMobNo'] = $inpMobNo;
        $params['inpStateId'] = $inpStateId;
        $params['inpGST'] = strtoupper($inpGST);
        $params['inpPAN'] = strtoupper($inpPAN);
        $params['inpDeliveryAddr'] = $inpDeliveryAddr;

		// load all states and send to the add Customer form
		$this->db->select('*');
		$this->db->from('states');
		$data['states'] = $this->db->get()->result();	
		
		$data = setOutput(true, "",$data);
		//$data['success'] = true;
		//$data['rtnMsg'] = "";
		
        if(isset($save)){
            
            // Add, update and delete logic here
            $success = $this->customer_model->insert($params);
            if($success){
				$rtnMsg = "Customer added";
			}
			else{
				$rtnMsg = "Failed to add customer, please contact administrator";
			}
			
			$data = setOutput($success, $rtnMsg, $data);
			//$data['success'] = $success;
			//$data['rtnMsg'] = $rtnMsg;
			
            $this->load->view('customers/add',$data);
        }
        else{	
            $this->load->view('customers/add',$data);
        }		
	}

    public function edit($id){
		$p = getPriviledges();
		if($p->custEdit != 1){
			redirect(base_url().'denial');
		}
        //echo $id;
		// load all states and send to the add Customer form
		$this->db->select('*');
		$this->db->from('states');
		$data['states'] = $this->db->get()->result();
		
        $data['fields'] = $this->customer_model->edit($id);
        $this->load->view('customers/update', $data);
    }

    public function update($id){
		$p = getPriviledges();
		if($p->custEdit != 1){
			redirect(base_url().'denial');
		}
        $success = $this->customer_model->update();
		// load all states and send to the add Customer form
		$this->db->select('*');
		$this->db->from('states');
		$data['states'] = $this->db->get()->result();
		if($success){
			$query = $this->db->get_where($this->tableName, array('id'=>$id));
            $data['fields'] = $query->row();
			$rtnMsg = "Updated successfully";
			$data = setOutput($success,$rtnMsg,$data);
			$this->load->view('customers/update', $data);
		}
		else{
			$query = $this->db->get_where($this->tableName, array('id'=>$id));
            $data['fields'] = $query->row();
			$rtnMsg = "Customer details cannot be updated";
			$data = setOutput($success,$rtnMsg,$data);
			$this->load->view('customers/update', $data);
		}
    }

    public function remove($id){
		$p = getPriviledges();
		if($p->custDel != 1){
			redirect(base_url().'denial');
		}
        $success = $this->customer_model->remove($id);
		//echo $success;
		if($success){
			$rtnMsg = "Customer is removed";
		}
		else{
			$rtnMsg = "Customer cannot be removed, please contact administrator";
		}
		
		// load all customers and send to the add Template form
		//$this->db->select('*');
		//$this->db->from('customers');
		$condition = array(
            'isDeleted' => 0
        );
		$data['results'] = $this->db->get_where("customers", $condition)->result_array();
		
		$data = setOutput($success, $rtnMsg, $data);
		//$data['success'] = $success;
		//$data['rtnMsg'] = $rtnMsg;
		$this->load->view('customers/index',$data);
		//redirect(base_url().'customers');
    }
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}

}