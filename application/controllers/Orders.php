<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	var $data = array();
	protected $tableName = 'orders'; // Table name of customer
	// Use this construct for every controller to include all CSS and JS files
	function __construct(){
        parent::__construct();
		$this->check_session();
        $this->load->model('Order_model');
	}
	
	public function index()
	{
		// Get data from table to delete
        $data['fields'] = array(
			'id',
            'quotId',
            'status',
            'creationDate'
        );

        $data['order'] = 'quotId asc';

        // Process get data from db
        $data['results'] = $this->Order_model->getOrders($data);
		
		// load all quotations
		$data['quotations'] = $this->db->get_where("quotations")->result();
		
		$this->load->view('orders/index',$data);
	}
	
	public function add($quotId){
		$p = getPriviledges();
		if($p->orderAdd != 1){
			redirect(base_url().'denial');
		}
		$inpQuotId 		= NULL;
        $inpStatus 		= NULL;
		
		extract($_POST);
		
		$params['inpQuotId'] 	= $inpQuotId;
        $params['inpStatus'] 	= $inpStatus;
		$data['quotId'] = $quotId;
		if(isset($save)){
			// if order is saved/add
            $data = $this->Order_model->add($params);
            $data = setOutput($data['success'], $data['rtnMsg'], $data);
			$data['quotId'] = $quotId;
			$this->load->view('orders/add',$data); 
        }
        else{
			// if order already exists, return failed msg else show form to save order
			$chkExistance = $this->db->get_where($this->tableName, array('quotId'=>$quotId));
			if($chkExistance->row()){
				$data['success'] = 0;
				$data['rtnMsg']  = "Order already exists with quotation id = ".$quotId;
				$data = setOutput($data['success'], $data['rtnMsg'], $data);
				$data['quotId'] = $quotId;
				$this->load->view('orders/add',$data);
			}
			else{
				$this->load->view('orders/add',$data);
			}
        }
	}
	
	public function edit($id){
		$p = getPriviledges();
		if($p->orderEdit != 1){
			redirect(base_url().'denial');
		}
        $data['fields'] = $this->Order_model->edit($id);
        $this->load->view('orders/update', $data);
    }
	
	public function update($id){
		$p = getPriviledges();
		if($p->orderEdit != 1){
			redirect(base_url().'denial');
		}
        $data = $this->Order_model->update();
		$data['fields'] = $this->db->get_where($this->tableName, array('id'=>$id))->row();
		$data = setOutput($data['success'],$data['rtnMsg'],$data);
		$this->load->view('orders/update', $data);
    }
	
	public function remove($id){
		$p = getPriviledges();
		if($p->orderDel != 1){
			redirect(base_url().'denial');
		}
        $data = $this->Order_model->remove($id);
		
		$condition = array(
            'isDeleted' => 0
        );
		
		$data['results'] = $this->db->get_where("orders",$condition)->result_array();
		$data['quotations'] = $this->db->get_where("quotations")->result();
		$data = setOutput($data['success'], $data['rtnMsg'],$data);
		$this->load->view('orders/index',$data);
    }
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}
}
