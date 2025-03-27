<?php
class Reportmodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$ci = get_instance();
		$ci->load->helper('string');
		$ci->load->helper('security');
		$ci->load->helper('audit');
	}

	//get dashboard stats
	function get_dashboard_marks()
	{

		$sql	=	"SELECT					
						SUM(1) AS total_reg_pre,
						SUM(IF(std_download_status = '1', 1, 0)) AS std_download_status_pre
						
						FROM student_marks_pre";
		$q	=		$this->db->query($sql);
		$r	=	$q->row_array();

		$sql2	=	"SELECT					
						SUM(1) AS total_reg_final,
						SUM(IF(std_download_status = '1', 1, 0)) AS std_download_status_final
						
						FROM student_marks_final";
		$q2	=		$this->db->query($sql2);
		$r2	=	$q2->row_array();


		//print_r($r);exit;
		return $r + $r2;
	}

	function get_dashbaord_stats()
	{
		//echo($appl_step);exit;
		$c_tbl    =   'mast_candidates';
		$sql = "SELECT COUNT(appl_roll_num) AS total_applied, 
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . ") AS total_registered,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1) AS total_approved, 
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='SC') AS sc_approved, 
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='ST') AS st_approved,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='OA') AS oa_approved,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='OB') AS ob_approved,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='PW') AS pw_approved,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='GE') AS ge_approved,
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status =1 AND alloted_category='EWS') AS ews_approved,
						
						
						 
						(SELECT COUNT(appl_roll_num) FROM " . $c_tbl . " WHERE appl_status = 6) AS total_payment 
				FROM " . $c_tbl . "  
				WHERE appl_roll_num > 0";

		$r = $this->db->query($sql)->row();
		//echo $this->db->last_query();exit();
		//print_r($r);exit;
		return $r;
	}

	//user activities
	function get_activities($user_name, $cnt = null)
	{
		$at_table	=	'user_audit_trail';
		$u_table	=	'users';
		$this->db->select('at_id, at_message, at_user, DATE_FORMAT(at_date, "%d-%b-%Y %h:%i %p") AS activity_date, 
							at_ip, 
							CONCAT(user_firstname, " ", user_midname, " ", user_lastname) AS user_fullname', FALSE);
		$this->db->from($at_table);
		$this->db->join($u_table, 'user_name = at_user');
		$this->db->where('user_name', $user_name);
		if ($cnt != null) {
			$this->db->limit($cnt);
		}
		$this->db->order_by('at_date', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	//seat available output screen
	function get_seat_available($col_code)
	{
		$col_tbl	=	'mast_colleges';
		$crs_tbl	=	'mast_courses';
		$seat_tbl	=	'seats_available';

		$this->db->select('seat.col_code, col_name, crs_name, 
							cat_ge, cat_sc, cat_st, 
							cat_oa, cat_ob, cat_pw, cat_sp_ge, cat_sp_sc', false);
		$this->db->from($seat_tbl . ' AS seat');
		$this->db->join($col_tbl . ' AS col', 'col.col_code = seat.col_code');
		$this->db->join($crs_tbl . ' AS crs', 'crs.sl = seat.crs_code');
		$this->db->order_by('col_code', 'ASC');
		$this->db->order_by('crs_name', 'ASC');
		$this->db->where('seat.col_code', $col_code);
		$query  = $this->db->get();
		//echo $this->db->last_query();exit();
		$r =   $query->result();


		$arr	=	array();
		for ($i = 0; $i < count($r); $i++) {
			$arr[$i]	=	array(
				'crs_name'		=>	$r[$i]->crs_name,
				'cat_ge'		=>	$r[$i]->cat_ge,
				'cat_sc'		=>	$r[$i]->cat_sc,
				'cat_st'		=>	$r[$i]->cat_st,
				'cat_oa'		=>	$r[$i]->cat_oa,
				'cat_ob'		=>	$r[$i]->cat_ob,
				'cat_pw'		=>	$r[$i]->cat_pw,
				'cat_sp_ge'		=>	$r[$i]->cat_sp_ge,
				'cat_sp_sc'		=>	$r[$i]->cat_sp_sc,
			);
		}

		return $arr;
	}


	//get seat available
	function get_seat_status()
	{
		$col_tbl = 'mast_colleges';
		$seat_tbl = 'mast_seats';
		$vac_tbl = 'seats_available';
		$crs_tbl = 'mast_courses';

		$this->db->select('col.col_code AS col_code, col_name, 
							st.crs_code AS crs_code, crs.crs_name AS crs_name, 
							st.cat_ge AS cat_ge, st.cat_sc AS cat_sc, st.cat_st AS cat_st, 
							st.cat_oa AS cat_oa, st.cat_ob AS cat_ob, 
							st.cat_pw AS cat_pw, 
							st.cat_sp_ge AS cat_sp_ge, st.cat_sp_sc AS cat_sp_sc');
		$this->db->from($col_tbl . ' AS col');
		$this->db->join($seat_tbl . ' AS st', 'st.col_code = col.col_code');
		$this->db->join($crs_tbl . ' AS crs', 'crs.sl = st.crs_code');
		$this->db->where('col.is_delete', 0);
		$this->db->order_by('col.col_code', 'ASC');
		$this->db->order_by('st.crs_code', 'ASC');
		$query1 = $this->db->get();
		$seat_capacity = $query1->result();

		$this->db->select('col.col_code AS col_code, col_name, 
							sa.crs_code AS crs_code, crs.crs_name AS crs_name, 
							sa.cat_ge AS cat_ge, sa.cat_sc AS cat_sc, sa.cat_st AS cat_st, 
							sa.cat_oa AS cat_oa, sa.cat_ob AS cat_ob,
							sa.cat_pw AS cat_pw, 
							sa.cat_sp_ge AS cat_sp_ge, sa.cat_sp_sc AS cat_sp_sc');
		$this->db->from($col_tbl . ' AS col');
		$this->db->join($vac_tbl . ' AS sa', 'sa.col_code = col.col_code');
		$this->db->join($crs_tbl . ' AS crs', 'crs.sl = sa.crs_code');
		$this->db->where('col.is_delete', 0);
		$this->db->order_by('col.col_code', 'ASC');
		$this->db->order_by('sa.crs_code', 'ASC');
		$query2 = $this->db->get();
		$seat_vacant = $query2->result();

		$seats	= array();
		for ($i = 0; $i < count($seat_capacity); $i++) {
			if (($seat_capacity[$i]->col_code == $seat_vacant[$i]->col_code) &&
				($seat_capacity[$i]->crs_code == $seat_vacant[$i]->crs_code)
			) {

				$seats[$i] = array(
					'col_code' => $seat_capacity[$i]->col_code,
					'col_name' => $seat_capacity[$i]->col_name,
					'crs_code' => $seat_capacity[$i]->crs_code,
					'crs_name' => $seat_capacity[$i]->crs_name,

					'cat_ge_tot' => $seat_capacity[$i]->cat_ge,
					'cat_ge_fil' => intval($seat_capacity[$i]->cat_ge) - intval($seat_vacant[$i]->cat_ge),
					'cat_ge_vac' => $seat_vacant[$i]->cat_ge,

					'cat_sc_tot' => $seat_capacity[$i]->cat_sc,
					'cat_sc_fil' => intval($seat_capacity[$i]->cat_sc) - intval($seat_vacant[$i]->cat_sc),
					'cat_sc_vac' => $seat_vacant[$i]->cat_sc,

					'cat_st_tot' => $seat_capacity[$i]->cat_st,
					'cat_st_fil' => intval($seat_capacity[$i]->cat_st) - intval($seat_vacant[$i]->cat_st),
					'cat_st_vac' => $seat_vacant[$i]->cat_st,

					'cat_oa_tot' => $seat_capacity[$i]->cat_oa,
					'cat_oa_fil' => intval($seat_capacity[$i]->cat_oa) - intval($seat_vacant[$i]->cat_oa),
					'cat_oa_vac' => $seat_vacant[$i]->cat_oa,

					'cat_ob_tot' => $seat_capacity[$i]->cat_ob,
					'cat_ob_fil' => intval($seat_capacity[$i]->cat_ob) - intval($seat_vacant[$i]->cat_ob),
					'cat_ob_vac' => $seat_vacant[$i]->cat_ob,

					'cat_pw_tot' => $seat_capacity[$i]->cat_pw,
					'cat_pw_fil' => intval($seat_capacity[$i]->cat_pw) - intval($seat_vacant[$i]->cat_pw),
					'cat_pw_vac' => $seat_vacant[$i]->cat_pw,

					'cat_sp_ge_tot' => $seat_capacity[$i]->cat_sp_ge,
					'cat_sp_ge_fil' => intval($seat_capacity[$i]->cat_sp_ge) - intval($seat_vacant[$i]->cat_sp_ge),
					'cat_sp_ge_vac' => $seat_vacant[$i]->cat_sp_ge,

					'cat_sp_sc_tot' => $seat_capacity[$i]->cat_sp_sc,
					'cat_sp_sc_fil' => intval($seat_capacity[$i]->cat_sp_sc) - intval($seat_vacant[$i]->cat_sp_sc),
					'cat_sp_sc_vac' => $seat_vacant[$i]->cat_sp_sc,

					'exam_name'	=>	$_SESSION['config_texts']['exam_name'] . ' - ' . $_SESSION['config_texts']['exam_year']

				);
			}
		}

		//	print_r($seats);exit();
		return $seats;
	}

	//get rank
	function get_rank()
	{
		$cnd_tbl    =   'mast_candidates';
		$photo_loc	=	getFileLocation('candidate-profile');

		$this->db->select(
			'sl, appl_reg_num, appl_roll_num, appl_fullname, appl_fathername,
							appl_dob, appl_gender, appl_category, appl_pwd, 
							appl_score, appl_percentile, appl_gmr, 
							appl_photo',
			false
		);
		$this->db->from($cnd_tbl);
		//$this->db->where('appl_status', 1);
		$this->db->order_by('appl_gmr', 'ASC');
		$query  = $this->db->get();
		$r =   $query->result();
		$res_num	=	$query->num_rows();
		$arr	=	array();

		if ($res_num > 0) {
			for ($i = 0; $i < $res_num; $i++) {
				$arr[$i] = array(
					'appl_sl'			=>	$r[$i]->sl,
					'appl_reg_num'		=>	$r[$i]->appl_reg_num,
					'appl_roll_num'		=>	$r[$i]->appl_roll_num,
					'appl_fullname'		=>	$r[$i]->appl_fullname,
					'appl_fathername'	=>	$r[$i]->appl_fathername,
					'appl_dob'			=>	$r[$i]->appl_dob,
					'appl_gender'		=>	$r[$i]->appl_gender,
					'appl_category'		=>	getCategoryName($r[$i]->appl_category),
					'appl_pwd'			=>	$r[$i]->appl_pwd,
					'appl_score'		=>	$r[$i]->appl_score,
					'appl_percentile'	=>	$r[$i]->appl_percentile,
					'appl_gmr'			=>	$r[$i]->appl_gmr,
					'appl_qualification' =>	'NO DATA AVAILABLE',
					'appl_photo'		=>	$photo_loc . $r[$i]->appl_photo,
					'exam_name'	=>	$_SESSION['config_texts']['exam_name'] . ' - ' . $_SESSION['config_texts']['exam_year']
				);
			}
		}

		return $arr;
	}

	function college_wise_report()
	{
		$cnd_tbl    =   'mast_candidates';
		$col_tbl	=	'mast_colleges';

		$this->db->select(' alloted_college as college_code,col_name,sum(if(appl_status=1 , 1, 0)) AS alloted');
		$this->db->from($cnd_tbl);
		$this->db->join('mast_colleges', 'col_code=mast_candidates.alloted_college');

		$this->db->group_by('col_code');
		$this->db->order_by('col_code', 'ASC');

		$query	=	$this->db->get();
		//	echo $this->db->last_query();exit();
		$response	=	$query->result_array();
		//	print_r($response);exit();
		return $response;
	}

	function candidateByallclg_xls($college_code)
	{
		$cnd_tbl    =   'mast_candidates';

		$this->db->select('alloted_course as course_code,crs_name,alloted_college as college_code,col_name,appl_reg_num,appl_roll_num,appl_fullname,appl_dob,appl_category,appl_gmr as rank,alloted_category,mobile,email,
		(CASE WHEN cand_clg_report = 0 THEN ""
		WHEN cand_clg_report = 1 THEN "Reported"
		WHEN cand_clg_report = 2 THEN "Not Reported"
        END) AS report,
        (CASE WHEN cand_refund = 0 THEN ""
		WHEN cand_refund = 1 THEN "Requested For Refund"
        END) AS Refund
            ');

		$this->db->from($cnd_tbl);
		$this->db->join('mast_colleges', 'col_code=mast_candidates.alloted_college', 'left outer');
		$this->db->join('mast_courses', 'crs_course=mast_candidates.alloted_course', 'left outer');


		$this->db->where('alloted_college', $college_code);

		$this->db->order_by('alloted_college', 'ASC');
		$this->db->order_by('appl_gmr', 'ASC');

		$query	=	$this->db->get();

		//echo $this->db->last_query(); exit();

		$response	=	$query->result_array();

		return $response;
	}

	function candidateByclg_xls()
	{
		$cnd_tbl    =   'mast_candidates';

		$this->db->select('alloted_course as course_code,crs_name,alloted_college as college_code,col_name,appl_reg_num,mobile,email,appl_roll_num,appl_fullname,appl_dob,appl_category,appl_gmr as rank,alloted_category,bank_ref,draft_date,bank_name,alloted_date,draft_amt');

		$this->db->from($cnd_tbl);
		$this->db->join('mast_colleges', 'col_code=mast_candidates.alloted_college', 'left outer');
		$this->db->join('mast_courses', 'crs_course=mast_candidates.alloted_course', 'left outer');


		$this->db->where('appl_status', 1);

		$this->db->order_by('alloted_college', 'ASC');
		$this->db->order_by('appl_gmr', 'ASC');

		$query	=	$this->db->get();

		//echo $this->db->last_query(); exit();

		$response	=	$query->result_array();

		return $response;
	}

	function get_seatsbls()
	{
		//echo($appl_step);exit;
		$avl_tbl    =   'seats_available';
		$c_tbl    =   'mast_candidates';

		$sql1 = "
						SELECT SUM(cat_ge) AS ge_avl,SUM(cat_sc) AS sc_avl,SUM(cat_st) AS st_avl,SUM(cat_oa) AS oa_avl,SUM(cat_ob) AS ob_avl,SUM(cat_pw) AS ph_avl,SUM(cat_ews) AS ews_avl FROM " . $avl_tbl;



		$r = $this->db->query($sql1)->row();
		//echo $this->db->last_query();exit();
		//print_r($r);exit;
		return $r;
	}
}
