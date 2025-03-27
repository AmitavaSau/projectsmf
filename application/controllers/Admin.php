<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends Aranax
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('file_helper');
		$this->load->model('adminmodel');
	}

	function index() {}

	public function change_college_password()
	{
		$data['clg_users'] = $this->adminmodel->get_clgUsers();
		$data["page_title"]	=	"College Password Change";

		$this->load->view("common/header", $data);
		$this->load->view("admin/list_user_college", $data);
	}

	public function updatePassword()
	{
		$id = $this->input->post('id');
		$newPassword = $this->input->post('password');


		$this->adminmodel->updatePassword($id, $newPassword);
		echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
	}

	function listCourse()
	{
		// echo 'ok';exit();

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}
		$college_code = $this->session->userdata('AX_user_firstname');
		//$data['cand_type'] = $_SESSION['AX_user_type']; 
		//echo '<pre>'; print_r($_SESSION); exit();
		//print_r($college_code); exit();

		$data['all_candidate'] = '';
		$data["active_link"]	=	"candidates";
		$data["page_title"]	=	"ALLOTED CANDIDATE";

		$data['college_result'] = $this->adminmodel->candidateByCourse($college_code);
		$data["college_name"]    = $this->adminmodel->get_college_name($college_code);
		//print_r($data['college_result']);exit();
		$this->load->view("common/header", $data);
		$this->load->view("admin/list_course_college", $data);
	}


	function update_clg_report()
	{
		$appl_reg_num	=	$_REQUEST['appl_reg_num'];
		$report	=	$_REQUEST['report'];
		$response	=	$this->adminmodel->update_clg_report($appl_reg_num, $report);
		echo json_encode(array(
			'data' => $response,
			'token' => $this->security->get_csrf_hash()
		));
	}

	function download_statement_preliminary()
	{
		$filename = "Marks_Statement_Preliminary_" . date('Ymdhis') . ".csv";
		$data = $this->adminmodel->download_statement_preliminary($filename);;
	}

	function download_statement_final()
	{
		$filename = "Marks_Statement_Final_" . date('Ymdhis') . ".csv";
		$data = $this->adminmodel->download_statement_Final($filename);;
	}


	function download_student_marks_preliminary()
	{
		$filename = "Student_Marks_Preliminary_" . date('Ymdhis') . ".csv";
		$data = $this->adminmodel->download_student_marks_preliminary($filename);;
	}

	function download_student_marks_final()
	{
		$filename = "Student_Marks_Final_" . date('Ymdhis') . ".csv";
		$data = $this->adminmodel->download_student_marks_final($filename);;
	}
}