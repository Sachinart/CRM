<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_model{

    protected $tableName = 'customers'; // Table name of customer
    function __construct(){
        parent::__construct();

        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }
    
    public function getCustomers($params){
        $this->db->select($params['fields']); // select fields from table
        $this->db->order_by($params['order']);
		
		$condition = array(
            'isDeleted' => 0
        );
		$query = $this->db->get_where($this->tableName,$condition);
        return $query->result_array();
    }
    
    // used for register view
    public function insert($params){

        // fields to be update in database table
        $fields = array(
            'firstName' 	=> $params['inpFirstName'],
            'lastName' 		=> $params['inpLastName'],
            'email' 		=> $params['inpEmail'],
            'mobNo' 		=> $params['inpMobNo'],
            'stateId' 		=> $params['inpStateId'],
            'gst' 			=> $params['inpGST'],
            'pan'		 	=> $params['inpPAN'],
            'deliveryAddr' 	=> $params['inpDeliveryAddr'],
			'creationDate'  => getUTC(),
			'updationDate'  => getUTC()
        );

        // Check if table is empty or not
        $condition = array(
            'email' => $params['inpEmail'],
            'mobNo' => $params['inpMobNo']
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
            return $this->db->insert( $this->tableName, $fields ); // Customer successfully inserted if results true
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
            'firstName' 	=> $this->input->post('inpFirstName'),
            'lastName' 		=> $this->input->post('inpLastName'),
            'email' 		=> $this->input->post('inpEmail'),
            'mobNo' 		=> $this->input->post('inpMobNo'),
            'stateId'	 	=> $this->input->post('inpStateId'),
            'gst' 			=> strtoupper($this->input->post('inpGST')),
            'pan'	 		=> strtoupper($this->input->post('inpPAN')),
            'deliveryAddr' 	=> $this->input->post('inpDeliveryAddr'),
			//'updationDate'  => date("Y-m-d H:i:s"),
			'updationDate'  => getUTC()
        ); 
        $this->db->where('id',$id);
        $this->db->update($this->tableName,$fields);
        if($this->db->affected_rows()>0){
			return 1;
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

}