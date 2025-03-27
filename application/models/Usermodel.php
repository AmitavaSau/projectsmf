<?php
class Usermodel extends CI_Model {
    
    function __construct() {
        parent::__construct();
		$this->load->database();
		$ci = get_instance();
		$ci->load->helper('string');
		$ci->load->helper('audit');
    }
    
	//create user  
	function create_user($data) {
		$user_table = 'users';
		$id		=	0;
		if(!empty($data)) {
			$this->db->insert($user_table, $data);
			$id = $this->db->insert_id();
		}
		
		return ($id == 0) ? false : true;	
	}    
    
    //list all users
    function list_all_users() {
		$user_table = 'users';
		$role_table = 'auth_roles';
		
		$this->db->select('user_name, user_ref, 
				CONCAT (user_firstname, " ", user_midname, " ", user_lastname) AS user_fullname, 
				user_email, user_mobile, user_photo, user_is_active, role_name');
        $this->db->from($user_table);
        $this->db->join($role_table, 'role_id = user_role_id');
        if($_SESSION['AX_username'] != 'sysadmin') {
			$this->db->where('role_id !=', 1);
		}
        $this->db->order_by('user_name', 'ASC');
        $query = $this->db->get();
		return $query->result();
	}

	//get user by ref
	function get_user_by_ref($ref) {
		$u_table = 'users';
		$role_table = 'auth_roles';
		
		$this->db->select('user_id, user_ref, user_role_id, user_name, 
							user_firstname, user_midname, user_lastname, 
							CONCAT (user_firstname, " ", user_midname, " ", user_lastname) AS user_fullname, 
							user_email, user_mobile, user_photo, 
							user_is_active, role_name', FALSE);
        $this->db->from($u_table);
        $this->db->join($role_table, 'role_id = user_role_id');
        $this->db->where('user_ref', $ref);
        $query = $this->db->get();
		return $query->row();
	}
	
	//update user  
	function update_user() {
		$user_table = 'users';
		$data	=	array(
							'user_role_id'		=>	$this->input->post('user_role_id', true),
							'user_firstname'	=>	$this->input->post('user_firstname', true),
							'user_midname'		=>	$this->input->post('user_midname', true),
							'user_lastname'		=>	$this->input->post('user_lastname', true),
							'user_email'		=>	$this->input->post('user_email', true),
							'user_mobile'		=>	$this->input->post('user_mobile', true)
						);
		
		$this->db->where('user_name', $this->input->post('user_name', true));
		$this->db->update($user_table, $data);

		return ($this->db->affected_rows() > 0) ? true : false;
	}    
    
    //change password
    function change_password($data, $username) {
		$user_table = 'users';
		$id		=	0;
		if(!empty($data)) {
			$this->db->where('user_name', $username);
			$this->db->update($user_table, $data);
		}
		
		return ($this->db->affected_rows() > 0) ? true : false;
	}
    
    
    
    
}
?>    