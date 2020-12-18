<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_model{

    protected $tableCustomer = 'customer'; // Table name of customer
   
    function __construct(){
        parent::__construct();

        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }

    public function index(){
        /*
            To fetch the number of records of each table to show on dashboard
        */
		$customers  = $this->db->query('SELECT id FROM customers where isDeleted = 0');
		$quotations = $this->db->query('SELECT id FROM quotations where isDeleted = 0');
		$orders = $this->db->query('SELECT id FROM orders where isDeleted = 0');
		$users = $this->db->query('SELECT id FROM members');
		return array('customers'=>$customers->num_rows(),'quotations'=>$quotations->num_rows(),'users'=>$users->num_rows(),'orders'=>$orders->num_rows());
	}

}