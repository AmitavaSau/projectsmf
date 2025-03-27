<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aranax extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('Aranax_Auth', 'session');
		$this->load->model('configmodel');

		if(!isset($_SESSION['config_texts'])) {
			$_SESSION['config_texts'] = $this->configmodel->get_config_texts();
		}
		
		//print_r($_SESSION['config_texts']);
		
		/*//check for global configs
		$info	=	$this->aranax_auth->get_apartment_info();
		if (!$info) {
			show_404();
		}
		else {
			if($_SESSION['global']->apt_activation_expiry != NULL) {
				$d1	=	strtotime($_SESSION['global']->apt_activation_expiry);
				$d2	=	strtotime(date("Y-m-d H:i:s"));
				$diff = $d1 - $d2;
					
				if($diff <= 0){
					show_404();
				}
			}
			
		}*/
	}
}