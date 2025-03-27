<?php
class SmfAdminmodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('string');
    }

    function final_award_sheet_report($filename, $inst_code, $course_name)
    {


        ini_set('memory_limit', '1024M');

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $c_tbl    =    'final_award_sheet_tbl';

        $this->db->select('*');
        $this->db->from($c_tbl);

        if ($inst_code != null) {
            $this->db->where('award_inst_code', $inst_code);
        }
        if ($course_name != null) {
            $this->db->where('award_course_name', $course_name);
        }

        $this->db->order_by('award_id', 'ASC');
        $query    =    $this->db->get();

        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);

        return true;
    }

    function college()
    {
        $college_master = 'mast_colleges';
        $this->db->select('col_code,col_name');
        $this->db->from($college_master);
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
        $tbl = 'final_award_sheet_tbl';
        $this->db->distinct();
        $this->db->select('award_course_name');
        $this->db->from($tbl);
        $query = $this->db->get();
        $dropdowns = $query->result_array();
        $dropDownList[''] = 'Choose Course';
        if (count($dropdowns) > 0) {
            foreach ($dropdowns as $dropdown) {

                $dropDownList[$dropdown['award_course_name']] = $dropdown['award_course_name'];
            }
        }

        return $dropDownList;
    }

    function get_final_award_sheet_data($inst_code, $course_name)
    {

        $award_sheet_tbl    =    'final_award_sheet_tbl';

        $this->db->select('*');
        $this->db->from($award_sheet_tbl);
        $this->db->where('award_inst_code', $inst_code);
        $this->db->where('award_course_name', $course_name);
        $query    =    $this->db->get();
        $res    =    $query->result_array();

        return     $res;
    }

    public function final_award_sheet_save($data)
    {

        $award_code                   = $this->input->post('award_code');

        $this->db->where('award_code', $award_code);
        return $this->db->update('final_award_sheet_tbl', $data);
    }

    function get_data_view_dfharma($cand_code)
    {
        $cand_view_tbl    =    'data_viewing_dfharma_tbl';


        $this->db->select('*');
        $this->db->from($cand_view_tbl);


        $this->db->where('view_cand_code', $cand_code);
        $query    =    $this->db->get();
        $res    =    $query->result_array();

        return $res;
    }

    public function get_remarks_by_code_dfharma($cand_code)
    {
        $this->db->where('rmks_cand_code', $cand_code);
        $this->db->order_by('rmks_id', 'ASC');
        $query = $this->db->get('data_remarks_dfharma_tbl');
        return $query->result_array();
    }

    public function get_remarks_dfharma_by_id($id)
    {
        $this->db->where('rmks_id', $id);
        $query = $this->db->get('data_remarks_dfharma_tbl');

        return $query->row_array();
    }

    // Insert or update examiner data
    public function save_remarks_dfharma($data)
    {
        if (isset($data['rmks_id']) && !empty($data['rmks_id'])) {
            // Update operation
            $this->db->where('rmks_id ', $data['rmks_id']);
            $this->db->where('rmks_cand_code', $data['rmks_cand_code']);
            unset($data['rmks_id']);
            return $this->db->update('data_remarks_dfharma_tbl', $data);
        } else {

            return $this->db->insert('data_remarks_dfharma_tbl', $data);
        }
    }

    public function delete_remarks_dfharma($id)
    {
        $this->db->where('rmks_id', $id);
        return $this->db->delete('data_remarks_dfharma_tbl');
    }

    //final data view

    function get_data_view_final($cand_code)
    {
        $cand_view_tbl    =    'data_viewing_final_tbl';


        $this->db->select('*');
        $this->db->from($cand_view_tbl);


        $this->db->where('view_cand_code', $cand_code);
        $query    =    $this->db->get();
        $res    =    $query->result_array();

        return $res;
    }

    public function get_remarks_by_code_final($cand_code)
    {
        $this->db->where('rmks_cand_code', $cand_code);
        $this->db->order_by('rmks_id', 'ASC');
        $query = $this->db->get('data_remarks_final_tbl');
        return $query->result_array();
    }

    public function get_remarks_final_by_id($id)
    {
        $this->db->where('rmks_id', $id);
        $query = $this->db->get('data_remarks_final_tbl');

        return $query->row_array();
    }

    // Insert or update examiner data
    public function save_remarks_final($data)
    {
        if (isset($data['rmks_id']) && !empty($data['rmks_id'])) {
            // Update operation
            $this->db->where('rmks_id ', $data['rmks_id']);
            $this->db->where('rmks_cand_code', $data['rmks_cand_code']);
            unset($data['rmks_id']);
            return $this->db->update('data_remarks_final_tbl', $data);
        } else {

            return $this->db->insert('data_remarks_final_tbl', $data);
        }
    }

    public function delete_remarks_final($id)
    {
        $this->db->where('rmks_id', $id);
        return $this->db->delete('data_remarks_final_tbl');
    }
}