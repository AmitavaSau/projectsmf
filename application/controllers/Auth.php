<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Aranax
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('Aranax_Auth');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('aranax');
		$this->load->model('authmodel');
	}

	//not found
	function notfound()
	{
		$data["active_link"]	=	"dashboard";
		$data["page_title"]		=	"Page Not Found";
		$this->load->view("common/header", $data);
		$this->load->view("auth/notfound", $data);
	}

	function index()
	{
		$this->authenticate();
	}

	//user authentication
	function authenticate()
	{
		//$this->output->enable_profiler(TRUE);		
		$data['auth_error_message']	=	"";
		if (!$this->aranax_auth->is_logged_in()) {
			if ($this->input->post('username')) {
				if ($this->aranax_auth->authenticate_user($this->input->post('username'), $this->input->post('password'))) {

					redirect("dashboard");
				} else {
					$data['auth_error_message'] = "Either your username and/or password does not match";
				}
			}
		} else {
			redirect("dashboard");
		}


		$data["page_title"]	=	"Authenticate User";
		$this->load->view("auth/login_form", $data);
	}

	//logout
	function logout()
	{
		session_destroy();
		if ($_SESSION['AX_role_id'] == '10') {
			redirect('college-login');
		} else if ($_SESSION['AX_role_id'] == '9') {
			redirect('smf-login');
		} else {
			redirect("/auth/authenticate/");
		}
	}

	//roles
	function roles()
	{
		//$this->output->enable_profiler(TRUE);
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$data['roles']	=	$this->authmodel->get_user_roles();
		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"User Roles";
		$this->load->view("common/header", $data);
		$this->load->view("auth/roles", $data);
	}


	//create url
	function create_url()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			echo json_encode(array(
				'error' => true,
				'msg' => 'Unauthorised Access',
				'token'	=>	$this->security->get_csrf_hash()
			));
		} else {
			$url_group			=	$_POST['url_group'];
			$url_name			=	$_POST['url_name'];
			$url_description	=	$_POST['url_description'];

			if (($url_group != '') && ($url_name != '') && ($url_description != '')) {
				$status		=	$this->aranax_auth->create_auth_url(
					$url_group,
					$url_name,
					$url_description
				);

				if ($status) {
					echo json_encode(array(
						'error'	=>	false,
						'msg'	=> 	'URL created successfully',
						'token'	=>	$this->security->get_csrf_hash()
					));
				} else {
					echo json_encode(array(
						'error'	=>	true,
						'msg'	=> 	'URL creation failed',
						'token'	=>	$this->security->get_csrf_hash()
					));
				}
			}
		}
	}

	//load urls
	function load_urls()
	{
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			echo json_encode(array(
				'error' => true,
				'msg' => 'Unauthorised Access',
				'token'	=>	$this->security->get_csrf_hash()
			));
		} else {
			$module_name	=	$_POST['module'];
			$role_id		=	$_POST['role_id'];
			$result			=	$this->authmodel->get_auth_urls_by_role($role_id, $module_name);
			if (count($result) > 0) {
				echo json_encode(array(
					'error'	=>	false,
					'data'	=> 	$result,
					'token'	=>	$this->security->get_csrf_hash()
				));
			} else {
				echo json_encode(array(
					'error'	=>	true,
					'token'	=>	$this->security->get_csrf_hash()
				));
			}
		}
	}

	//permissions
	function permissions($role_ref)
	{
		//$this->output->enable_profiler(TRUE);
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		$role	=	$this->authmodel->get_role_by_ref($role_ref);

		$data['role']	=	$role;
		$data["selected_role"]	=	$role->role_id;
		$data["module_options"]	=	$this->authmodel->get_url_group_as_option();

		$data["active_link"]	=	"configs";
		$data["page_title"]	=	"User Permissions";
		$this->load->view("common/header", $data);
		$this->load->view("auth/permissions", $data);
	}

	//assign permission
	function save_permission()
	{
		//$this->output->enable_profiler(TRUE);
		if (!$this->aranax_auth->is_logged_in() || !$this->aranax_auth->has_access()) {
			redirect("unauthorised");
		}

		if ($this->input->post('module_name') && $this->input->post('hidden_role_id') && $this->input->post('hidden_acl')) {
			if ($this->authmodel->assign_access(
				$this->input->post('module_name'),
				$this->input->post('hidden_role_id'),
				$this->input->post('hidden_acl')
			)) {
				redirect("permissions/" . $this->input->post('hidden_role_ref'));
			}
		}
	}

	//unauthorised
	function unauthorised()
	{
		if (!$this->aranax_auth->is_logged_in()) {
			redirect("auth/authenticate");
		}
		$data["active_link"]	=	"dashboard";
		$data["page_title"]	=	"Unauthorised Access";
		$this->load->view("common/header", $data);
		$this->load->view("auth/unauthorised", $data);
	}



	//college login
	function college_authenticate()
	{
		//session_destroy();
		//redirect("/auth/authenticate/");

		$data['auth_error_message']	=	"";
		if (!$this->aranax_auth->is_logged_in()) {
			if ($this->input->post('username')) {
				if ($this->aranax_auth->authenticate_clg_user($this->input->post('username'), $this->input->post('password'))) {

					redirect("dashboard");
				} else {
					$data['auth_error_message'] = "Either your username and/or password does not match";
				}
			}
		} else {
			redirect("dashboard");
		}


		$data["page_title"]	=	"Authenticate User";
		$this->load->view("auth/college_login_form", $data);
	}

	//smf login
	function smf_authenticate()
	{
		//session_destroy();
		//redirect("/auth/authenticate/");

		$data['auth_error_message']	=	"";
		if (!$this->aranax_auth->is_logged_in()) {
			if ($this->input->post('username')) {
				if ($this->aranax_auth->authenticate_clg_user($this->input->post('username'), $this->input->post('password'))) {

					redirect("dashboard");
				} else {
					$data['auth_error_message'] = "Either your username and/or password does not match";
				}
			}
		} else {
			redirect("dashboard");
		}


		$data["page_title"]	=	"Authenticate User";
		$this->load->view("auth/smf_login_form", $data);
	}
}