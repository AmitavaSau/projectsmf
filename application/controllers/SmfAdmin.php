<?php
defined('BASEPATH') or exit('No direct script access allowed');

class smfAdmin extends Aranax
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file_helper');
        $this->load->model('smfAdminmodel');
    }

    function index() {}


    function final_award_sheet_report($inst_code = null, $course_name = null)
    {

        $inst_code    =   $_GET['inst_code'];
        $course_name   =   $_GET['course_name'];

        $filename = "Final_Award_Sheet_Report_" . date('Ymdhis') . ".csv";
        $data = $this->smfAdminmodel->final_award_sheet_report($filename, $inst_code, $course_name);;
    }

    function final_award_sheet($inst_code = null, $course_name = null)
    {

        if (!$this->aranax_auth->is_logged_in()) {
            redirect("unauthorised");
        }

        $inst_code    =   $_GET['inst_code'];
        $course_name   =   $_GET['course_name'];

        $data["inst_code"]      =    $inst_code;
        $data["course_name"]      =    $course_name;

        $startYear = 2019;
        $endYear = 2025;
        $years = range($startYear, $endYear);

        array_unshift($years, '');

        $year_drp = array('' => '--Select--') + array_combine($years, $years);


        $data['year_drp'] = $year_drp;

        $data["page_title"]    =    "Final Award Sheet";

        $data['college'] = $this->smfAdminmodel->college();
        $data['course'] = $this->smfAdminmodel->course();
        $data['all_detail'] = $this->smfAdminmodel->get_final_award_sheet_data($inst_code, $course_name);


        // echo "<pre>";
        // print_r($data['all_detail']);
        // exit();
        $this->load->view("common/header", $data);
        $this->load->view("smfadmin/final_award_sheet", $data);
    }

    public function final_award_sheet_save()
    {

        $award_code                   = $this->input->post('award_code');

        $data = [
            'award_duration_practical_from' => $this->input->post('award_duration_practical_from'),
            'award_duration_practical_to'   => $this->input->post('award_duration_practical_to'),
            'award_total_hours'             => $this->input->post('award_total_hours'),
            'award_year_of_passing'   => $this->input->post('award_year_of_passing'),
            'award_date'                    => $this->input->post('award_date'),

        ];

        $required_fields = ['award_duration_practical_from', 'award_duration_practical_to', 'award_total_hours', 'award_year_of_passing'];

        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                echo json_encode(['status' => 'error', 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.']);
                return;
            }
        }

        /*  // Validate data (you can add more robust validation here)
        foreach ($data as $key => $value) {
            if (empty($value)) {
                echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
                return;
            }
        } */

        // Save data using the model
        $result = $this->smfAdminmodel->final_award_sheet_save($data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Submitted successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit data.']);
        }
    }

    function data_viewing_dfharma($cand_code = null)
    {

        if (!$this->aranax_auth->is_logged_in()) {
            redirect("unauthorised");
        }

        $data["page_title"]    =    "Data Viewing D PHARMA";
        $data['cand_details'] = array();
        $data['cand_code'] = $cand_code;

        if ($cand_code != null) {
            $data['cand_details'] = $this->smfAdminmodel->get_data_view_dfharma($cand_code);
            //print_r($data['cand_details']);exit;

            if ($data['cand_details'] == null) {
                redirect('dashboard');
            }
        }

        // echo "<pre>";
        // print_r($data['all_detail']);
        // exit();
        $this->load->view("common/header", $data);
        $this->load->view("smfadmin/data_view_dfharma", $data);
    }

    public function fetch_remarks_dfharma()
    {

        $cand_code = $this->input->get('cand_code');

        if (!$cand_code) {
            echo json_encode(['error' => 'Candidate code is required']);
            return;
        }

        $data = $this->smfAdminmodel->get_remarks_by_code_dfharma($cand_code);

        echo json_encode($data);
    }

    public function get_remarks_dfharma($id)
    {

        $data = $this->smfAdminmodel->get_remarks_dfharma_by_id($id);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data not found or unauthorized.']);
        }
    }

    // Save examiner (Insert or Update)
    public function save_remarks_dfharma()
    {
        $cand_code = $this->input->post('rmks_cand_code');
        $data = $this->input->post();

        if (!$cand_code) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
            return;
        }

        $data['rmks_time'] =  date('Y-m-d H:i:s');;
        $result = $this->smfAdminmodel->save_remarks_dfharma($data);
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save data.']);
        }
    }

    public function delete_remarks_dfharma($id)
    {
        $result = $this->smfAdminmodel->delete_remarks_dfharma($id);
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete examiner.']);
        }
    }

    //Final data view

    function data_viewing_final($cand_code = null)
    {

        if (!$this->aranax_auth->is_logged_in()) {
            redirect("unauthorised");
        }

        $data["page_title"]    =    "Data Viewing FINAL";
        $data['cand_details'] = array();
        $data['cand_code'] = $cand_code;

        if ($cand_code != null) {
            $data['cand_details'] = $this->smfAdminmodel->get_data_view_final($cand_code);
            //print_r($data['cand_details']);exit;

            if ($data['cand_details'] == null) {
                redirect('dashboard');
            }
        }

        // echo "<pre>";
        // print_r($data['all_detail']);
        // exit();
        $this->load->view("common/header", $data);
        $this->load->view("smfadmin/data_view_final", $data);
    }

    public function fetch_remarks_final()
    {

        $cand_code = $this->input->get('cand_code');

        if (!$cand_code) {
            echo json_encode(['error' => 'Candidate code is required']);
            return;
        }

        $data = $this->smfAdminmodel->get_remarks_by_code_final($cand_code);

        echo json_encode($data);
    }

    public function get_remarks_final($id)
    {

        $data = $this->smfAdminmodel->get_remarks_final_by_id($id);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Data not found or unauthorized.']);
        }
    }

    // Save examiner (Insert or Update)
    public function save_remarks_final()
    {
        $cand_code = $this->input->post('rmks_cand_code');
        $data = $this->input->post();

        if (!$cand_code) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
            return;
        }

        $data['rmks_time'] =  date('Y-m-d H:i:s');;
        $result = $this->smfAdminmodel->save_remarks_final($data);
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save data.']);
        }
    }

    public function delete_remarks_final($id)
    {
        $result = $this->smfAdminmodel->delete_remarks_final($id);
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete examiner.']);
        }
    }
}