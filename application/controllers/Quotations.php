<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotations extends CI_Controller {

	protected $tableName = 'quotations'; // Table name of quotations
	var $data = array();
	// Use this construct for every controller to include all CSS and JS files
	function __construct(){
        parent::__construct();
		$this->check_session();
        $this->load->model(array('quotation_model'));
	}
	
	public function index()
	{
		$id = NULL;
        $item = NULL;
        $itemDesc = NULL;
        $quantity = NULL;
        $customerId = NULL;
        $rate = NULL;
        $tnc = NULL;
        $deliveryTime = NULL;
        $cgst = NULL;
        $sgst = NULL;
        $igst = NULL;
        $orderValue = NULL;
        $status = NULL;

        extract($_POST);

        // Get data from table to delete
        $data['fields'] = array(
            'id',
            'item',
            'itemDesc',
            'quantity',
            'customerId',
            'rate',
            'tnc',
            'deliveryTime',
            'cgst',
            'sgst',
            'igst',
            'orderValue',
            'status'
        );

        $data = setOutput(true, "",$data);
        $data['order'] = 'item asc';
		// Process get data from db
        $data['results'] = $this->quotation_model->getQuotations($data);
		
		// load all customers and send to the add Quotation form
		$data['customers'] = $this->db->get_where("customers")->result();
		
		$this->load->view('quotations/index',$data);
	}
	
	public function add(){
		$p = getPriviledges();
		if($p->quotAdd != 1){
			redirect(base_url().'denial');
		}
		$inpItem 		= NULL;
        $inpItemDesc 	= NULL;
        $inpQuantity 	= NULL;
        $inpCustomerId 	= NULL;
        $inpRate 		= NULL;
        $inptnc 		= NULL;
        $inpDeliveryTime= NULL;
        $inpcgst 		= NULL;
        $inpsgst 		= NULL;
        $inpigst 		= NULL;
        $inpOrderValue 	= NULL;
        $inpStatus 		= NULL;

        extract($_POST); // To fetch records from form in view('add_customer') using POST method
        
        $params['inpItem'] 			= $inpItem;
        $params['inpItemDesc'] 		= $inpItemDesc;
        $params['inpQuantity'] 		= $inpQuantity;
        $params['inpCustomerId']	= $inpCustomerId;
        $params['inpRate'] 			= $inpRate;
        $params['inptnc'] 			= $inptnc;
        $params['inpDeliveryTime'] 	= $inpDeliveryTime;
        $params['inpcgst'] 			= $inpcgst;
        $params['inpsgst'] 			= $inpsgst;
        $params['inpigst'] 			= $inpigst;
        $params['inpOrderValue'] 	= $inpOrderValue;
        $params['inpStatus'] 		= $inpStatus;

		// load all customers and send to the add Quotation form
		$condition = array(
            'isDeleted' => 0
        );
		$data['customers'] = $this->db->get_where("customers", $condition)->result();
		
        if(isset($save)){
			// CustomerID contains name + id, so extract ID from it and save in params
			if(is_numeric($params['inpCustomerId'])){
				// Add, update and delete logic here
				$success = $this->quotation_model->insert($params);
				if($success){
				$rtnMsg = "Quotation added";
				}
				else{
					$rtnMsg = "Failed to add quotation, please contact administrator";
				}
				$data = setOutput($success, $rtnMsg,$data);
				$this->load->view('quotations/add',$data);
			}else{
				$success = 0;
				$rtnMsg = "Please select a customer first";
				$data = setOutput($success, $rtnMsg,$data);
				$this->load->view('quotations/add',$data);
			}
        }
        else{
            $this->load->view('quotations/add',$data);
        }
	}
	
	public function edit($id){
		$p = getPriviledges();
		if($p->quotEdit != 1){
			redirect(base_url().'denial');
		}
        $data['fields'] = $this->quotation_model->edit($id);
		$data['customer'] = $this->db->get_where('customers', array('id'=>$data['fields']->customerId))->row();
        $this->load->view('quotations/update', $data);
    }

    public function update($id){
		$p = getPriviledges();
		if($p->quotEdit != 1){
			redirect(base_url().'denial');
		}
		$success = $this->quotation_model->update();
		if($success){
			$query = $this->db->get_where($this->tableName, array('id'=>$id));
            $data['fields'] = $query->row();
			$data['customer'] = $this->db->get_where('customers', array('id'=>$data['fields']->customerId))->row();
			$rtnMsg = "Updated successfully";
			$data = setOutput($success,$rtnMsg,$data);
			$this->load->view('quotations/update', $data);
		}
		else{
			$query = $this->db->get_where($this->tableName, array('id'=>$id));
            $data['fields'] = $query->row();
			$data['customer'] = $this->db->get_where('customers', array('id'=>$data['fields']->customerId))->row();
			$rtnMsg = "Quotation details cannot be updated";
			$data = setOutput($success,$rtnMsg,$data);
			$this->load->view('quotations/update', $data);
		}
    }

    public function remove($id){
		$p = getPriviledges();
		if($p->quotDel != 1){
			redirect(base_url().'denial');
		}
        $success = $this->quotation_model->remove($id);
		if($success){
			$rtnMsg = "Quotation is removed";
		}
		else{
			$rtnMsg = "Quotation cannot be removed, please contact administrator";
		}
		
		$condition = array(
            'isDeleted' => 0
        );
		
		// load all quotations
		$data['results'] = $this->db->get_where("quotations",$condition)->result_array();
		
		// load all customers
		$this->db->select('*');
		$this->db->from('customers');
		$data['customers'] = $this->db->get()->result();
		
		$data = setOutput($success, $rtnMsg,$data);
        
		$this->load->view('quotations/index',$data);
        //redirect(base_url().'quotations');
    }
	
	public function comments($id){
		$data['comments'] = $this->quotation_model->getComments($id);
		$this->load->view('quotations/comments',$data);		
	}
	
	public function addComment(){
		$p = getPriviledges();
		if($p->quotCmtAdd != 1){
			redirect(base_url().'denial');
		}
		$data['comments'] = $this->quotation_model->addComment();
		if($data['comments']['success']){
			$rtnMsg = "Comment added";
		}
		else{
			$rtnMsg = "Failed to add comment, please contact administrator";
		}
		//$data['success'] = $data['comments']['success'];
		//$data['rtnMsg'] = $rtnMsg;
		$data = setOutput($data['comments']['success'], $rtnMsg,$data);
        
		$id = $data['comments']['quotId'];
		//var_dump($result);
		$this->load->view('quotations/comments',$data);
	}
	
	public function editComment($quotId,$id){
		$p = getPriviledges();
		if($p->quotCmtEdit != 1){
			redirect(base_url().'denial');
		}
		$data['comments'] = $this->quotation_model->getComments($quotId);
		$data['quotCmt'] = $this->quotation_model->editComment($id);
		$this->load->view('quotations/comments',$data);		
	}
	
	public function updateComment($quotId,$id){
		$p = getPriviledges();
		if($p->quotCmtEdit != 1){
			redirect(base_url().'denial');
		}
		$success = $this->quotation_model->updateComment();
		if($success){
			$rtnMsg = "Comment successfully updated";
		}
		else{
			$rtnMsg = "Comment cannot be updated, please contact administrator";
		}
		
		$quotCmts 	= $this->db->get_where("quotCmts", array('quotId'=>$quotId));
		$quotation = $this->db->get_where("quotations", array('id'=>$quotId));
		$customer 	= $this->db->get_where("customers");
		$data['comments'] = array('quotCmts' => $quotCmts->result(),'quotation' => $quotation->row(),'customers' => $customer->result_array());
		$data = setOutput($success, $rtnMsg,$data);
		$this->load->view('quotations/comments',$data);	 
		//redirect(base_url().'quotations/comments/'.$quotId);
	}
	
	public function deleteComment($quotId, $id){
		$p = getPriviledges();
		if($p->quotCmtDel != 1){
			redirect(base_url().'denial');
		}
		$success = $this->quotation_model->deleteComment($id);
		if($success){
			$rtnMsg = "Comment successfully deleted";
		}
		else{
			$rtnMsg = "Comment cannot be deleted, please contact administrator";
		}
		$data['comments'] = $this->quotation_model->getComments($quotId);
		$data = setOutput($success, $rtnMsg,$data);
		$this->load->view('quotations/comments',$data);	
		//redirect(base_url().'quotations/comments/'.$quotId);
	}
	
	function check_session(){
		$id = $this->session->userdata('id');
		
		if(!$id){
			redirect('login');
		}
	}
}
