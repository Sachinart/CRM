<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_model{

	protected $tableName = 'orders'; // Table name of customer
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }
    
    public function getOrders($params){
        $this->db->select($params['fields']); // select fields from table
        $this->db->order_by($params['order']);
		$condition = array(
            'isDeleted' => 0
        );
        $query = $this->db->get_where($this->tableName,$condition);
        return $query->result_array();
    }
    
    // used for register view
    public function add($params){
        // fields to be inserted in database table
        $fields = array(
            'quotId' 		=> $params['inpQuotId'],
            'status' 		=> $params['inpStatus'],
			'creationDate'  => getUTC(),
			'updationDate'  => getUTC()
        );

        // Check if table is empty or not
        $condition = array(
            'quotId' => $params['inpQuotId']
        );

        $query = $this->db->get_where($this->tableName, $condition);
        $results = $query->result_array();
        if(!empty($results))
        {
            return array('success' => 0 , 'rtnMsg' => 'Order existed'); 
        }
        else{
            // Insert data to the orders table
            $successOrder = $this->db->insert( $this->tableName, $fields );
			if($successOrder){
				// if successfully inserted data in order table, change status of the quotation to closed
				$fieldsQ = array(
					'status' 		=> 2,
					'updationDate' 	=> getUTC()
				); 
				$this->db->where('id',$params['inpQuotId']);
				$successQuot = $this->db->update('quotations',$fieldsQ);
				if($successQuot){
					// if successfully updated quotation status to closed
					$fieldsA = array(
						'moduleName' 	=> "quotation",
						'message'	 	=> "Quotation (id = ".$params['inpQuotId'].") has been converted to sales",
						'creationDate'	=> getUTC()
					); 
					$success = $this->db->insert( 'alerts', $fieldsA );
					if($success){
						$rtnMsg  = "Order successfully added";					
					}
					else{
						$success = 0;
						$rtnMsg = "Order successfully added but failed to update alert message";
					}
					return array('success' => $success , 'rtnMsg' => $rtnMsg);
				}	
				else{
					$successQuot = 0;
					$rtnMsg  = "Order successfully added but failed to update quotation status to closed";
					return array('success' => $successQuot , 'rtnMsg' => $rtnMsg);
				}
			}else{
				$successOrder = 0;
				$rtnMsg  = "Failed to add order";
				return array('success' => $successOrder , 'rtnMsg' => $rtnMsg);
			}
        }
    }

    public function edit($id){
        // fetch data has id = $id from table;
        $query = $this->db->get_where($this->tableName, array('id'=>$id));
        return $query->row();
    }
	
    // to update customer fields
    public function update(){
        $id = $this->input->post('id');
        //echo $id;
        $fields = array(
            'status' 		=> $this->input->post('inpStatus'),
            'updationDate' 	=> getUTC()
        ); 
        $this->db->where('id',$id);
        $this->db->update($this->tableName,$fields);
        if($this->db->affected_rows()>0){
			return array('success' => 1 , 'rtnMsg' => 'Order successfully updated'); 
            //redirect(base_url().'orders');
        }
        else{
            // if no change is done
            return array('success' => 0 , 'rtnMsg' => 'Order cannot be updated'); 
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
			$rtnMsg = "Order is removed";
        }
        else{
            $success = 0;
			$rtnMsg = "Order cannot be removed, please contact administrator";
        }
		return array('success' => $success , 'rtnMsg' => $rtnMsg);
    }

}