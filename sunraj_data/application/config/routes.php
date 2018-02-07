<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user/index';
$route['404_override'] = '';

/*admin*/
$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/privacy'] = 'user/privacy';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';

$route['admin/labours'] = 'admin_products/index';
$route['admin/labours/add'] = 'admin_products/add';
$route['admin/labours/update'] = 'admin_products/update';
$route['admin/labours/update/(:any)'] = 'admin_products/update/$1';
$route['admin/labours/updatestatus/(:any)'] = 'admin_products/updatestatus/$1';
$route['admin/labours/delete/(:any)'] = 'admin_products/delete/$1';
$route['admin/export'] = 'admin_products/export';

$route['admin/labours/listattendance'] = 'admin_products/listattendance';
$route['admin/labours/listattendance/(:any)'] = 'admin_products/listattendance/$1';
$route['admin/labours/(:any)'] = 'admin_products/index/$1'; //$1 = page number
$route['admin/labours/addsalary'] = 'admin_products/addsalary'; 

$route['admin/supervisers'] = 'admin_manufacturers/index';
$route['admin/supervisers/add'] = 'admin_manufacturers/add';
$route['admin/supervisers/update'] = 'admin_manufacturers/update';
$route['admin/supervisers/update/(:any)'] = 'admin_manufacturers/update/$1';
$route['admin/supervisers/delete/(:any)'] = 'admin_manufacturers/delete/$1';
$route['admin/supervisers/(:any)'] = 'admin_manufacturers/index/$1'; //$1 = page number

$route['admin/supervisers/addshifttime'] = 'admin_manufacturers/addshifttime';
$route['admin/notification/listnotification'] = 'admin_manufacturers/listnotification';
$route['admin/notification/deletenotification/(:any)'] = 'admin_manufacturers/deletenotification/$1';
$route['admin/notification/updatestatus/(:any)'] = 'admin_manufacturers/updatestatus/$1';
$route['admin/notification/listnotification/(:any)'] = 'admin_manufacturers/listnotification/$1';
$route['admin/hoildaynotification'] = 'admin_manufacturers/hoildaynotification';
$route['admin/shift/listshift'] = 'admin_manufacturers/listshift';
$route['admin/shift/listshift/updateshift/(:any)'] = 'admin_manufacturers/updateshift/$1';
$route['admin/shift/listshift/deleteshift/(:any)'] = 'admin_manufacturers/deleteshift/$1';
$route['admin/shift/listshift/(:any)'] = 'admin_manufacturers/listshift/$1';

$route['admin/payment/listpayment'] = 'admin_manufacturers/listpayment';
$route['admin/payment/supervisorajax'] = 'admin_manufacturers/supervisorajax';
$route['admin/payment/addpayment'] = 'admin_manufacturers/addpayment';
$route['webservices'] ='webservicecontroller/getName';


/* End of file routes.php */
/* Location: ./application/config/routes.php */