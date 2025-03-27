<?php
class Configmodel extends CI_Model{
    
	function __construct(){
		parent::__construct();
		$this->load->database();
		$ci = get_instance();
		$ci->load->helper('string');
		$ci->load->helper('security');
		$ci->load->helper('aranax');
		$ci->load->helper('audit');
	}
    
	/*
	*	DROPDOWN OPTIONS
	*/
	//gender option
	function get_gender_option(){
		$arr = array("MALE" => "MALE", "FEMALE" => "FEMALE");
		return $arr;
	}
	
	//category option
	function get_category_option(){
		$arr = array("" => "", "GE" => "GENERAL", "SC" => "SC", "ST" => "ST", 
						"OA" => "OBC-A", "OB" => "OBC-B");
						
		return $arr;
	}
	
	//allotment category option
	function get_allotment_category_option() {
		$arr = array(	"" => "",
					 	"GE" => "GENERAL",
					  	//"SC" => "SC",
						//"ST" => "ST", 
						//"OA" => "OBC-A", 
						//"OB" => "OBC-B", 
						//"PW" => "PH",
						//"EWS" => "EWS"
						
						);
		return $arr;
	}
    
	//get country as option
	function get_country_option(){
		$cntry_table = 'cnfg_country';
		$this->db->select('cntry_code, cntry_name');
		$this->db->from($cntry_table);
		$this->db->order_by('cntry_name', 'ASC');
		$query = $this->db->get();
		$dropdowns = $query->result();
		$dropDownList[''] = "";
		foreach($dropdowns as $dropdown){
			$dropDownList[$dropdown->cntry_code] = $dropdown->cntry_name;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	//get state as option
	function get_state_option(){
		$s_table = 'cnfg_state';
		$this->db->select('st_code, st_name');
		$this->db->from($s_table);
		$this->db->order_by('st_name', 'ASC');
		$query = $this->db->get();
		$dropdowns = $query->result();
		$dropDownList[''] = "";
		foreach($dropdowns as $dropdown){
			$dropDownList[$dropdown->st_code] = $dropdown->st_name;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	//get college as option
	function get_college_options() {
		$c_table = 'mast_colleges';
		$this->db->select('col_code, col_name,CONCAT(col_code, " - ", col_name) AS col_code_name');
		$this->db->from($c_table);
		$this->db->where('is_delete', 0);
		$this->db->order_by('col_name', 'ASC');
		$query = $this->db->get();
		$dropdowns = $query->result();
		$dropDownList[''] = "--Select--";
		foreach($dropdowns as $dropdown){
			$dropDownList[$dropdown->col_code] = $dropdown->col_name;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	//get course options
	function get_course_options() {
		$arr = array('MTECH' => 'MTECH', 'MPHARM' => 'MPHARM');
		return $arr;
	}
	
	//get course name options
	function get_course_name_options() {
		$crs_table = 'mast_courses';
		$this->db->distinct();
		$this->db->select('c.sl AS crs_code, c.crs_name AS crs_name');
		$this->db->from($crs_table . ' AS c');
		$this->db->order_by('crs_name', 'ASC');
		$query = $this->db->get();
		$dropdowns = $query->result();
		$dropDownList[''] = "--Select--";
		foreach($dropdowns as $dropdown){
			$dropDownList[$dropdown->crs_code] = $dropdown->crs_name;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
/***************************
COLLEGE RELATED FUNCTIONS
***************************/
	//get all colleges
	function get_colleges($col_type='all') {
		$c_tbl = 'mast_colleges';
		$this->db->select('sl AS col_sl, col_code, col_name, col_address,col_type', false);
		$this->db->from($c_tbl);
		if($col_type!='all') {
			$col_type	=	explode('_',$col_type);
			$this->db->where_in('col_type',$col_type);
		}		
     	$this->db->order_by('col_code', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//save ccollege
	function save_college($col_code, $col_name, $col_address, $col_sl, $action) {
		$c_tbl 	= 	'mast_colleges';
		$num	=	0;
		$at_action = '';
		$data	=	array(
							'col_code'	=>	$col_code,
							'col_name'	=>	$col_name,
							'col_address'	=>	$col_address
						);
		
		if($action == 'CREATE') {
			$this->db->insert($c_tbl, $data);
			$num = $this->db->insert_id();
			$at_action = 'College having code #' . $col_code . ' created';
		}
		else {
			$this->db->where('sl', $col_sl);
			$this->db->update($c_tbl, $data);
			$num = $this->db->affected_rows();
			$at_action = 'College having code #' . $col_code . ' updated';
		}
		
		if($num > 0) {
			//add to audit trail
			$audit_trail_msg	=	$at_action;
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'College information saved successfully',
						 'data'=> $this->get_colleges(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'College information saving failed',
						 'data'=> $this->get_colleges(), 
						 'token' => $this->security->get_csrf_hash());
		}

				
	}

	//delete college
	function delete_college($col_sl) {
		$c_tbl 	= 	'mast_colleges';
		
		$this->db->select('col_code');
		$this->db->from($c_tbl);
		$this->db->where('sl', $col_sl);
		$query = $this->db->get();
		$result = $query->row();
		$col_code = $result->col_code;
		
		$data	=	array(
							'is_delete'	=>	1
						);
		$this->db->where('sl', $col_sl);
		$this->db->update($c_tbl, $data);
		$num = $this->db->affected_rows();	
			
		if($num > 0) {
			$audit_trail_msg	=	'College having code #' . $col_code . ' deleted';
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'College information deleted successfully',
						 'data'=> $this->get_colleges(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'College information deletion failed',
						 'data'=> $this->get_colleges(), 
						 'token' => $this->security->get_csrf_hash());
		}			
	}

/***************************
COURSE RELATED FUNCTIONS
***************************/
	//get all courses
	function get_courses() {
		$c_tbl = 'mast_courses';
		$this->db->select('sl AS crs_sl, crs_course, crs_dept, crs_name', false);
		$this->db->from($c_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('crs_course', 'DESC');
		$this->db->order_by('crs_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//save course
	function save_course($crs_course, $crs_dept, $crs_name, $crs_sl, $action) {
		$c_tbl 	= 	'mast_courses';
		$num	=	0;
		$at_action = '';
		$data	=	array(
							'crs_course'	=>	$crs_course,
							'crs_dept'		=>	$crs_dept,
							'crs_name'		=>	$crs_name
						);
		
		if($action == 'CREATE') {
			$this->db->insert($c_tbl, $data);
			$num = $this->db->insert_id();
			$at_action = 'Course having code #' . $crs_name . ' created';
		}
		else {
			$this->db->where('sl', $crs_sl);
			$this->db->update($c_tbl, $data);
			$num = $this->db->affected_rows();
			$at_action = 'Course having code #' . $crs_name . ' updated';
		}
		
		if($num > 0) {
			//add to audit trail
			$audit_trail_msg	=	$at_action;
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Course information saved successfully',
						 'data'=> $this->get_courses(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Course information saving failed',
						 'data'=> $this->get_courses(), 
						 'token' => $this->security->get_csrf_hash());
		}

				
	}
	
	//delete course
	function delete_course($crs_sl) {
		$c_tbl 	= 	'mast_courses';
		
		$this->db->select('crs_code');
		$this->db->from($c_tbl);
		$this->db->where('sl', $crs_sl);
		$query = $this->db->get();
		$result = $query->row();
		$crs_code = $result->crs_code;
		$data	=	array(
							'is_delete'	=>	1
						);
		$this->db->where('sl', $crs_sl);
		$this->db->update($c_tbl, $data);
		$num = $this->db->affected_rows();	
			
		if($num > 0) {
			$audit_trail_msg	=	'Course having code #' . $crs_code . ' deleted';
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Course information deleted successfully',
						 'data'=> $this->get_courses(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Course information deletion failed',
						 'data'=> $this->get_courses(), 
						 'token' => $this->security->get_csrf_hash());
		}			
	}


/***************************
SEAT RELATED FUNCTIONS
***************************/
	//get all seats
	function get_seats() {
		$c_tbl = 'mast_colleges';
		$s_tbl = 'mast_seats';
		$crs_table = 'mast_courses';
		
		$this->db->select('s.sl AS seat_sl, s.col_code AS col_code, col_name, 
							s.crs_code AS crs_code, crs_course, crs_dept, crs.crs_name, 
							cat_ge, cat_sc, cat_st, cat_oa, cat_ob, cat_pw, 
							cat_sp_ge, cat_sp_sc', false);
		$this->db->from($s_tbl . ' AS s');
		$this->db->join($c_tbl . ' AS c', 'c.col_code = s.col_code', 'LEFT OUTER');
		$this->db->join($crs_table . ' AS crs', 'crs.sl = s.crs_code', 'LEFT OUTER');
		$this->db->where('c.is_delete', 0);
		$this->db->where('s.is_delete', 0);
		$this->db->order_by('s.col_code', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//save seats
	function save_seat($col_code, $crs_code, $crs_name, $cat_ge, $cat_sc, $cat_st, 
						$cat_oa, $cat_ob, $cat_pw, 
						$seat_sl, $action) {
		$s_tbl 	= 	'mast_seats';
		$seats_available_tbl	=   'seats_available';
		$num	=	0;
		$at_action = '';
		$data	=	array(
							'col_code'	=>	$col_code,
							'crs_code'	=>	$crs_name,
							'cat_ge'	=>	$cat_ge,
							'cat_sc'	=>	$cat_sc,
							'cat_st'	=>	$cat_st,
							'cat_oa'	=>	$cat_oa,
							'cat_ob'	=>	$cat_ob,
							'cat_pw'	=>	$cat_pw,
							
						);
		
		if($action == 'CREATE') {
			
			$this->db->insert($s_tbl, $data);
			$num = $this->db->insert_id();
			$at_action = 'Seat Of the College having code #' . $col_code . ' created';
			
		}
		else {
			
			$this->db->select('cat_ge,cat_sc,cat_st,cat_oa,cat_ob,cat_pw');
			$this->db->from($s_tbl);
			$this->db->where('sl', $seat_sl);
			$query = $this->db->get();
			$result = $query->row();
			$p_cat_ge = $result->cat_ge;
			$p_cat_sc = $result->cat_sc;
			$p_cat_st = $result->cat_st;
			$p_cat_oa = $result->cat_oa;
			$p_cat_ob = $result->cat_ob;
			$p_cat_pw = $result->cat_pw;

			
			$this->db->where('sl', $seat_sl);
			$this->db->update($s_tbl, $data);
			$num = $this->db->affected_rows();
			$at_action = 'Seat Of the College having code #' . $col_code . ' updated';
			
			if($num > 0){
				
				$ex_cat_ge = $cat_ge-$p_cat_ge;
				$ex_cat_sc = $cat_sc-$p_cat_sc;
				$ex_cat_st = $cat_st-$p_cat_st;
				$ex_cat_oa = $cat_oa-$p_cat_oa;
				$ex_cat_ob = $cat_ob-$p_cat_ob;
				$ex_cat_pw = $cat_pw-$p_cat_pw;
				
			$this->db->select('cat_ge,cat_sc,cat_st,cat_oa,cat_ob,cat_pw');
			$this->db->from($seats_available_tbl);
			$this->db->where('sl', $seat_sl);
			$query = $this->db->get();
			$result = $query->row();
			$avl_cat_ge = $result->cat_ge;
			$avl_cat_sc = $result->cat_sc;
			$avl_cat_st = $result->cat_st;
			$avl_cat_oa = $result->cat_oa;
			$avl_cat_ob = $result->cat_ob;
			$avl_cat_pw = $result->cat_pw;
			
				
				$data_seats_available	=	array(
							'col_code'	=>	$col_code,
							'crs_code'	=>	$crs_name,
							'cat_ge'	=>	$avl_cat_ge+$ex_cat_ge,
							'cat_sc'	=>	$avl_cat_sc+$ex_cat_sc,
							'cat_st'	=>	$avl_cat_st+$ex_cat_st,
							'cat_oa'	=>	$avl_cat_oa+$ex_cat_oa,
							'cat_ob'	=>	$avl_cat_ob+$ex_cat_ob,
							'cat_pw'	=>	$avl_cat_pw+$ex_cat_pw,
							
						);
				$this->db->where('sl', $seat_sl);
				$this->db->update($seats_available_tbl, $data_seats_available);		
				
			}
			
		}
		
		if($num > 0) {
			//add to audit trail
			$audit_trail_msg	=	$at_action;
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Seat information saved successfully',
						 'data'=> $this->get_seats(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Seat information saving failed',
						 'data'=> $this->get_seats(), 
						 'token' => $this->security->get_csrf_hash());
		}

				
	}
	
	//delete seat
	function delete_seat($seat_sl) {
		$s_tbl 	= 	'mast_seats';
		
		$this->db->select('col_code');
		$this->db->from($s_tbl);
		$this->db->where('sl', $seat_sl);
		$query = $this->db->get();
		$result = $query->row();
		$col_code = $result->col_code;
		
		$data	=	array(
							'is_delete'	=>	1
						);
		$this->db->where('sl', $seat_sl);
		$this->db->update($s_tbl, $data);
		$num = $this->db->affected_rows();	
			
		if($num > 0) {
			$audit_trail_msg	=	'Seat of the College having code #' . $col_code . ' deleted';
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Seat information deleted successfully',
						 'data'=> $this->get_seats(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Seat information deletion failed',
						 'data'=> $this->get_seats(), 
						 'token' => $this->security->get_csrf_hash());
		}			
	}

	
/***************************
STUDENT RELATED FUNCTIONS
***************************/
	//get all students
	function get_students() {
		$s_tbl = 'mast_candidates';
		$photo_loc	=	getFileLocation('candidate-profile');
		
		$this->db->select('sl, appl_reg_num, appl_roll_num, appl_fullname, appl_fathername,
							appl_dob, appl_gender, appl_category, appl_pwd, 
							appl_score, appl_percentile, appl_gmr, 
							appl_photo, appl_status, 
							alloted_category, alloted_pwd, alloted_course, 
							alloted_college', false);
		$this->db->from($s_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('appl_gmr', 'ASC');
		$query = $this->db->get();
		$r = $query->result();
		$arr = array();
		//echo $this->db->last_query(); exit();
		if(count($r)>0){
			for($i=0; $i<count($r); $i++) {
				$arr[$i] = array(
								'appl_sl'			=>	$r[$i]->sl,
								'appl_reg_num'		=>	$r[$i]->appl_reg_num,
								'appl_roll_num'		=>	$r[$i]->appl_roll_num,
								'appl_fullname'		=>	$r[$i]->appl_fullname,
								'appl_fathername'	=>	$r[$i]->appl_fathername,
								'appl_dob'			=>	$r[$i]->appl_dob,
								'appl_gender'		=>	$r[$i]->appl_gender,
								'appl_category'		=>	getCategoryName($r[$i]->appl_category),
								'appl_category_code'	=>	$r[$i]->appl_category,
								'appl_pwd'			=>	$r[$i]->appl_pwd,
								'appl_score'		=>	$r[$i]->appl_score,
								'appl_percentile'	=>	$r[$i]->appl_percentile,
								'appl_gmr'			=>	$r[$i]->appl_gmr,
								'appl_qualification'=>	'NO DATA AVAILABLE',
								'appl_photo'		=>	$photo_loc . $r[$i]->appl_photo,
								'appl_status'		=>	$r[$i]->appl_status,
								'alloted_category'	=>	$r[$i]->alloted_category,
								'alloted_pwd'		=>	$r[$i]->alloted_pwd,
								'alloted_course'	=>	$r[$i]->alloted_course,
								'alloted_college'	=>	$r[$i]->alloted_college
							);
			}	
		}
		return $arr;
	}
	
	//save students
	function updateStudents($appl_sl, $appl_roll_num, /*$appl_form_num,*/ 
							$appl_fullname, $appl_fathername, $appl_category, 
							$appl_dob, $action) 
		{

		$s_tbl 	= 	'mast_candidates';
		$num	=	0;
		$at_action = '';
		$data	=	array(
							'appl_roll_num'	=>	$appl_roll_num,
							//'appl_form_num'	=>	$appl_form_num,
							'appl_fullname'	=>	$appl_fullname,
							'appl_fathername'	=>	$appl_fathername,
							'appl_category'	=>	$appl_category,
							'appl_dob'		=>	$appl_dob
						);
		
		if($action == 'UPDATE') {
			$this->db->where('sl', $appl_sl);
			$this->db->update($s_tbl, $data);
			$num = $this->db->affected_rows();
			$at_action = 'Student having code #' . $appl_roll_num . ' updated';
		}
		
		if($num > 0) {
			//add to audit trail
			$audit_trail_msg	=	$at_action;
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Student information saved successfully',
						 'data'=> $this->get_students(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Student information saving failed',
						 'data'=> $this->get_students(), 
						 'token' => $this->security->get_csrf_hash());
		}

				
	}
	
	//delete student
	function delete_student($appl_sl) {
		$s_tbl 	= 	'mast_candidates';
		
		$this->db->select('appl_roll_num');
		$this->db->from($s_tbl);
		$this->db->where('sl', $appl_sl);
		$query = $this->db->get();
		$result = $query->row();
		$appl_roll_num = $result->appl_roll_num;
		
		$data	=	array(
							'is_delete'	=>	1
						);
		$this->db->where('sl', $appl_sl);
		$this->db->update($s_tbl, $data);
		$num = $this->db->affected_rows();	
			
		if($num > 0) {
			$audit_trail_msg	=	'Students having code #' . $appl_roll_num . ' deleted';
			audit_trail($audit_trail_msg);
			
			return array('error' => false, 
						 'message' => 'Student information deleted successfully',
						 'data'=> $this->get_students(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Student information deletion failed',
						 'data'=> $this->get_students(), 
						 'token' => $this->security->get_csrf_hash());
		}			
	}

/***************************
CONTNET RELATED FUNCTIONS
***************************/
	//set texts in session
	function get_config_texts() {
		$c_tbl = 'mast_contents';
		$this->db->select('conf_name, conf_value', false);
		$this->db->from($c_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('conf_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		$arr = array();
		for($i=0; $i<$query->num_rows(); $i++) {
			$arr+= array(
								$result[$i]->conf_name => $result[$i]->conf_value
							);
		}
		return $arr;
	}
	
	//get all texts
	function get_texts() {
		$c_tbl = 'mast_contents';
		$this->db->select('sl AS conf_sl, conf_name, conf_value', false);
		$this->db->from($c_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('conf_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	//save text
	function save_text($conf_name, $conf_value, $conf_sl, $action) {
		$c_tbl 	= 	'mast_contents';
		$num	=	0;
		$at_action = '';
		$data	=	array(
							'conf_name'		=>	$conf_name,
							'conf_value'	=>	$conf_value
						);
		
		if($action == 'CREATE') {
			$this->db->insert($c_tbl, $data);
			$num = $this->db->insert_id();
			$at_action = 'Content :: ' . $conf_name . ' :: created';
		}
		else {
			$this->db->where('sl', $conf_sl);
			$this->db->update($c_tbl, $data);
			$num = $this->db->affected_rows();
			$at_action = 'Content :: ' . $conf_name . ' :: updated';
		}
		
		if($num > 0) {
			//add to audit trail
			$audit_trail_msg	=	$at_action;
			audit_trail($audit_trail_msg);
			
			$_SESSION['config_texts'] = $this->configmodel->get_config_texts();
			
			return array('error' => false, 
						 'message' => 'Content saved successfully',
						 'data'=> $this->get_texts(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Content saving failed',
						 'data'=> $this->get_texts(), 
						 'token' => $this->security->get_csrf_hash());
		}

				
	}
	
	//delete text
	function delete_text($conf_sl) {
		$c_tbl 	= 	'mast_contents';
		
		$this->db->select('conf_name');
		$this->db->from($c_tbl);
		$this->db->where('sl', $conf_sl);
		$query = $this->db->get();
		$result = $query->row();
		$conf_name = $result->conf_name;
		$data	=	array(
							'is_delete'	=>	1
						);
		$this->db->where('sl', $conf_sl);
		$this->db->update($c_tbl, $data);
		$num = $this->db->affected_rows();	
			
		if($num > 0) {
			$audit_trail_msg	=	'Content ::' . $conf_name . ':: deleted';
			audit_trail($audit_trail_msg);
			
			$_SESSION['config_texts'] = $this->configmodel->get_config_texts();
			
			return array('error' => false, 
						 'message' => 'Content deleted successfully',
						 'data'=> $this->get_texts(), 
						 'token' => $this->security->get_csrf_hash());
		}
		else {
			return array('error' => true, 
						 'message' => 'Content deletion failed',
						 'data'=> $this->get_texts(), 
						 'token' => $this->security->get_csrf_hash());
		}			
	}
	
	function convert_seat($from, $to){
		$s_tbl = 'mast_seats';
		$avl_seats	=	'seats_available';

		$this->db->select($from.','.$to .', crs_code,col_code' );
		$this->db->from($avl_seats);
		$this->db->where($from.'>',0);
		$query=	$this->db->get();
		$res	=	$query->result_array();

		foreach($res as $r){
			$sql_cat	=	'UPDATE '.$avl_seats.' SET '.$to.'='.$to.' +'. $r[$from].','. $from.'=  '.$from.' -'. $r[$from].' 
			WHERE col_code="'. $r["col_code"] . '" AND  crs_code="' . $r["crs_code"].'"' ;
			
			
			$sql_cat1	=	'UPDATE '.$s_tbl.' SET '.$to.'='.$to.' +'. $r[$from].','. $from.'=  '.$from.' -'. $r[$from].' 
			WHERE col_code="'. $r["col_code"] . '" AND  crs_code="' . $r["crs_code"] .'"' ;
			

			 
			 
			$this->db->query($sql_cat);
	    	$this->db->query($sql_cat1);
			
		}
		return true;
			
	}
	
	//get college as option
	function get_college($cat) {
		$col_tbl = 'mast_colleges';
		$seat_tbl= 'mast_seats';
		$vac_tbl = 'seats_available';
		$crs_tbl = 'mast_courses';
		
		$this->db->select('col_code,col_short_name as col_name');
		$this->db->from($col_tbl);
		$this->db->where('is_delete', 0);
		$this->db->like('col_show_cat', $cat, 'both'); 
		$this->db->order_by('col_order_by', 'ASC');
		$this->db->order_by('col_code', 'ASC');
		$query1 = $this->db->get();        
		$r= $query1->result();
		//print_r($r);exit();
 		// echo $this->db->last_query();exit();

		$this->db->select('sl,crs_dept,crs_name,crs_course');
		$this->db->from($crs_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('sl', 'ASC');

		$query2 = $this->db->get();        
		$r1= $query2->result();
		$seats	= array();
		for($i=0; $i<count($r); $i++) {
			$seats[$i]= array(
				'col_code' => $r[$i]->col_code,
				'col_name' => $r[$i]->col_name,
 			);
			
            for($j=0 ;$j<count($r1); $j++){
    			$sql = "SELECT SUM(cat_".$cat.") as c FROM " . $vac_tbl . " WHERE col_code =".$r[$i]->col_code." AND crs_code=".$r1[$j]->crs_course ;
    	        $d = $this->db->query($sql)->row();
     			$seats[$i][$r1[$j]->crs_dept]=($d->c=='')?'0':$d->c;
           }
 		}
 		
		//print_r($seats);exit();
 		return $seats; 

	}
	
	//get college as option
	function st_seat($type) {
		$col_tbl = 'mast_colleges';
		$seat_tbl= 'mast_seats';
		$vac_tbl = 'seats_available';
		$crs_tbl = 'mast_courses';
		$cat='st';
		
		$this->db->select('col_code,col_short_name as col_name');
		$this->db->from($col_tbl);
		$this->db->where('is_delete', 0);
		
		$this->db->where_in('col_type',$type);
		$this->db->like('col_show_cat', $cat, 'both'); 
		$this->db->order_by('col_order_by', 'ASC');
		$this->db->order_by('col_code', 'ASC');
		$query1 = $this->db->get();        
		$r= $query1->result();
		//print_r($r);exit();
 //       echo $this->db->last_query();exit();

		$this->db->select('sl,crs_dept,crs_name,crs_course');
		$this->db->from($crs_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('sl', 'ASC');

		$query2 = $this->db->get();        
		$r1= $query2->result();
		$seats	= array();
		for($i=0; $i<count($r); $i++) {
			$seats[$i]= array(
				'col_code' => $r[$i]->col_code,
				'col_name' => $r[$i]->col_name,
 			);
			
            for($j=0 ;$j<count($r1); $j++){
    			$sql = "SELECT SUM(cat_".$cat.") as c FROM " . $vac_tbl . " WHERE col_code =".$r[$i]->col_code." AND crs_code=".$r1[$j]->crs_course ;
    	        $d = $this->db->query($sql)->row();
     			$seats[$i][$r1[$j]->crs_dept]=($d->c=='')?'0':$d->c;
           }
 		}
 		
 		return $seats; 

	}

	//get college as option
	function get_college_all_cat() {
		$col_tbl = 'mast_colleges';
		//$seat_tbl= 'mast_seats';
		$vac_tbl = 'seats_available';
		$crs_tbl = 'mast_courses';
		
		$this->db->select('col_code,col_name,col_type, col_show_cat');
		$this->db->from($col_tbl);
		$this->db->where('is_delete', 0);
		$this->db->where('col_type','Pvt');
		//$this->db->like('col_show_cat', $cat, 'both'); 
		$this->db->order_by('col_name', 'ASC');
		//$this->db->order_by('col_code', 'ASC');
		$query1 = $this->db->get();        
		$r= $query1->result();
		//print_r($r);exit();
 		// echo $this->db->last_query();exit();

		$this->db->select('sl,crs_dept,crs_name,crs_course');
		$this->db->from($crs_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('sl', 'ASC');

		$query2 = $this->db->get();        
		$r1= $query2->result();
		$seats	= array();
		for($i=0; $i<count($r); $i++) {
			$cat_str	=	$r[$i]->col_show_cat;
			$cat_arr	=	explode("||", $cat_str);
			 //$cat='st';
		
			 foreach($cat_arr as $cat){ 
				$college_cat_seats	=	0;
				 //print_r($cat);exit;
					$element_no	=	count($seats);

					$cat_type_arr     =   array(
						'ge'    => 'GENERAL',
						'st'    =>  'ST',
						'sc'    =>  'SC',
						'oa'    =>  'OBC-A',
						'ob'    =>  'OBC-B',
						'pw'    =>  'PH',
						'ews'   =>  'EWS'

						);
					$cat_name=$cat_type_arr[$cat];
					$seats[$element_no]= array(
						'col_code' => $r[$i]->col_code,
						'col_name' => $r[$i]->col_name,
						'col_type' => $r[$i]->col_type,
						'cat'		=>	$cat_name
					);
					
					for($j=0 ;$j<count($r1); $j++){
									
						$sql = "SELECT SUM(cat_".$cat.") as c FROM " . $vac_tbl . " WHERE col_code =".$r[$i]->col_code." AND crs_code=".$r1[$j]->crs_course ;

						
						$d = $this->db->query($sql)->row();
						$cat_seat_count	=	($d->c=='')?'0':$d->c;
						
						$seats[$element_no][$r1[$j]->crs_dept]	=	$cat_seat_count;
						$college_cat_seats+=$cat_seat_count;
					}
					//if()
					if($college_cat_seats==0){
					//	unset($seats[$element_no]);
					}
					
				}
		
 		}
 		//echo "<pre>";
		//print_r($seats);exit();
 		return $seats; 

	}

	//get college as option for single cat
	function get_college_single_cat($cat_type='ge') {
		$screen = '';
		if($cat_type=='ge_govt_esi'){
			$cat='ge';
			$clg_type=array('Govt','Affi. Inst');
		}
		
		else if($cat_type=='ge_pvt-1'){
			$cat='ge';
			$clg_type=array('Pvt');
			$screen = 1;
		}else if($cat_type=='ge_pvt-2'){
			$cat='ge';
			$clg_type=array('Pvt');
			$screen = 2;
		}else if($cat_type=='ge_pvt-3'){
			$cat='ge';
			$clg_type=array('Pvt');
			$screen = 3;
		}else if($cat_type=='ge_pvt-4'){
			$cat='ge';
			$clg_type=array('Pvt');
			$screen = 4;
		}
		
		else if($cat_type=='ge_govt'){
			$cat='ge';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='ge_esi'){
			$cat='ge';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='ews_govt'){
			$cat='ews';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='ews_esi'){
			$cat='ews';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='sc_govt'){
			$cat='sc';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='sc_esi'){
			$cat='sc';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='st_govt'){
			$cat='st';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='st_esi'){
			$cat='st';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='oa_govt'){
			$cat='oa';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='oa_esi'){
			$cat='oa';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='ob_govt'){
			$cat='ob';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='ob_esi'){
			$cat='ob';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}

		else if($cat_type=='pw_govt'){
			$cat='pw';
			$clg_type=array('Govt');
			$screen = '';
		}else if($cat_type=='pw_esi'){
			$cat='pw';
			$clg_type=array('Affi. Inst');
			$screen = '';
		}
		
		else{
			$cat=$cat_type;
			$clg_type=array();
			$screen = '';
		}
		$clg_type_count =  count($clg_type);

		$col_tbl = 'mast_colleges';
		//$seat_tbl= 'mast_seats';
		$vac_tbl = 'seats_available';
		$crs_tbl = 'mast_courses';
		
		$this->db->select('col_code,col_name,col_type, col_show_cat,clg_sl_for_screen');
		$this->db->from($col_tbl);
		$this->db->where('is_delete', 0);

		if($clg_type_count>0){
			$this->db->where_in('col_type',$clg_type);
		}

		if($screen !=''){
			$this->db->where('col_order_by_screen',$screen);
		}
		
		$this->db->like('col_show_cat', $cat, 'both'); 
		$this->db->order_by('col_name', 'ASC');
		//$this->db->order_by('col_code', 'ASC');
		$query1 = $this->db->get();        
		$r= $query1->result();
		//print_r($r);exit();
 		// echo $this->db->last_query();exit();

		$this->db->select('sl,crs_dept,crs_name,crs_course');
		$this->db->from($crs_tbl);
		$this->db->where('is_delete', 0);
		$this->db->order_by('sl', 'ASC');

		$query2 = $this->db->get();        
		$r1= $query2->result();
		$seats	= array();
		for($i=0; $i<count($r); $i++) {
			
				$college_cat_seats	=	0;
				 //print_r($cat);exit;
					$element_no	=	count($seats);

					$cat_type_arr     =   array(
						'ge'    => 'GENERAL',
						'st'    =>  'ST',
						'sc'    =>  'SC',
						'oa'    =>  'OBC-A',
						'ob'    =>  'OBC-B',
						'pw'    =>  'PH',
						'ews'   =>  'EWS'
						);
					$cat_name=$cat_type_arr[$cat];
					$seats[$element_no]= array(
						'col_code' => $r[$i]->col_code,
						'col_name' => $r[$i]->col_name,
						'col_type' => $r[$i]->col_type,
						'col_sl_screen' => $r[$i]->clg_sl_for_screen,
						'cat'		=>	$cat_name
					);
					
					for($j=0 ;$j<count($r1); $j++){
									
						$sql = "SELECT SUM(cat_".$cat.") as c FROM " . $vac_tbl . " WHERE col_code =".$r[$i]->col_code." AND crs_code=".$r1[$j]->crs_course ;

						
						$d = $this->db->query($sql)->row();
						$cat_seat_count	=	($d->c=='')?'0':$d->c;
						
						$seats[$element_no][$r1[$j]->crs_dept]	=	$cat_seat_count;
						$college_cat_seats+=$cat_seat_count;
					}
					//if()
					
					$seats[$element_no]['tot_seats']	=	$college_cat_seats;
					
					if($college_cat_seats==0){
						unset($seats[$element_no]);
					}
					
				
 		}
 		//echo "<pre>";
		//print_r($seats);exit();
 		return $seats; 

	}

	//get all clg by crs
	function GetSearchdata($crs_code, $category) {
		$c_tbl = 'mast_colleges';
		$s_tbl = 'seats_available';
		$crs_table = 'mast_courses';

		$cat_seats	=	'cat_' . strtolower($category);
		
		$this->db->select('s.sl AS seat_sl, s.col_code AS col_code, col_name, 
							s.crs_code AS crs_code, crs_course, crs_dept, crs.crs_name, ' . 
							$cat_seats . ' as seats
							', false);
		$this->db->from($s_tbl . ' AS s');
		$this->db->join($c_tbl . ' AS c', 'c.col_code = s.col_code', 'LEFT OUTER');
		$this->db->join($crs_table . ' AS crs', 'crs.sl = s.crs_code', 'LEFT OUTER');
		$this->db->where($cat_seats .'>', 0);
		$this->db->where('s.crs_code' , $crs_code);
		$this->db->where('c.is_delete', 0);
		$this->db->where('s.is_delete', 0);
		$this->db->order_by('col_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	//get all clg by clg
	function GetSearchdata_college($clg_code, $category) {
		$c_tbl = 'mast_colleges';
		$s_tbl = 'seats_available';
		$crs_table = 'mast_courses';

		$cat_seats	=	'cat_' . strtolower($category);
		
		$this->db->select('s.sl AS seat_sl, s.col_code AS col_code, col_name, 
							s.crs_code AS crs_code, crs_course, crs_dept, crs_name, ' . 
							$cat_seats . ' as seats
							', false);
		$this->db->from($s_tbl . ' AS s');
		$this->db->join($c_tbl . ' AS c', 'c.col_code = s.col_code', 'LEFT OUTER');
		$this->db->join($crs_table . ' AS crs', 'crs.sl = s.crs_code', 'LEFT OUTER');
		$this->db->where($cat_seats .'>', 0);
		$this->db->where('s.col_code' , $clg_code);
		$this->db->where('c.is_delete', 0);
		$this->db->where('s.is_delete', 0);
		$this->db->order_by('col_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	


	



}