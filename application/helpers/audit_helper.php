<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('audit_trail'))
{
    function audit_trail($msg) {
        $ci=& get_instance();
		$ci->load->database();
		
		$at_table	=	'user_audit_trail';
		
		$data		=	array(
								'at_message'	=>	$msg,
								'at_user'		=>	$_SESSION['AX_username'],
								'at_date'		=>	date('Y-m-d H:i:s'),
								'at_ip'			=>	$_SERVER['REMOTE_ADDR']
							);
		$ci->db->insert($at_table, $data);
    }   
}