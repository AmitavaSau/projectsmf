<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Aranax
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('Aranax_Auth');
		$this->load->helper('aranax');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('authmodel');
		$this->load->model('configmodel');
		$this->load->model('usermodel');
		$this->load->model('reportmodel');
	}

	//user dashboard
	function dashboard()
	{
		//$this->output->enable_profiler(TRUE);
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$data['stats_marks'] = $this->reportmodel->get_dashboard_marks();

		$data["active_link"]	=	"dashboard";
		$data["page_title"]	=	"";
		$this->load->view("common/header", $data);
		$this->load->view("user/dashboard", $data);
	}

	//change password
	function change_password()
	{
		if ($this->input->post('user_password')) {
			$status		=	$this->aranax_auth->change_password(
				$_SESSION['AX_username'],
				$this->input->post('user_password')
			);
			if ($status) {
				$this->session->set_flashdata('success', 'Password changed successfully');
			} else {
				$this->session->set_flashdata('failure', 'Password change failed');
			}

			redirect("change-password");
		}


		$data["active_link"]	=	"dashboard";
		$data["page_title"]	=	"Change Password";
		$this->load->view("common/header", $data);
		$this->load->view("user/change_password", $data);
	}

	//forgot password
	function forgot_password()
	{
		if ($this->input->post('user_password')) {
			$status		=	$this->aranax_auth->change_password(
				$_SESSION['AX_username'],
				$this->input->post('user_password')
			);
			if ($status) {
				$this->session->set_flashdata('success', 'Password changed successfully');
			} else {
				$this->session->set_flashdata('failure', 'Password change failed');
			}

			redirect("change-password");
		}


		$data["active_link"]	=	"dashboard";
		$data["page_title"]	=	"Change Password";
		$this->load->view("common/header", $data);
		$this->load->view("user/change_password", $data);
	}


	//list all users
	function index()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$data["users"]	=	$this->usermodel->list_all_users();


		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"All Users";
		$this->load->view("common/header", $data);
		$this->load->view("user/index", $data);
	}

	//view user
	function view($ref)
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$data["user"]	=	$this->usermodel->get_user_by_ref($ref);

		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"View User";
		$this->load->view("common/header", $data);
		$this->load->view("user/view", $data);
	}

	//edit user
	function edit($ref)
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$data["role_options"]	=	$this->authmodel->get_user_roles_option();
		$data["user"]			=	$this->usermodel->get_user_by_ref($ref);

		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"Edit User";
		$this->load->view("common/header", $data);
		$this->load->view("user/edit", $data);
	}













	//get user for typeahead
	function getUserTypeahead()
	{
		echo json_encode($this->usermodel->list_all_users());
	}

	//list users in JSON
	function getUsersAsJSON()
	{
		$user	=	array("data"	=>	$this->usermodel->list_all_users());
		echo json_encode($user);
	}


	//create user 
	function createuser()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		} else {
			if ($this->input->post('user_name')) {
				$status		=	$this->aranax_auth->create_user();
				if ($status) {
					$this->session->set_flashdata('success', 'User created successfully');
				} else {
					$this->session->set_flashdata('failure', 'User creation failed');
				}
			}
			redirect("user/index");
		}
	}

	//edit user
	function edituser($code = NULL)
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		} else {
			if (!empty($code)) {
				//get data 
				$data["user"]			=	$this->usermodel->get_user_by_username($code);
				$data["user_org"]		=	$this->usermodel->get_user_org_unit_by_username($code);
				$data["role_options"]	=	$this->aranax_auth->get_user_roles_option();

				$data["department_options"]		=	$this->configmodel->get_department_option();
				$data["branch_options"]			=	$this->configmodel->get_branch_option();
				$data["designation_options"]	=	$this->configmodel->get_designation_option();

				$data["active_link"]	=	"adminusers";
				$data["page_title"]	=	"Edit User";
				$this->load->view("common/header", $data);
				$this->load->view("user/edituser", $data);
			} else {
				if ($this->input->post('user_name', true)) {
					$status		=	$this->usermodel->update_user();
					if ($status) {
						$this->session->set_flashdata('success', 'User Profile updated successfully');
					} else {
						$this->session->set_flashdata('failure', 'User Profile updation failed');
					}
				}
				redirect("user/index");
			}
		}
	}

	//edit user org unit
	function editorgunit($code = NULL)
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		} else {
			if ($this->input->post('uo_dept_code', true)) {
				$status		=	$this->usermodel->update_user_org_unit();
				if ($status) {
					$this->session->set_flashdata('success', 'User Org Unit updated successfully');
				} else {
					$this->session->set_flashdata('failure', 'User Org Unit updation failed');
				}
			}
			redirect("user/index");
		}
	}
}