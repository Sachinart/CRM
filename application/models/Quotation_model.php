<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation_model extends CI_model{

	protected $tableName = 'quotations'; // Table name of quotations
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }
    
    public function getQuotations($params){
        $this->db->select($params['fields']); // select fields from table
        $this->db->order_by($params['order']);
        
		$condition = array(
            'isDeleted' => 0
        );
		
		$query = $this->db->get_where($this->tableName, $condition);

        return $query->result_array();
    }
    
    // used for register view
    public function insert($params){

        // fields to be update in database table
        $fields = array(
            'item' 			=> $params['inpItem'],
            'itemDesc' 		=> $params['inpItemDesc'],
            'quantity' 		=> $params['inpQuantity'],
            'customerId'	=> $params['inpCustomerId'],
            'rate' 			=> $params['inpRate'],
            'tnc' 			=> $params['inptnc'],
            'deliveryTime' 	=> $params['inpDeliveryTime'],
            'cgst' 			=> $params['inpcgst'],
            'sgst' 			=> $params['inpsgst'],
            'igst' 			=> $params['inpigst'],
            'orderValue' 	=> $params['inpOrderValue'],
			'creationDate'  => getUTC(),
			'updationDate'  => getUTC(),
            'status'	 	=> $params['inpStatus']
        );

        // Check if table is empty or not
        $condition = array(
            'item' 			=> $params['inpItem'],
            'customerId' 	=> $params['inpCustomerId']
        );

        $query = $this->db->get_where($this->tableName, $condition);
        $results = $query->result_array();
        if(!empty($results))
        {
            return 0; // field already exists
            // $success = 1;
            // return true;
        }
        else{
            // Insert data to the table
            $this->db->insert( $this->tableName, $fields );
            return 1; // field successfully inserted
        }
    }

    public function edit($id){
        // fetch data has id = $id from table
        $query = $this->db->get_where($this->tableName, array('id'=>$id));
		return $query->row();
    }

    // to update customer fields
    public function update(){
        $id = $this->input->post('id');
        //echo $id;
        $fields = array(
            'item' 			=> $this->input->post('inpItem'),
            'itemDesc' 		=> $this->input->post('inpItemDesc'),
            'quantity' 		=> $this->input->post('inpQuantity'),
            'customerId' 	=> $this->input->post('inpCustomerId'),
            'rate' 			=> $this->input->post('inpRate'),
            'tnc' 			=> $this->input->post('inptnc'),
            'deliveryTime' 	=> $this->input->post('inpDeliveryTime'),
            'cgst' 			=> $this->input->post('inpcgst'),
            'sgst' 			=> $this->input->post('inpsgst'),
            'igst' 			=> $this->input->post('inpigst'),
            'orderValue' 	=> $this->input->post('inpOrderValue'),
			//'updationDate'  => date("Y-m-d H:i:s"),
			'updationDate'  => getUTC(),
            'status' 		=> $this->input->post('inpStatus')
        ); 
        $this->db->where('id',$id);
        $this->db->update($this->tableName,$fields);
		if($this->db->affected_rows()>0){
			return 1;
            //redirect(base_url().'quotations');
        }
        else{
            // if no change is done
            return 0;
			//redirect(base_url().'dashboard');
        }

    }

    public function remove($id){
        
		//echo $id;
		$fields = array(
            'isDeleted' 	=> 1
        ); 
		
		$this->db->where('id',$id);
        $this->db->update($this->tableName,$fields);
        if($this->db->affected_rows()>0){
			$success = 1;
            return $success;
        }
        else{
            $success = 0;
            return $success;
        }
    }
	
	public function getComments($id){
		$quotCmts 	= $this->db->get_where("quotCmts", array('quotId'=>$id));
		$quotation = $this->db->get_where("quotations", array('id'=>$id));
		$customer 	= $this->db->get_where("customers");
		return array('quotCmts' => $quotCmts->result(),'quotation' => $quotation->row(),'customers' => $customer->result_array());
	}
	
	public function addComment(){
		$quotId = $this->input->post('quotId');
		if($quotId){		
			$fields = array(
			'quotId' 		=> $quotId,
			'comments' 		=> $this->input->post('inpQuotComment'),
			//'CreationDate'=> date("Y-m-d H:i:s")
			'CreationDate'  => getUTC()
			); 
			
			$condition = array(
				'quotId' 	=> $this->input->post('quotId'),
				'comments' 	=> $this->input->post('inpQuotComment')
			);

			// to pass back to comments page the data which remains same when failed to add quote comment page
			$quotCmts 	= $this->db->get_where("quotCmts", array('quotId'=>$quotId));
			$quotation  = $this->db->get_where("quotations", array('id'=>$quotId));
			$customer 	= $this->db->get_where("customers");
			
			// check whether comment already exists
			$query 	 = $this->db->get_where('quotCmts', $condition);
			$results = $query->result_array();
			if(!empty($results))
			{
				return array('success' => 0 , 'quotId' => $quotId,'quotCmts' => $quotCmts->result(),'quotation' => $quotation->row(),'customers' => $customer->result_array()); 
			}
			else{
				// Insert data to the table
				$this->db->insert('quotCmts', $fields );
				
				// to pass back to comments page the updated data to add quote comment page
				$quotCmts 	= $this->db->get_where("quotCmts", array('quotId'=>$quotId));
				$quotation  = $this->db->get_where("quotations", array('id'=>$quotId));
				$customer 	= $this->db->get_where("customers");
				
				return array('success' => 1 , 'quotId' => $quotId,'quotCmts' => $quotCmts->result(),'quotation' => $quotation->row(),'customers' => $customer->result_array()); // field successfully inserted
			}
		}else{
			redirect(base_url().'error404');
		}
	}
	
	public function editComment($id){
		$quotCmt  = $this->db->get_where("quotCmts", array('id'=>$id));
		return $quotCmt->row();
	}
	
	public function updateComment(){
		$quotId 	= $this->input->post('quotId');
		$quotCmtId 	= $this->input->post('quotCmtId');
        //echo $id;
        $fields = array(
            'comments' 	=> $this->input->post('inpQuotComment')
        ); 
        $this->db->where('id',$quotCmtId);
        $this->db->update('quotCmts',$fields);
        if($this->db->affected_rows()>0){
			return 1;
            //redirect(base_url().'quotations/comments/'.$quotId);
        }
        else{
            // if no change is done
			return 0;
            //redirect(base_url().'dashboard');
        }
	}
	
	public function deleteComment($id){
		$this->db->where('id', $id);
		return $this->db->delete('quotCmts');
	}

}