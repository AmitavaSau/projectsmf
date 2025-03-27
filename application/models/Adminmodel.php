<?php
class Adminmodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$ci = get_instance();
		$ci->load->helper('string');
	}

	public function get_clgUsers()
	{
		$this->db->select('user_id, user_role_id,user_name, user_password,user_firstname,col_name');
		$this->db->from('users');
		$this->db->join('mast_colleges', 'col_code = user_name');
		$this->db->where('user_role_id', 10);
		return $this->db->get()->result();
	}

	public function updatePassword($id, $newPassword)
	{
		$this->db->where('user_id', $id);
		$this->db->update('users', ['user_password' => $newPassword]);
	}

	function get_college_name($college_code)
	{
		$cand_clg_tbl = 'mast_colleges';
		$this->db->select('col_name');

		$this->db->from($cand_clg_tbl);
		$this->db->where('col_code', $college_code);
		$query    =    $this->db->get();
		//echo $this->db->last_query();

		$response    =    $query->row_array();
		//print_r($response);exit();
		$clg_name = implode($response);
		return $clg_name;
	}

	function candidateByCourse($college_code)
	{
		//echo 'ok';exit();
		$cand_mast_tbl	=	'mast_candidates';

		//print_r($_SESSION);;exit();
		$this->db->select('appl_reg_num, appl_fullname, appl_fathername, 
				 DATE_FORMAT(appl_dob,"%d-%m-%Y") as appl_dob, appl_category,alloted_college,alloted_course,dv_status,cand_refund,cand_clg_report,appl_gmr,crs_name,alloted_category');
		$this->db->from($cand_mast_tbl);

		$this->db->join('mast_courses', 'crs_course=mast_candidates.alloted_course', 'left outer');

		$this->db->where('alloted_college', $college_code);
		//$this->db->where('crs_name', $course_code);

		$this->db->order_by('appl_reg_num', 'ASC');

		$query	=	$this->db->get();

		//echo $this->db->last_query(); exit();
		$response	=	$query->result_array();
		//echo $response;exit();

		return $response;
	}


	function update_clg_report($appl_reg_num, $report)
	{
		$cand_reg_tbl	=	'mast_candidates';
		$dv_on          =   date('Y-m-d H:i:s');

		$this->db->where('appl_reg_num', $appl_reg_num);
		$this->db->update($cand_reg_tbl, array('cand_clg_report' => $report, 'cand_clg_report_on' => $dv_on));

		return true;
	}

	function download_statement_preliminary($filename)
	{


		ini_set('memory_limit', '1024M');

		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');

		$c_tbl    =    'student_marks_pre';

		$this->db->select('*');
		$this->db->from($c_tbl);


		$this->db->order_by('std_id', 'ASC');
		$query    =    $this->db->get();
		//	echo $this->db->last_query();exit;
		//$res	=	$query->result_array();
		//return 	$res;

		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		force_download($filename, $data);

		return true;
	}

	function download_statement_Final($filename)
	{


		ini_set('memory_limit', '1024M');

		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');

		$c_tbl    =    'student_marks_final';

		$this->db->select('*');
		$this->db->from($c_tbl);


		$this->db->order_by('std_id', 'ASC');
		$query    =    $this->db->get();
		//	echo $this->db->last_query();exit;
		//$res	=	$query->result_array();
		//return 	$res;

		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		force_download($filename, $data);

		return true;
	}


	function download_student_marks_preliminary($filename)
	{


		ini_set('memory_limit', '1024M');

		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');


		$this->db->select('*');
		$this->db->from('cand_preliminary_candidate');
		$this->db->join('cand_preliminary_candidate_marks', 'cand_preliminary_candidate.pre_cand_code = cand_preliminary_candidate_marks.pre_cand_code_marks', 'left');

		$this->db->order_by('pre_slno', 'ASC');
		$query    =    $this->db->get();
		//	echo $this->db->last_query();exit;
		//$res	=	$query->result_array();
		//return 	$res;

		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		force_download($filename, $data);

		return true;
	}

	function download_student_marks_final($filename)
	{


		ini_set('memory_limit', '1024M');

		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');


		$this->db->select('*');
		$this->db->from('cand_final_candidate');
		$this->db->join('cand_final_candidate_marks', 'cand_final_candidate.pre_cand_code = cand_final_candidate_marks.pre_cand_code_marks', 'left');

		$this->db->order_by('pre_slno', 'ASC');
		$query    =    $this->db->get();
		//	echo $this->db->last_query();exit;
		//$res	=	$query->result_array();
		//return 	$res;

		$delimiter = ",";
		$newline = "\r\n";
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
		force_download($filename, $data);

		return true;
	}
}