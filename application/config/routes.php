<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//Default Route
$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// API Route
//$route['user/get/(:any)'] = 'Users/Userdata/getinfo/$1'; //Exemple de comment on peut recuperer les donner d'un user

//Basic Routing
//$route['profile/("any)'] = "Users/Userdata/profile/$1"; //autre exemple de comment on peut recup les donner d'un user sans API
