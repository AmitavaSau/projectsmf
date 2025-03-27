<?php
defined('BASEPATH') or exit('No direct script access allowed');

class examMarks extends Aranax
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('file_helper');
		$this->load->model('examMarksmodel');
	}

	function index() {}

	public function student_marks_show()
	{
		$data['marks_type']   =   array(
			'' => '--Select--',
			'PRELIMINARY'   =>  'PRELIMINARY',
			'FINAL'    =>   'FINAL'
		);
		$this->load->view('exam/student_form', $data);
	}

	public function student_verifyDetails()
	{
		$marks_type = $this->input->post('marks_type');
		$username = $this->input->post('username');
		$cand_dob_login = $this->input->post('cand_dob_login');

		$tbl_name = "student_marks_pre";
		$urlpdf = "";

		if ($marks_type == "PRELIMINARY") {
			$tbl_name = "student_marks_pre";
			$urlpdf = "examMarks/download_marks_student_pre/";
		} else if ($marks_type == "FINAL") {
			$tbl_name = "student_marks_final";
			$urlpdf = "examMarks/download_marks_student_final/";
		}

		$this->db->where('std_code', $username);
		$this->db->where('std_dob', $cand_dob_login);
		$query = $this->db->get($tbl_name); // Replace with your actual table name

		if ($query->num_rows() > 0) {
			$user = $query->row();

			// Generate the download URLs based on active status
			$download_url = base_url($urlpdf . $username);
			$name = $user->std_name;

			echo json_encode([
				'valid' => true,
				'download_url' => $download_url,
				'name' => $name
			]);
		} else {
			echo json_encode(['valid' => false]);
		}
	}

	function download_marks_student_final($userId)
	{
		$this->examMarksmodel->download_marks_student_final($userId);
		$filepath = "upload/marks_document_final/" . $userId . ".pdf";
		$file_name =   "SMF_FINAL_MARKS_" . $userId . ".pdf";
		/* echo $file_name;
		exit; */
		// Process download
		if (file_exists($filepath)) {
			echo "a";
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename = "' . $file_name . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush(); // Flush system output buffer
			readfile($filepath);
			die();
		} else {
			echo "b";
			http_response_code(404);
			die();
		}
	}

	function download_marks_student_pre($userId)
	{
		$this->examMarksmodel->download_marks_student_pre($userId);
		$filepath = "upload/marks_document_pre/" . $userId . ".pdf";
		$file_name =   "SMF_PRE_MARKS_" . $userId . ".pdf";
		/* echo $file_name;
		exit; */
		// Process download
		if (file_exists($filepath)) {
			echo "a";
			//exit;
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename = "' . $file_name . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush(); // Flush system output buffer
			readfile($filepath);
			die();
		} else {
			echo "b";
			http_response_code(404);
			die();
		}
	}

	function marks_entry_preliminary($inst_code = null, $course_name = null, $cand_paper = null, $cand_paper_seg = null)
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$inst_code    =   $_GET['inst_code'];
		$course_name   =   $_GET['course_name'];
		$cand_paper   =   $_GET['cand_paper'];
		$cand_paper_seg   =   $_GET['cand_paper_seg'];

		$data["inst_code"]  	=	$inst_code;
		$data["course_name"]  	=	$course_name;
		$data["cand_paper"]  	=	$cand_paper;
		$data["cand_paper_seg"]  	=	$cand_paper_seg;


		$college_code = $this->session->userdata('AX_user_firstname');

		$data['all_candidate'] = '';
		$data["active_link"]	=	"candidates";
		$data["page_title"]	=	"Student";

		$data['college'] = $this->examMarksmodel->college($college_code);
		$data['course'] = $this->examMarksmodel->course();
		$data['paper'] = $this->examMarksmodel->paper();
		$data['paper_segments'] = $this->examMarksmodel->paper_segments();

		$data['all_detail'] = $this->examMarksmodel->get_candidates_preliminary($inst_code, $course_name, $cand_paper, $cand_paper_seg);

		// echo "<pre>";
		// print_r($data['all_detail']);
		// exit();
		$this->load->view("common/header", $data);
		$this->load->view("exam/marks_entry_preliminary", $data);
	}


	public function marks_save_preliminary()
	{

		$cand_marks_opt = $this->input->post('cand_marks_opt');
		if ($cand_marks_opt != '') {
			$cand_marks_opt = number_format((float)$cand_marks_opt, 2, '.', '');
		}


		$data = [
			'cand_paper' => $this->input->post('cand_paper'),
			'cand_paper_seg' => $this->input->post('cand_paper_seg'),
			'cand_marks_opt' => $cand_marks_opt,
			'cand_marks_remarks' => $this->input->post('cand_marks_remarks'),
			'pre_cand_code' => $this->input->post('pre_cand_code'),
		];

		$result = $this->examMarksmodel->save_or_update_marks_preliminary($data);

		if ($result) {
			echo json_encode(['status' => 'success', 'message' => 'Submitted successfully!']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to submit data.']);
		}
	}

	function download_report_preliminary($inst_code = null, $course_name = null, $cand_paper = null, $cand_paper_seg = null)
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$inst_code    =   $_GET['inst_code'];
		$course_name   =   $_GET['course_name'];
		$cand_paper   =   $_GET['cand_paper'];
		$cand_paper_seg   =   $_GET['cand_paper_seg'];

		$paper = $this->examMarksmodel->paper();
		$paper_segments = $this->examMarksmodel->paper_segments();

		$data['cand_paper'] = isset($paper[$cand_paper]) ? $paper[$cand_paper] : " ";
		$data['cand_paper_seg'] = isset($paper_segments[$cand_paper_seg]) ? $paper_segments[$cand_paper_seg] : " ";



		$data['result'] = $this->examMarksmodel->get_candidates_preliminary($inst_code, $course_name, $cand_paper, $cand_paper_seg);

		/* print_r($data['cand_paper_seg']);
		exit(); */

		$this->load->library('Pdf');

		$html = $this->load->view('pdf/download_report_preliminary', $data, true);
		$dompdf = new Pdf();
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->load_html($html);
		$dompdf->render();
		$output = $dompdf->output();
		$this->load->helper('download');
		force_download('PRELIMINARY_REPORT-' . ($inst_code) . '.pdf', $output);
	}

	//FOR FINAL

	function marks_entry_final($inst_code = null, $course_name = null, $cand_paper = null, $cand_paper_seg = null)
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$inst_code    =   $_GET['inst_code'];
		$course_name   =   $_GET['course_name'];
		$cand_paper   =   $_GET['cand_paper'];
		$cand_paper_seg   =   $_GET['cand_paper_seg'];

		$data["inst_code"]  	=	$inst_code;
		$data["course_name"]  	=	$course_name;
		$data["cand_paper"]  	=	$cand_paper;
		$data["cand_paper_seg"]  	=	$cand_paper_seg;


		$college_code = $this->session->userdata('AX_user_firstname');

		$data['all_candidate'] = '';
		$data["active_link"]	=	"candidates";
		$data["page_title"]	=	"Student";

		$data['college'] = $this->examMarksmodel->college($college_code);
		$data['course'] = $this->examMarksmodel->course();
		$data['paper'] = $this->examMarksmodel->paper();
		$data['paper_segments'] = $this->examMarksmodel->paper_segments();

		$data['all_detail'] = $this->examMarksmodel->get_candidates_final($inst_code, $course_name, $cand_paper, $cand_paper_seg);

		// echo "<pre>";
		// print_r($data['all_detail']);
		// exit();
		$this->load->view("common/header", $data);
		$this->load->view("exam/marks_entry_final", $data);
	}


	public function marks_save_final()
	{

		$cand_marks_opt = $this->input->post('cand_marks_opt');
		if ($cand_marks_opt != '') {
			$cand_marks_opt = number_format((float)$cand_marks_opt, 2, '.', '');
		}

		$data = [
			'cand_paper' => $this->input->post('cand_paper'),
			'cand_paper_seg' => $this->input->post('cand_paper_seg'),
			'cand_marks_opt' => $cand_marks_opt,
			'cand_marks_remarks' => $this->input->post('cand_marks_remarks'),
			'pre_cand_code' => $this->input->post('pre_cand_code'),
		];

		$result = $this->examMarksmodel->save_or_update_marks_final($data);

		if ($result) {
			echo json_encode(['status' => 'success', 'message' => 'Submitted successfully!']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to submit data.']);
		}
	}

	function download_report_final($inst_code = null, $course_name = null, $cand_paper = null, $cand_paper_seg = null)
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$inst_code    =   $_GET['inst_code'];
		$course_name   =   $_GET['course_name'];
		$cand_paper   =   $_GET['cand_paper'];
		$cand_paper_seg   =   $_GET['cand_paper_seg'];

		$paper = $this->examMarksmodel->paper();
		$paper_segments = $this->examMarksmodel->paper_segments();

		$data['cand_paper'] = isset($paper[$cand_paper]) ? $paper[$cand_paper] : " ";
		$data['cand_paper_seg'] = isset($paper_segments[$cand_paper_seg]) ? $paper_segments[$cand_paper_seg] : " ";



		$data['result'] = $this->examMarksmodel->get_candidates_final($inst_code, $course_name, $cand_paper, $cand_paper_seg);

		/* print_r($data['cand_paper_seg']);
		exit(); */

		$this->load->library('Pdf');

		$html = $this->load->view('pdf/download_report_final', $data, true);
		$dompdf = new Pdf();
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->load_html($html);
		$dompdf->render();
		$output = $dompdf->output();
		$this->load->helper('download');
		force_download('FINAL_REPORT-' . ($inst_code) . '.pdf', $output);
	}

	function institute_details()
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$data['cand_details']	=	$this->examMarksmodel->get_college_details($_SESSION['AX_user_firstname']);

		$data['dist_drp'] = $this->examMarksmodel->get_dist_drp();

		$data['exam_drp'] = array(
			'' => '--Select--',
			'Preliminary' => 'Preliminary',
			'Final' => 'Final'
		);

		$data['type_drp'] = array(
			'' => '--Select--',
			'Internal' => 'Internal',
			'External' => 'External'
		);

		$data['course'] = $this->examMarksmodel->course();



		$data["active_link"]	=	"Edit";
		$data["page_title"]	=	"Centre-in-charge and Examiners Details";
		$this->load->view("common/header", $data);
		$this->load->view("exam/institute_details", $data);
	}

	function institute_details_save()
	{
		$status = $this->examMarksmodel->institute_details_save();
		if ($status) {

			redirect('examMarks/institute_details');
		}
	}

	public function fetch_examiners()
	{

		$college_id = $this->session->userdata('AX_user_firstname');
		if (!$college_id) {
			echo json_encode(['error' => 'Unauthorized access.']);
			return;
		}

		$data = $this->examMarksmodel->get_examiners_by_college($college_id);

		echo json_encode($data);
	}

	public function get_examiner($id)
	{
		$college_id = $this->session->userdata('AX_user_firstname');
		$examiner = $this->examMarksmodel->get_examiner_by_id($id, $college_id);

		if ($examiner) {
			echo json_encode($examiner);
		} else {
			echo json_encode(['error' => 'Data not found or unauthorized.']);
		}
	}

	// Save examiner (Insert or Update)
	public function save_examiner()
	{
		$data = $this->input->post();
		$college_id = $this->session->userdata('AX_user_firstname');

		if (!$college_id) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
			return;
		}

		$data['examiner_clg_code'] = $college_id;
		$result = $this->examMarksmodel->save_examiner($data);
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to save data.']);
		}
	}

	public function delete_examiner($id)
	{
		$college_id = $this->session->userdata('AX_user_firstname');

		if (!$college_id) {
			echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
			return;
		}

		$result = $this->examMarksmodel->delete_examiner($id, $college_id);
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Examiner deleted successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete examiner.']);
		}
	}

	//Exam Schedule

	function examSchedule_preliminary()
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		$data['course_dropdown']	=	$this->examMarksmodel->course_dropdown();

		$data['paper_drp'] = array(
			'' => '--Select--',
			'Paper I' => 'Paper I',
			'Paper II' => 'Paper II',
			'Paper III' => 'Paper III',
			'Paper IV' => 'Paper IV'
		);

		$data["active_link"]	=	"";
		$data["page_title"]	=	"Exam Schedule for Preliminary";
		$this->load->view("common/header", $data);
		$this->load->view("exam/examSchedule_preliminary", $data);
	}

	public function fetch_examSchedule_preliminiary()
	{

		$data = $this->examMarksmodel->get_examSchedule_preliminiary();

		echo json_encode($data);
	}

	public function get_examSchedule_preliminiary($id)
	{

		$exam = $this->examMarksmodel->get_examSchedule_by_id_preliminiary($id);

		if ($exam) {
			echo json_encode($exam);
		} else {
			echo json_encode(['error' => 'Data not found or unauthorized.']);
		}
	}

	// Save examiner (Insert or Update)
	public function save_examSchedule_preliminiary()
	{
		header('Content-Type: application/json');
		$data = $this->input->post();
		$exam_crs_code = $data['exam_crs_code'];
		$exam_paper = $data['exam_paper'];
		$pdf_name = str_replace(' ', '_', $exam_crs_code . "_" . $exam_paper);

		//Check for duplicate (Only during insert, not update)
		if (empty($data['exam_id'])) {
			$this->db->where('exam_crs_code', $exam_crs_code);
			$this->db->where('exam_paper', $exam_paper);
			$existing_record = $this->db->get('tbl_examschedule_preliminary')->row();

			if ($existing_record) {
				echo json_encode(['success' => false, 'message' => 'Duplicate entry! This Course & Paper already exists.']);
				return;
			}
		}

		if (!empty($data['exam_id']) && !empty($_FILES['exam_pdf']['name'])) {
			$this->db->select('exam_pdf');
			$this->db->where('exam_id', $data['exam_id']);
			$existing_record = $this->db->get('tbl_examschedule_preliminary')->row();

			if (!empty($existing_record->exam_pdf)) {
				$existing_file = $existing_record->exam_pdf;
				if (file_exists($existing_file)) {

					unlink($existing_file); // 🔹 Automatically delete old file
				}
			}
		}

		if (!empty($_FILES['exam_pdf']['name'])) {
			$config['upload_path']   = './upload/exam_pdfs/'; // Make sure this folder exists
			$config['allowed_types'] = 'pdf';
			$config['max_size']      = 5120; // 5MB
			$config['file_name']     = $pdf_name; // Rename file

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('exam_pdf')) {
				$uploadData = $this->upload->data();
				$data['exam_pdf'] = 'upload/exam_pdfs/' . $uploadData['file_name']; // Save file path
			} else {
				echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
				return;
			}
		}


		$result = $this->examMarksmodel->save_examSchedule_preliminiary($data);

		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to save data.']);
		}
	}

	public function delete_examSchedule_preliminiary($id)
	{

		$result = $this->examMarksmodel->delete_examSchedule_preliminiary($id);
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Deleted successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete ']);
		}
	}


	function exam_question_paper_preliminary()
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}


		$data['result']	=	$this->examMarksmodel->get_ClgWise_examSchedule_preliminiary();


		$data["active_link"]	=	"";
		$data["page_title"]	=	"Exam Schedule for Preliminary";

		$this->load->view("common/header", $data);
		$this->load->view("exam/clg_examSchedule_preliminary", $data);
	}

	function download_question_paper_preliminary($id = null)
	{

		if (!$this->aranax_auth->is_logged_in()) {
			redirect("unauthorised");
		}

		if ($id === null) {
			redirect('dashboard');
		}

		$data = $this->examMarksmodel->get_examSchedule_by_id_preliminiary($id);

		if (!$data || empty($data['exam_pdf'])) {
			echo "Invalid exam data or missing file path.";
			http_response_code(404);
			exit;
		}

		$filepath = $data['exam_pdf'];


		$file_name =   "SmfQuestion_" . $data['exam_crs_code'] . $data['exam_paper'] . ".pdf";

		if (file_exists($filepath)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename="' . $file_name . '"');
			header('Content-Length: ' . filesize($filepath));

			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");

			readfile($filepath);
			exit;
		} else {
			echo "File not found.";
			http_response_code(404);
			exit;
		}
	}
}