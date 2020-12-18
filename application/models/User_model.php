<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model{

    protected $tableName = 'members'; // Table name of customer
    function __construct(){
        parent::__construct();

        $this->load->helper('url'); // Help to load urls in views and controllers
        $this->load->helper('html'); // Help to load CSS files
        $this->load->view('common/library'); // Call library view to include all required files
    }
    
    public function getUsers($params){
        $this->db->select($params['fields']); // select fields from table
        $this->db->order_by($params['order']);
		
		$query = $this->db->get_where($this->tableName);
        return $query->result_array();
    }
    
    // used for register view
    public function insert($params){

        // fields to be update in database table
        $fields = array(
            'firstName' 	=> $params['inpFirstName'],
            'lastName' 		=> $params['inpLastName'],
            'email' 		=> $params['inpEmail'],
            'username' 		=> $params['inpUserName'],
            'role' 			=> $params['inpRole'],
			'password'		=> $params['inpPassword']
        );
	
        // Check if table is empty or not
        $condition = array(
            'email' 	=> $params['inpEmail'],
            'username' 	=> $params['inpUserName']
        );

        $query = $this->db->get_where($this->tableName, $condition);
        $results = $query->result_array();
        if(!empty($results))
        {
			return array('success' => 0,'rtnMsg' => "You cannot add new user as the user record already exists"); // field already exists
			
        }
        else{
			$totalUsers = $this->db->count_all_results($this->tableName);
			if($totalUsers==LIMIT_USERS){
				//$success = 0;
				//$rtnMsg  = "You cannot add new user as the user limit is exceeded";
				return array('success' => 0,'rtnMsg' => "You cannot add new user as the user limit is exceeded");
			}else{
				// Insert data to the table
				$this->db->insert( $this->tableName, $fields ); // Customer successfully inserted if results true
				$insert_id = $this->db->insert_id();
				
				// priviledge set
				$privs = array(
					'userId'		=> $insert_id,
					'custAdd' 		=> $params['inpCustAdd'],
					'custEdit'	 	=> $params['inpCustEdit'],
					'custDel' 		=> $params['inpCustDel'],
					'quotAdd' 		=> $params['inpQuotAdd'],
					'quotEdit' 		=> $params['inpQuotEdit'],
					'quotDel' 		=> $params['inpQuotDel'],
					'quotCmtAdd'	=> $params['inpQuotCmtAdd'],
					'quotCmtEdit'	=> $params['inpQuotCmtEdit'],
					'quotCmtDel'	=> $params['inpQuotCmtDel'],
					'orderAdd' 		=> $params['inpOrderAdd'],
					'orderEdit' 	=> $params['inpOrderEdit'],
					'orderDel' 		=> $params['inpOrderDel'],
					'userAdd' 		=> $params['inpUserAdd'],
					'userEdit' 		=> $params['inpUserEdit'],
					'userDel' 		=> $params['inpUserDel']
				);
				
				$success = $this->db->insert('privilege',$privs);
				if($success = 1){
					$rtnMsg = "New user added";
				}else{
					$rtnMsg = "Failed to add user, please contact administrator";
				}
				return array('success' => $success , 'rtnMsg' => $rtnMsg);
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
            'firstName' 	=> $this->input->post('inpFirstName'),
            'lastName' 		=> $this->input->post('inpLastName'),
            'email' 		=> $this->input->post('inpEmail'),
            'role'	 		=> $this->input->post('inpRole'),
        ); 
        $this->db->where('id',$id);
        $this->db->update($this->tableName,$fields);
        if($this->db->affected_rows()>0){
			$success = 1;
			$rtnMsg = "Updated successfully";
        }
        else{
            // if no change is done
			$success = 0;
			$rtnMsg = "User details cannot be updated";
        }
		return array('success' => $success , 'rtnMsg' => $rtnMsg);
    }

    public function delete($id){
		// if only 1 user exists with role = 1, then it cannpt be deleted
		$users = $this->db->query('SELECT * FROM members')->num_rows();
		$user = $this->db->get_where($this->tableName, array('id'=>$id))->row();
		$userRole = $user->role;
		$rows =	$this->db->query('SELECT * FROM members WHERE role = 1')->num_rows(); // fetch number of rows with role of Super Admin
		
		if(($users==1 && $rows==1)){
			$success = 0; // Single record with Super Admin access cannot be deleted
			$rtnMsg = "Single user with admin role cannot be deleted";
		}else if($rows == 1 && $userRole == 1){
			$success = 0; // Single record with Super Admin access cannot be deleted
			$rtnMsg = "Single user with admin role cannot be deleted";
		}
		else{
			$this->db->where('userId',$id);
			$success = $this->db->delete('privilege');
			if($success){
				$this->db->where('id',$id);
				$success = $this->db->delete($this->tableName);
				if($success){
					$rtnMsg = "User successfully deleted";
				}else{
					$rtnMsg = "Unable to delete user";
				}
			}else{
				$success = 0;
				$rtnMsg = "Unable to delete user priviledge";
			}	
		}
		return array('success' => $success , 'rtnMsg' => $rtnMsg);
    }
}