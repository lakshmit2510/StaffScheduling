<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $route['default_controller'] = 'Login';
$route['default_controller'] = 'HomeScreen';
$route['Login'] = 'Login';

$route['Supplier'] = 'Users';
$route['Supplier/Add'] = 'Users/Add';
$route['Supplier/edit/(:any)'] = 'Users/Edit/$1';


$route['Supplier/Groups'] = 'Users/SupplierGroups';
$route['Supplier/Groups/add'] = 'Users/AddSupplierGroup';
$route['Supplier/Groups/post'] = 'Users/CreateSupplierGroup';
$route['Supplier/Groups/edit/(:any)'] = 'Users/EditSupplierGroup/$1';
$route['Supplier/Groups/update'] = 'Users/UpdateSupplierGroup';
$route['Supplier/Groups/delete/(:any)'] = 'Users/DeleteSupplierGroup/$1';

$route['404_override'] = 'Login/error_404';
$route['translate_uri_dashes'] = FALSE;
