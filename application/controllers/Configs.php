<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configs extends Aranax {

	function __construct() {
		parent::__construct();
		
		$this->load->library('Aranax_Auth');
		$this->load->helper('aranax');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('configmodel');
	}
	
/***************************
COLLEGE RELATED FUNCTIONS
***************************/	
	
	//list of colleges
	function colleges() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() ) {
			//redirect("unauthorised");
		}
		
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"College Master";
		$this->load->view("common/header", $data);
		$this->load->view("configs/colleges", $data);
	}
	
	//get colleges
	function get_colleges() {
		echo json_encode($this->configmodel->get_colleges());
	}
	
	//save college
	function save_college() {
		$col_code		= $_POST['col_code'];
		$col_sl			= $_POST['col_sl'];
		$col_name 		= $_POST['col_name'];
		$col_address 	= $_POST['col_address'];
		$action 		= $_POST['action'];
		
		echo json_encode($this->configmodel->save_college($col_code, $col_name, 
														$col_address, $col_sl, $action));
	}

	//delete college
	function delete_college() {
		$col_sl	= $_POST['col_sl'];
		echo json_encode($this->configmodel->delete_college($col_sl));
	}

/***************************
COURSE RELATED FUNCTIONS
***************************/
	//list of courses
	function courses() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() 			) {
			//redirect("unauthorised");
		}
		
		$data["course_options"] = $this->configmodel->get_course_options();
		
		$data["active_link"]	=	"configs";
		$data["page_title"]		=	"Course Master";
		$this->load->view("common/header", $data);
		$this->load->view("configs/courses", $data);
	}
	
	//get courses
	function get_courses() {
		echo json_encode($this->configmodel->get_courses());
	}
	
	//save course
	function save_course() {
		$crs_sl			= $_POST['crs_sl'];
		$crs_course		= $_POST['crs_course'];
		$crs_dept		= $_POST['crs_dept'];
		$crs_name 		= $_POST['crs_name'];
		$action 		= $_POST['action'];
		
		echo json_encode($this->configmodel->save_course($crs_course, $crs_dept, $crs_name, 
														 $crs_sl, $action));
	}
	
	//delete course
	function delete_course() {
		$crs_sl	= $_POST['crs_sl'];
		echo json_encode($this->configmodel->delete_course($crs_sl));
	}


/***************************
SEAT RELATED FUNCTIONS
***************************/
	//list of seats
	function seats() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() ) {
			//redirect("unauthorised");
		}
		
		$data["college_options"] = $this->configmodel->get_college_options();
		$data["course_options"] = $this->configmodel->get_course_options();
		$data["course_name_options"] = $this->configmodel->get_course_name_options();
		
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"Seat Master";
		$this->load->view("common/header", $data);
		$this->load->view("configs/seats", $data);
	}
	
	//get seats
	function get_seats() {
		echo json_encode($this->configmodel->get_seats());
	}
	
	//save seat
	function save_seat() {
		$col_code	= $_POST['col_code'];
		$seat_sl	= $_POST['seat_sl'];
		$crs_code 	= $_POST['crs_code'];
		$crs_name 	= $_POST['crs_name'];
		$cat_ge 	= $_POST['cat_ge'];
		$cat_sc 	= $_POST['cat_sc'];
		$cat_st 	= $_POST['cat_st'];
		$cat_oa 	= $_POST['cat_oa'];
		$cat_ob 	= $_POST['cat_ob'];
		$cat_pw		= $_POST['cat_pw'];
		/*$cat_sp_ge	= $_POST['cat_sp_ge'];
		$cat_sp_sc	= $_POST['cat_sp_sc'];*/
		$action 	= $_POST['action'];
		
		echo json_encode($this->configmodel->save_seat($col_code, $crs_code, $crs_name,  
														$cat_ge, $cat_sc, $cat_st, 
														$cat_oa, $cat_ob, $cat_pw, 
														 
														$seat_sl, $action));
	}
	
	//delete seats
	function delete_seat() {
		$seat_sl	= $_POST['seat_sl'];
		echo json_encode($this->configmodel->delete_seat($seat_sl));
	}	

/***************************
STUDENT RELATED FUNCTIONS
***************************/
	//list of students
	function students() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() ) {
			//redirect("unauthorised");
		}
		
		$data["category_options"] = $this->configmodel->get_category_option();
		
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"Student Master";
		$this->load->view("common/header", $data);
		$this->load->view("configs/students", $data);
	}
	
	//get students
	function get_students() {
		echo json_encode(array('data' => $this->configmodel->get_students()));
	}
	
	//save students
	function save_student() {
		$appl_sl		= $_POST['appl_sl'];
		$appl_roll_num	= $_POST['appl_roll_num'];
		$appl_form_num	= $_POST['appl_form_num'];
		$appl_fullname 	= $_POST['appl_fullname'];
		$appl_fathername= $_POST['appl_fathername'];
		$appl_category 	= $_POST['appl_category'];
		$appl_dob		= $_POST['appl_dob'];
		$action 		= $_POST['action'];
		
		echo json_encode($this->configmodel->updateStudents($appl_sl,$appl_roll_num, 
								/*$appl_form_num,*/ $appl_fullname, $appl_fathername, 
								$appl_category, $appl_dob, $action));
	}
	
	//delete students
	function delete_student() {
		$appl_sl	= $_POST['appl_sl'];
		echo json_encode($this->configmodel->delete_student($appl_sl));
	}
	
/***************************
TEXT RELATED FUNCTIONS
***************************/
	//list of texts
	function texts() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() ) {
			//redirect("unauthorised");
		}
		
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"Content Master";
		$this->load->view("common/header", $data);
		$this->load->view("configs/texts", $data);
	}
	
	//get text
	function get_texts() {
		echo json_encode($this->configmodel->get_texts());
	}
	
	//save text
	function save_text() {
		$conf_name	= $_POST['conf_name'];
		$conf_value	= $_POST['conf_value'];
		$conf_sl 	= $_POST['conf_sl'];
		$action 	= $_POST['action'];
		
		echo json_encode($this->configmodel->save_text($conf_name, $conf_value, $conf_sl, $action));
	}
	
	//delete text
	function delete_text() {
		$conf_sl	= $_POST['conf_sl'];
		echo json_encode($this->configmodel->delete_text($conf_sl));
	}
	
	function seat_revise() {
		if ( !$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access() ) {
			//redirect("unauthorised");
		}
		
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"Seat Revise";
		$this->load->view("common/header", $data);
		$this->load->view("configs/seat_revise", $data);
	}

	function convert_seat(){

		//print_r($_GET);
		$from	=	$_GET['from'];
		$to	=	$_GET['to'];
		
		echo json_encode($this->configmodel->convert_seat($from, $to));
	
	}
	
	



}	