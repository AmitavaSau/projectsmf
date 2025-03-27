<?php
class ExamMarksmodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('string');
    }

    function download_marks_student_final($userId)
    {
        $cand_tbl    =    'student_marks_final';

        $this->db->where('std_code', $userId);
        $this->db->update($cand_tbl, array('std_download_status' => 1));
        return TRUE;
    }

    function download_marks_student_pre($userId)
    {
        $cand_tbl    =    'student_marks_pre';

        $this->db->where('std_code', $userId);
        $this->db->update($cand_tbl, array('std_download_status' => 1));
        return TRUE;
    }

    function college($college_code)
    {
        $college_master = 'mast_colleges';
        $this->db->select('col_code,col_name');
        $this->db->from($college_master);
        $this->db->where('col_code', $college_code);
        $query = $this->db->get();
        $dropdowns = $query->result_array();
        $dropDownList[''] = 'Choose College';
        if (count($dropdowns) > 0) {
            foreach ($dropdowns as $dropdown) {

                $dropDownList[$dropdown['col_code']] = $dropdown['col_name'];
            }
        }
        return $dropDownList;
    }

    function course()
    {
        $course_master = 'mast_courses';
        $this->db->select('crs_dept,crs_name');
        $this->db->from($course_master);
        $query = $this->db->get();
        $dropdowns = $query->result_array();
        $dropDownList[''] = 'Choose Course';
        if (count($dropdowns) > 0) {
            foreach ($dropdowns as $dropdown) {

                $dropDownList[$dropdown['crs_dept']] = $dropdown['crs_name'];
            }
        }
        return $dropDownList;
    }

    function paper()
    {
        return array(
            ''    =>    '--Select--',
            'paper_1_marks'    =>    'PAPER I',
            'paper_2_marks'    =>    'PAPER II',
            'paper_3_marks'    =>    'PAPER III',
            'paper_4_marks'    =>    'PAPER IV'
        );
    }

    function paper_segments()
    {
        return array(
            ''    =>    '--Select--',
            'IA THEORY'        =>    'INTERNAL ASSESSMENT MARKS THEORY',
            'IA ORAL'          =>    'INTERNAL ASSESSMENT MARKS ORAL',
            'IA PRACTICAL'     =>    'INTERNAL ASSESSMENT MARKS PRACTICAL',
            'IA ORAL PRACTICAL'     =>    'INTERNAL ASSESSMENT MARKS ORAL PRACTICAL',
            'IA CLINICAL ASSESSMENT'     =>    'INTERNAL ASSESSMENT MARKS CLINICAL ASSESSMENT',

            'WT THEORY'        =>    'WRITTEN TEST MARKS THEORY',
            'WT ORAL'          =>    'WRITTEN TEST MARKS ORAL',
            'WT PRACTICAL'     =>    'WRITTEN TEST MARKS PRACTICAL',
            'WT ORAL PRACTICAL'     =>    'WRITTEN TEST MARKS ORAL PRACTICAL',
            'WT CLINICAL ASSESSMENT'     =>    'WRITTEN TEST MARKS CLINICAL ASSESSMENT',

            //'ATTENDANCE'     =>    'ATTENDANCE'
        );
    }


    public function get_candidates_preliminary($inst_code, $course_name, $cand_paper, $cand_paper_seg)
    {
        $cand_table = 'cand_preliminary_candidate';
        $marks_table = 'cand_preliminary_candidate_marks';

        $field_name = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg));

        if (!$this->db->field_exists($field_name, $marks_table)) {
            $field_name = '"" AS cand_marks_opt,"" AS cand_marks_remarks';
        } else {
            $field_name = $field_name . ' AS cand_marks_opt,' . $field_name . '_remarks AS cand_marks_remarks';
        }


        $this->db->select('cand_preliminary_candidate.*,' . $field_name);
        $this->db->from($cand_table);
        $this->db->join($marks_table, 'pre_cand_code = pre_cand_code_marks', 'left');
        $this->db->where('inst_code', $inst_code);
        $this->db->where('course_name', $course_name);
        $this->db->order_by('pre_slno', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }


    public function save_or_update_marks_preliminary($data)
    {

        $marks_table = 'cand_preliminary_candidate_marks';

        $cand_paper = $this->input->post('cand_paper');
        $cand_paper_seg = $this->input->post('cand_paper_seg');

        $field_marks = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg));
        $field_remarks = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg) . "_remarks");

        $tbl_data = [
            $field_marks => $data['cand_marks_opt'],
            $field_remarks => $this->input->post('cand_marks_remarks'),
            'pre_cand_code_marks' => $data['pre_cand_code']
        ];


        $this->db->where('pre_cand_code_marks', $data['pre_cand_code']);
        $query = $this->db->get($marks_table);

        if ($query->num_rows() > 0) {
            $this->db->where('pre_cand_code_marks', $data['pre_cand_code']);
            $this->db->update($marks_table, $tbl_data);
        } else {
            $this->db->insert($marks_table, $tbl_data);
        }

        return $this->db->affected_rows() > 0;
    }

    //FOR FINAL

    public function get_candidates_final($inst_code, $course_name, $cand_paper, $cand_paper_seg)
    {
        $cand_table = 'cand_final_candidate';
        $marks_table = 'cand_final_candidate_marks';

        $field_name = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg));

        if (!$this->db->field_exists($field_name, $marks_table)) {
            $field_name = '"" AS cand_marks_opt,"" AS cand_marks_remarks';
        } else {
            $field_name = $field_name . ' AS cand_marks_opt,' . $field_name . '_remarks AS cand_marks_remarks';
        }


        $this->db->select('cand_final_candidate.*,' . $field_name);
        $this->db->from($cand_table);
        $this->db->join($marks_table, 'pre_cand_code = pre_cand_code_marks', 'left');
        $this->db->where('inst_code', $inst_code);
        $this->db->where('course_name', $course_name);
        $this->db->order_by('pre_slno', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }


    public function save_or_update_marks_final($data)
    {

        $marks_table = 'cand_final_candidate_marks';

        $cand_paper = $this->input->post('cand_paper');
        $cand_paper_seg = $this->input->post('cand_paper_seg');

        $field_marks = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg));
        $field_remarks = $cand_paper . "_" . strtolower(str_replace(' ', '_', $cand_paper_seg) . "_remarks");

        $tbl_data = [
            $field_marks => $data['cand_marks_opt'],
            $field_remarks => $this->input->post('cand_marks_remarks'),
            'pre_cand_code_marks' => $data['pre_cand_code']
        ];


        $this->db->where('pre_cand_code_marks', $data['pre_cand_code']);
        $query = $this->db->get($marks_table);

        if ($query->num_rows() > 0) {
            $this->db->where('pre_cand_code_marks', $data['pre_cand_code']);
            $this->db->update($marks_table, $tbl_data);
        } else {
            $this->db->insert($marks_table, $tbl_data);
        }

        return $this->db->affected_rows() > 0;
    }

    function get_college_details($user)
    {
        $clg_tbl    =     'mast_colleges';

        $this->db->select('*', false);
        $this->db->from($clg_tbl);

        $this->db->where('col_code', $user);

        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    function get_dist_drp()
    {
        $states    =    'cnfg_district';
        $this->db->select('district_name');
        $this->db->from($states);
        $this->db->where('state_name', 'WEST BENGAL');
        $this->db->order_by('district_name', 'ASC');
        $dropdowns    =    $this->db->get()->result_array();

        $dropDownList[''] = "--Select District--";
        if (count($dropdowns) > 0) {
            foreach ($dropdowns as $dropdown) {
                $dropDownList[$dropdown['district_name']] = $dropdown['district_name'];
            }
        }

        return $dropDownList;
    }

    function institute_details_save()
    {
        $clg_tbl    =     'mast_colleges';
        $college_code = $this->session->userdata('AX_user_firstname');

        $data = array(

            'col_center_in_charge_name' =>    strtoupper($this->input->post('col_center_in_charge_name')),
            'col_center_in_charge_designation'        =>    $this->input->post('col_center_in_charge_designation'),
            'col_name'        =>    $this->input->post('col_name'),
            'col_center_address_1'        =>    $this->input->post('col_center_address_1'),
            'col_center_address_2'        =>    $this->input->post('col_center_address_2'),
            'col_center_state'        =>    $this->input->post('col_center_state'),
            'col_center_dist'        =>    $this->input->post('col_center_dist'),
            'col_center_pin'        =>    $this->input->post('col_center_pin'),
            'col_center_mob'        =>    $this->input->post('col_center_mob'),
            'col_center_email'        =>    $this->input->post('col_center_email')

        );

        $this->db->where('col_code', $college_code);
        $this->db->update($clg_tbl, $data);

        $appl_no = $this->input->post('cand_appl_no');
        $audit_trail_msg    =    'Col_code :: ' . $college_code . ' :: updated institute details';
        audit_trail($audit_trail_msg);

        return true;
    }

    public function get_examiners_by_college($college_id)
    {
        $this->db->where('examiner_clg_code', $college_id);
        $this->db->order_by('examiner_id ', 'ASC');
        $query = $this->db->get('college_examiner_tbl');
        return $query->result_array();
    }

    public function get_examiner_by_id($id, $college_id)
    {
        $this->db->where('examiner_id', $id);
        $this->db->where('examiner_clg_code', $college_id);
        $query = $this->db->get('college_examiner_tbl');

        return $query->row_array();
    }

    // Insert or update examiner data
    public function save_examiner($data)
    {
        if (isset($data['examiner_id']) && !empty($data['examiner_id'])) {
            // Update operation
            $this->db->where('examiner_id ', $data['examiner_id']);
            $this->db->where('examiner_clg_code', $data['examiner_clg_code']);
            unset($data['examiner_id']);
            return $this->db->update('college_examiner_tbl', $data);
        } else {

            return $this->db->insert('college_examiner_tbl', $data);
        }
    }

    public function delete_examiner($id, $college_id)
    {
        $this->db->where('examiner_id', $id);
        $this->db->where('examiner_clg_code', $college_id);
        return $this->db->delete('college_examiner_tbl');
    }


    //Exam Schedule

    function course_dropdown()
    {
        $course_master = 'mast_courses';
        $this->db->select('crs_course,crs_name');
        $this->db->from($course_master);
        $query = $this->db->get();
        $dropdowns = $query->result_array();
        $dropDownList[''] = 'Choose Course';
        if (count($dropdowns) > 0) {
            foreach ($dropdowns as $dropdown) {

                $dropDownList[$dropdown['crs_course']] = $dropdown['crs_name'];
            }
        }
        return $dropDownList;
    }

    public function get_examSchedule_preliminiary()
    {
        $this->db->select('e.*, c.crs_name');
        $this->db->from('tbl_examschedule_preliminary e');
        $this->db->join('mast_courses c', 'e.exam_crs_code = c.crs_course', 'left');
        $this->db->order_by('e.exam_id', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_examSchedule_by_id_preliminiary($id)
    {
        $this->db->where('exam_id', $id);
        $query = $this->db->get('tbl_examschedule_preliminary');

        return $query->row_array();
    }


    public function save_examSchedule_preliminiary($data)
    {
        if (isset($data['exam_id']) && !empty($data['exam_id'])) {
            // Update operation
            $this->db->where('exam_id ', $data['exam_id']);
            return $this->db->update('tbl_examschedule_preliminary', $data);
        } else {

            return $this->db->insert('tbl_examschedule_preliminary', $data);
        }
    }

    public function delete_examSchedule_preliminiary($id)
    {
        $this->db->where('exam_id', $id);
        return $this->db->delete('tbl_examschedule_preliminary');
    }

    function get_ClgWise_examSchedule_preliminiary()
    {

        $college_id = $this->session->userdata('AX_user_firstname');

        $this->db->select('e.*, c.crs_name');
        $this->db->from('tbl_examschedule_preliminary e');
        $this->db->where('exam_clgCode', $college_id);
        $this->db->join('mast_courses c', 'e.exam_crs_code = c.crs_course', 'left');
        $this->db->join('exam_clg_crs_paper_preliminary p', 'e.exam_crs_code = p.exam_crsCode AND e.exam_paper = p.exam_paper', 'left');
        $this->db->order_by('e.exam_id', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
}