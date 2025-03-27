<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getHostURL')) {
	function getHostURL($domain) {
		//$url = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https' : 'http';
    	$url = 'http://'. $domain . '/';
    	return $url;
	}
}		

if ( ! function_exists('getFileLocation')) {
	function getFileLocation($type) {
		$ci=& get_instance();
		$path = "";
		if($type == "login-bg") {
			$path	=	"upload/bg/";
		}
		elseif($type == "logo") {
			$path	=	"upload/staff/signature/logo.png";
		}
		elseif($type == "registrar-signature") {
			$path	=	"upload/staff/signature/";
		}
		elseif($type == "candidate-profile") {
			$path	=	"upload/students/profile/";
		}
		elseif($type == "candidate-signature") {
			$path	=	"upload/students/signature/";
		}
		elseif($type == "user-profile") {
			$path	=	"upload/staff/profile/";
		}
		if($type == "candidate-profile") {
			return 'https://assets.formflix.org/smfwb/';  
		}else{
			return $ci->config->base_url() . $path;
		}
		
	}
}	

if ( ! function_exists('getFormatedFileSize')) {
	function getFormatedFileSize($bytes) {
		$types = array( 'bytes', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
            return( round( $bytes, 2 ) . " " . $types[$i] );
	}
}

if ( ! function_exists('formatDate')) {
	function formatDate($date, $fromFormat = 'Y-m-d', $toFormat = 'd-m-Y'){
		if( ($date == null) || ($date == '') || ($date == '0000-00-00') || (strpos($date, '0000-00-00') > 0) ) {
			return '';
		}
		else {
			$dt = new DateTime();
			$datetime = $dt -> createFromFormat($fromFormat, $date) -> format($toFormat);
			return $datetime;
		}
		
	}
}

if ( ! function_exists('convertToMySqlDate')) {
	function convertToMySqlDate($date, $fromFormat = 'd-m-Y', $toFormat = 'Y-m-d'){
		if( ($date == null) || ($date == '') || ($date == '0000-00-00') || (strpos($date, '0000-00-00') > 0) ) {
			return '';
		}
		else {
			$dt = new DateTime();
			$datetime = $dt -> createFromFormat($fromFormat, $date) -> format($toFormat);
			return $datetime;
		}	
	}
}

if ( ! function_exists('showFileIcon')) {
	function showFileIcon($type){
		$icon	=	"";
		if($type == "application/pdf") {
			$icon	=	"<i class='fa fa-file-pdf-o'></i>";
		}
		elseif( ($type == "application/msword") || ($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") ) {
			$icon	=	"<i class='fa fa-file-word-o'></i>";
		}
		elseif( ($type == "application/vnd.ms-excel") || ($type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") ) {
			$icon	=	"<i class='fa fa-file-excel-o'></i>";
		}
		elseif( ($type == "application/vnd.ms-powerpoint") || ($type == "application/vnd.openxmlformats-officedocument.presentationml.presentation") ) {
			$icon	=	"<i class='fa fa-file-powerpoint-o'></i>";
		}
		elseif( ($type == "image/jpeg") || ($type == "image/png") || ($type == "image/gif") ) {
			$icon	=	"<i class='fa fa-file-image-o'></i>";
		}
		else {
			$icon	=	"<i class='fa fa-file-o'></i>";
		}
		
		return $icon;
		
	}
}

if ( ! function_exists('firstNwords')) {
	function firstNwords($text, $length = 200, $dots = true){
		$text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
		$text_temp = $text;
		while(substr($text, $length, 1) != " "){ $length++;
			if($length > strlen($text)){
				break;
			}
		}
		$text = substr($text, 0, $length);
		return $text . (($dots == true && $text != '' && strlen($text_temp) > $length) ? ' ...' : '');
	}
}

if( !function_exists('checkArrayExsist')) {
	function checkArrayExsist($value, $array, $key) {
		if(array_search($value, array_column($array, $key)) !== false) {
			return true;
		}
		else {
		   return false;
		}
	}
}

if( !function_exists('generateRandomNumber')) {
	function generateRandomNumber($len) {
	    $str = '';
	    $a = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
	    $b = str_split($a);
	    for ($i=1; $i <= $len ; $i++) { 
	        $str .= $b[rand(0,strlen($a)-1)];
	    }
	    return $str;
	}	
}

if( !function_exists('getFormatedAmount')) {
	function getFormatedAmount($val) {
		return number_format($val, 2, '.', ',');
	}
}	

if( !function_exists('checkURLAccess')) {
	function checkURLAccess($url) {
		$has_access = false;
		foreach($_SESSION['AX_permission'] as $p) {
			if($p['url_name'] == $url) {
				$has_access	=	true;
				break;
			}
		}
		return $has_access;
	}
}	

if( !function_exists('getTimeFormat')) {
	function getTimeFormat($time, $fromFormat = 'H:i:s', $toFormat = 'h:i A'){
		$dt = new DateTime();
		$datetime = $dt -> createFromFormat($fromFormat, $time) -> format($toFormat);
		return $datetime;
	}
}		

if( !function_exists('getCategoryName')) {
	function getCategoryName($val) {
		$category = "";
		if(strtoupper($val) == 'GE') {
			$category = "GENERAL";
		}
		elseif(strtoupper($val) == 'SC') {
			$category = "SC";
		}
		elseif(strtoupper($val) == 'ST') {
			$category = "ST";
		}
		elseif(strtoupper($val) == 'OA') {
			$category = "OBC-A";
		}
		elseif(strtoupper($val) == 'OB') {
			$category = "OBC-B";
		}
		elseif(strtoupper($val) == 'PW') {
			$category = "PH";
		}elseif(strtoupper($val) == 'EWS') {
			$category = "EWS";
		}
		
		return $category;
	}
}	

if ( ! function_exists('blankSignature')) {
	function blankSignature() {
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJoAAAA0CAIAAAD9i7beAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAACtSURBVHhe7dwxDoAgEABB8P9/xkIKY/wAm5nGUG+OYHNzrTWouPaXBDlT5EyRM2U/heacz5njvB+zpjNFzpTvZes39BS/yUxnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnipwpcqbImSJnijVRx7O5JEvOFOuJU0xnipwhY9x+vxtVt50cKgAAAABJRU5ErkJggg==";
  	}
}