<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'examMarks/student_marks_show';
$route['404_override'] = 'auth/notfound';
$route['translate_uri_dashes'] = FALSE;

$route['unauthorised']    =    'auth/unauthorised';

$route['logout']            =    'auth/logout';
$route['dashboard']            =    'user/dashboard';
$route['change-password']    =    'user/change_password';
$route['forgot-password']    =    'user/forgot_password';
$route['activity-log/?(:any)?']        =    'reports/activity_log/$1';

$route['allocation']        =    'counsel/allocation';

/*$route['counsel/identification']		=	'counsel/step_01';
$route['counsel/domicile']				=	'counsel/step_02';
$route['counsel/academic']				=	'counsel/step_03';

$route['counsel/get_application']		=	'counsel/get_application';
$route['counsel/set_element_verify']	=	'counsel/set_element_verify';

*/
$route['smf-login']                =    'auth/smf_authenticate';
$route['college-login']                =    'auth/college_authenticate';
$route['verification']        =    'counsel/verification';
$route['users']                        =    'user/index';
$route['users/(:any)']                =    'user/view/$1';
$route['users/edit/(:any)']            =    'user/edit/$1';

$route['roles']                        =    'auth/roles';
$route['roles/save']                =    'auth/save_role';

$route['permissions/(:any)']        =    'auth/permissions/$1';

$route['output/(:any)']                =    'reports/seat_availability/$1';
$route['seat/(:any)']                =    'reports/seat/$1';

$route['reports/seat-status']        =    'reports/seat_status';
$route['reports/college-wise-students']    =    'reports/college_wise_students';
$route['reports/academic']                =    'reports/step_03';