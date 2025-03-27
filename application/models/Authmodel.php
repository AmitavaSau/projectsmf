<?php
class Authmodel extends CI_Model {
    function __construct() {
        parent::__construct();
		$this->load->database();
		$ci = get_instance();
		$ci->load->helper('string');
    }
    
	//authenticate user
	function authenticate_user($username, $password) {
		$user_table = 'users';
		if(!empty($username) && !empty($password)) {
			$query = $this->db->get_where($user_table, array('LOWER(user_name)' => strtolower($username),															 	'user_is_active'	=>	1
															));
			
			if ($query->num_rows() == 1) {
				$user = $query->row(); 								
				return $user;
			}
		}
		
		return NULL;
    }


	//get user roles as option
	function get_user_roles_option() {
		$role_table = 'auth_roles';
        $this->db->select('role_id, role_name');
        $this->db->from($role_table);
        if($_SESSION['AX_username'] != 'sysadmin') {
			$this->db->where('role_id !=', 1);
		}
        $this->db->order_by('role_order', 'ASC');
        $query = $this->db->get();
		$dropdowns = $query->result();
		$dropDownList[''] = "";
        foreach($dropdowns as $dropdown)
        {
        	$dropDownList[$dropdown->role_id] = $dropdown->role_name;
        }
    	$finalDropDown = $dropDownList;
        return $finalDropDown;
	}
	
	//get user roles
	function get_user_roles() {
		$role_table = 'auth_roles';
		$this->db->select("role_id, role_ref, role_name, role_description");
		$this->db->from($role_table);
		$this->db->order_by("role_order", "ASC");
		$query = $this->db->get();
        return $query->result();
	}
	
	//get role by ref
	function get_role_by_ref($role_ref) {
		$r_tbl			=	'auth_roles';
		
		$this->db->select('role_id, role_ref, role_name, role_description, role_order', FALSE);
		$this->db->from($r_tbl);
		$this->db->where('role_ref', $role_ref);
		$query = $this->db->get();
		$result	=	$query->row();
		return $result;
	}
	
	//create user role 
	function create_user_role($role_name, $role_description) {
		$role_table = 'auth_roles';
		$id		=	0;
		if(!empty($role_name) && !empty($role_description)) {
			$data	=	array(
								'role_name'			=>	$role_name,
								'role_description'	=>	$role_description
							);
			$this->db->insert($role_table, $data);
			$id = $this->db->insert_id();
		}
		
		return ($id == 0) ? false : true;	
	}
	
	//get url group as option
	function get_url_group_as_option() {
		$arr	=	array(
							'AUTHENTICATION'	=>	'AUTHENTICATION',
							'CONFIGURATION'		=>	'CONFIGURATION',
							'CANDIDATE'			=>	'CANDIDATE',
							'REPORTS'			=>	'REPORTS',
							'USER'				=>	'USER',
						);
		return $arr;				
	}
	
	//get auth url
	function get_auth_urls() {
		$url_table = 'auth_urls';
		$query = $this->db->get($url_table);
        return $query->result();
	}

	//create auth url 
	function create_auth_url($url_name, $url_description) {
		$url_table = 'auth_urls';
		$id		=	0;
		if(!empty($url_name) && !empty($url_description)) {
			$data	=	array(
								'url_name'			=>	$url_name,
								'url_description'	=>	$url_description
							);
			$this->db->insert($url_table, $data);
			$id = $this->db->insert_id();
		}
		
		return ($id == 0) ? false : true;	
	}
	
	//get auth urls by role
	function get_auth_urls_by_role($role_id, $module_name) {
		$rp_table 		= 	'auth_roles_permissions';
		$role_table		= 	'auth_roles';
		$url_table		=	'auth_urls';
		
		if($_SESSION['AX_role_id'] != '1') {
			$url_query 		= 	$this->db->order_by('url_name', 'ASC')->get_where($url_table, array('url_group' => $module_name));
		}
		else {
			$url_query 		= 	$this->db->order_by('url_name', 'ASC')->get_where($url_table, array('url_group' => $module_name, 'url_visible' => 1));
		}	
        $urls			=	$url_query->result();
        
        $perm_query 	= 	$this->db->get_where($rp_table, array('rp_role_id' => $role_id));
        $permissions	=	$perm_query->result();

		$acl		=	array();
		
		for($i=0; $i<count($urls); $i++) {
			if(count($permissions) > 0){
				for($j=0; $j < count($permissions); $j++){
					if($permissions[$j]->rp_url_id == $urls[$i]->url_id){
						$acl[$i]	=	array(
							'url_id'			=>	$urls[$i]->url_id,
							'url_name'			=>	$urls[$i]->url_name,
							'url_description'	=>	$urls[$i]->url_description,
							'role_id'			=>	$role_id,
							'has_access'		=>	1
						);	
						break;
					}
					else {
						$acl[$i]	=	array(
							'url_id'			=>	$urls[$i]->url_id,
							'url_name'			=>	$urls[$i]->url_name,
							'url_description'	=>	$urls[$i]->url_description,
							'role_id'			=>	$role_id,
							'has_access'		=>	0
						);
					}	
				}
					
			}
			else {
				$acl[$i]	=	array(
										'url_id'			=>	$urls[$i]->url_id,
										'url_name'			=>	$urls[$i]->url_name,
										'url_description'	=>	$urls[$i]->url_description,
										'role_id'			=>	$role_id,
										'has_access'		=>	0
									);
			}	
			
			
		}	
		return $acl;
	}
	
	//assign auth urls
	function assign_access($module, $role_id, $access_urls) {
		$rp_table 		= 	'auth_roles_permissions';
		$this->db->delete($rp_table, array(	'rp_group'	=>	$module,
											'rp_role_id' => $role_id));
		$acl	=	explode(",", $access_urls);
		foreach($acl as $val) {
			$data	=	array(
								'rp_group'		=>	$module,
								'rp_role_id'	=>	$role_id,
								'rp_url_id'		=>	$val
							);
			$this->db->insert($rp_table, $data);
		}
		return true;
	}

	//check access
	function has_access($role_id, $url) {
		$url_table		=	'auth_urls';
		$rp_table 		= 	'auth_roles_permissions';
		
		$this->db->select('rp_url_id');
		$this->db->from($rp_table);
		$this->db->join($url_table, 'rp_url_id = url_id');
		$this->db->where('rp_role_id', $role_id);
		$this->db->where('url_name', $url);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() == 1) {
			return $query->row();
		}
		return NULL;
		
	}

}


?> 