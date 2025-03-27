<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends Aranax
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('Aranax_Auth');
		$this->load->helper('aranax');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('configmodel');
		$this->load->model('reportmodel');
	}

	//activity log of a user
	function activity_log($user_name = null)
	{
		//$this->output->enable_profiler(TRUE);
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			//redirect("unauthorised");
		}

		$user_log = ($user_name == null) ? $_SESSION['AX_username'] : $user_name;

		$data['activities'] = $this->reportmodel->get_activities($user_log);

		$data["active_link"]	=	"reports";
		$data["page_title"]	=	"Report - User Activity Log";
		$this->load->view("common/header", $data);
		$this->load->view("reports/activity_log", $data);
	}

	//seat available
	function seat_availability($type)
	{
		$data["active_link"]	=	"seat";
		$data["page_title"]		=	"Seat Available";
		$data["type"]		=	$type;
		$this->load->view("common/header", $data);
		$this->load->view("reports/seat_available", $data);
	}

	//get college available 
	function get_college_available()
	{
		$col_type = $_GET['col_type'];

		echo json_encode($this->configmodel->get_colleges($col_type));
	}

	//get seat available data
	function get_seat_available()
	{
		$col_code = $_GET['col_code'];
		echo json_encode($this->reportmodel->get_seat_available($col_code));
	}


	//reports seat status
	function seat_status()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			//redirect("unauthorised");
		}

		$data['category_option'] = $this->configmodel->get_allotment_category_option();

		$data["active_link"]	=	"reports";
		$data["page_title"]	=	"Report - Seat Status";
		$this->load->view("common/header", $data);
		$this->load->view("reports/seat_status", $data);
	}

	//get seat status
	function get_seatstatus()
	{
		echo json_encode(array('data' => $this->reportmodel->get_seat_status()));
	}

	//reports rank
	function rank()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			//redirect("unauthorised");
		}

		$data["active_link"]	=	"reports";
		$data["page_title"]	=	"Report - Rank";
		$this->load->view("common/header", $data);
		$this->load->view("reports/rank", $data);
	}

	//get ranks
	function get_ranks()
	{
		echo json_encode(array('data' => $this->reportmodel->get_rank()));
	}

	function college_wise_students()
	{
		$result = $this->reportmodel->college_wise_report();

		$data['result'] = $result;
		$data['page_title']	=	'College wise Report';
		$data["active_link"]	=	"report";

		$this->load->view("common/header", $data);

		$this->load->view("reports/college_wise_report", $data);
	}

	function college_wise_report_dump($college_code)
	{

		$data = $this->reportmodel->candidateByallclg_xls($college_code);

		$clg_name = $data[0]['col_name'];


		//$filename = "SMF_clg_wise_report" . date('YmdHis'). ".xls";
		$filename = "SMF_" . $clg_name . date('YmdHis') . ".xls";

		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($data)) {
			foreach ($data as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();
	}


	function college_wise_report_dump_all()
	{

		$data = $this->reportmodel->candidateByclg_xls();

		//$filename = "SMF_clg_wise_report" . date('YmdHis'). ".xls";
		$filename = "SMF_college_wise_alloted" . date('YmdHis') . ".xls";

		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$isPrintHeader = false;
		if (! empty($data)) {
			foreach ($data as $row) {
				if (! $isPrintHeader) {
					echo implode("\t", array_keys($row)) . "\n";
					$isPrintHeader = true;
				}
				echo implode("\t", array_values($row)) . "\n";
			}
		}
		exit();
	}

	//seat available
	function seat($cat)
	{
		$data["active_link"]	=	"seat";
		$data["page_title"]		=	"Seat Available";
		$data['Type']           =    $cat;

		$data["college"] = $this->configmodel->get_college($cat);


		$this->load->view("common/header", $data);
		$this->load->view("reports/seat", $data);
	}


	function st_seats()
	{
		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Seat Allotment";

		$data["st_govt"] = $this->configmodel->st_seat(array('Govt'));
		$data["st_pvt"] = $this->configmodel->st_seat(array('Esi'));

		$this->load->view("common/header", $data);
		$this->load->view("reports/seat-st", $data);
	}

	// all college all cast view seats

	function all_cat_seats()
	{
		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Seat Allotment";

		$this->load->view("common/header", $data);
		$this->load->view("reports/seats_all_cat", $data);
	}

	//get seat status all
	function get_seat_data_all()
	{
		echo json_encode(array('data' => $this->configmodel->get_college_all_cat()));
	}

	//get seat status single
	function cat_seats_for_single($cat)
	{
		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Seat Allotment";
		$data["category"]		=	$cat;

		$this->load->view("common/header", $data);
		$this->load->view("reports/seats_single_cat", $data);
	}


	function get_seat_data_for_single()
	{
		$cat = $_GET['category'];
		echo json_encode(array('data' => $this->configmodel->get_college_single_cat($cat)));
	}

	// course wise seats

	function search_course_seats($crs_code = null, $category = null)
	{

		//$college_code    =   $_GET['college_code'];
		$crs_code    =   $_GET['crs_code'];
		$category   =   $_GET['category'];

		$data['all_details'] = null;
		if ($category != '') {
			$data['all_details']  =  $this->configmodel->GetSearchdata($crs_code, $category);
		}
		//print_r($data['all_details']);exit;

		//$data["college_options"] = $this->configmodel->get_college_options();
		$data["course_name_options"] = $this->configmodel->get_course_name_options();
		$data["allot_category_options"] = $this->configmodel->get_allotment_category_option();

		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Seat Allotment";

		$data["crs_code"]  	=	$crs_code;
		$data["category"]  	=	$category;

		$this->load->view("common/header", $data);
		$this->load->view("reports/search_course_seats", $data);
	}

	function search_clg_seats($clg_code = null, $category = null)
	{

		//$college_code    =   $_GET['college_code'];
		$clg_code    =   $_GET['clg_code'];
		$category   =   $_GET['category'];

		$data['all_details'] = null;
		if ($category != '') {
			$data['all_details']  =  $this->configmodel->GetSearchdata_college($clg_code, $category);
		}
		//print_r($data['all_details']);exit;

		$data["college_options"] = $this->configmodel->get_college_options();
		//$data["course_name_options"] = $this->configmodel->get_course_name_options();
		$data["allot_category_options"] = $this->configmodel->get_allotment_category_option();

		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Seat Allotment";

		$data["clg_code"]  	=	$clg_code;
		$data["category"]  	=	$category;

		$this->load->view("common/header", $data);
		$this->load->view("reports/search_clg_seats", $data);
	}

	// all college all cast view seats for candidate

	function all_cat_seats_for_candidate()
	{
		//redirect("http://smfwb.in/");
		$data["active_link"]	=	"counsel";
		$data["page_title"]	=	"Updated Seat Matrix";

		$this->load->view("common/header_student", $data);
		$this->load->view("reports/seats_all_cat", $data);
	}

	function seatsbls()
	{

		$data['stats'] = $this->reportmodel->get_dashbaord_stats();

		$data['statsbls'] = $this->reportmodel->get_seatsbls();;

		$data["active_link"]	=	"dashboard";
		$data["page_title"]	=	"Dashboard";
		$this->load->view("common/header", $data);
		$this->load->view("user/dashboard_adm", $data);
	}
}