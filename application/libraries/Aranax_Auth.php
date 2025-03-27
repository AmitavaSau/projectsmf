<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authenticate Class
 *
 * Authentication library for Code Igniter.
 *
 * @author		Sanjoy Chowdhury
 * @version		1.0.1
 */

class Aranax_Auth
{

	function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->library('session');
		$this->ci->load->helper('form');
		$this->ci->load->config('aranax_config');
		$this->ci->load->database();
	}

	//generate salt
	function _get_hashsalt($password)
	{
		$options = [
			'cost' => 11,
			/*  'salt' => $this->ci->config->item('aranax_salt'),*/
		];
		$hashAndSalt	=	password_hash($password, PASSWORD_BCRYPT, $options);

		return $hashAndSalt;
	}

	//encrypt password
	function _encrypt_password($password)
	{
		$majorsalt = $this->ci->config->item('aranax_salt');
		$_pass = str_split($password);
		// encrypts every single letter of the password
		foreach ($_pass as $_hashpass) {
			$majorsalt .= md5($_hashpass);
		}
		return md5($majorsalt);
	}

	function _set_session($data)
	{
		// set session data array
		$user = array(
			'AX_username'				=> $data->user_name,
			'AX_user_ref'				=> $data->user_ref,
			'AX_user_firstname'			=> $data->user_firstname,
			'AX_user_midname'			=> $data->user_midname,
			'AX_user_lastname'			=> $data->user_lastname,
			'AX_user_photo'				=> $data->user_photo,
			'AX_role_id'				=> $data->user_role_id,
			'AX_logged_in'				=> TRUE
		);

		$this->ci->session->set_userdata($user);
	}

	//create new user
	function create_user()
	{
		$this->ci->load->model('usermodel');
		$user	=	array(
			'user_role_id'	=>	$this->ci->input->post('user_role_id'),
			'user_name'		=>	$this->ci->input->post('user_name'),
			'user_password'	=>	$this->_encrypt_password($this->ci->input->post('user_password')),
			'user_firstname' =>	$this->ci->input->post('user_firstname'),
			'user_midname'	=>	$this->ci->input->post('user_midname'),
			'user_lastname'	=>	$this->ci->input->post('user_lastname'),
			'user_email'	=>	$this->ci->input->post('user_email'),
			'user_mobile'	=>	$this->ci->input->post('user_mobile'),
			'user_is_active' =>	1,
			'user_created'	=>	date('Y-m-d H:i:s')
		);
		return $this->ci->usermodel->create_user($user);
	}

	//change password
	function change_password($username, $newpass)
	{
		$this->ci->load->model('usermodel');
		$user	=	array(
			'user_password'	=>	$this->_encrypt_password($newpass)
		);
		return $this->ci->usermodel->change_password($user, $username);
	}

	//authenticate user
	function authenticate_user($username, $password)
	{
		$this->ci->load->model('authmodel');
		$row = $this->ci->authmodel->authenticate_user($username, $password);

		if (!is_null($row)) {
			if (password_verify($this->_encrypt_password($password), $this->_get_hashsalt($row->user_password))) {
				// log in user 
				$this->_set_session($row);
				return true;
			} else {
				return false;
			}
		}
	}

	// check if user is logged in
	function is_logged_in()
	{
		return $this->ci->session->userdata('AX_logged_in');
	}

	//check user access
	function has_access()
	{
		$controller	=	$this->ci->router->fetch_class();
		$action		=	$this->ci->router->fetch_method();
		$url		=	$controller . "/" . $action;

		$this->ci->load->model('authmodel');
		$row	=	$this->ci->authmodel->has_access($this->ci->session->userdata('AX_role_id'), $url);
		if (!is_null($row)) {
			return true;
		}

		return false;
	}

	/**
	 * *******************
	 * CANDIDATE SPECIFIC ACTIONS
	 * *******************
	 */

	function _set_candidate_session($data)
	{
		// set session data array
		$candidate = array(
			'AXC_appl_num'			=> $data->appl_num,
			'AXC_candidate_name'	=> $data->appl_fullname,
			'AXC_candidate_photo'	=> $data->appl_photo,
			'AXC_logged_in'			=> TRUE
		);

		$this->ci->session->set_userdata($candidate);
	}

	// check if candidate is logged in
	function is_candidate_logged_in()
	{
		return $this->ci->session->userdata('AXC_logged_in');
	}

	//authenticate candidate
	function authenticate_candidate($appl_num, $appl_dob, $appl_passwd)
	{
		$this->ci->load->model('candidatemodel');
		$row = $this->ci->candidatemodel->authenticate_candidate($appl_num, $appl_dob);

		if (!is_null($row)) {
			if (password_verify($this->_encrypt_password($appl_passwd), $this->_get_hashsalt($row->appl_passwd))) {
				// log in candidate 
				$this->_set_candidate_session($row);
				return true;
			} else {
				return false;
			}
		}
	}

	//authenticate college user
	function authenticate_clg_user($username, $password)
	{
		$this->ci->load->model('authmodel');
		$row = $this->ci->authmodel->authenticate_user($username, $password);
		//echo '<pre>';print_r($row); exit();
		if (!is_null($row)) {
			if ($password == $row->user_password) {
				$this->_set_session($row);

				return true;
			} else {

				return false;
			}
		}
	}
}