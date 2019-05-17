<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session');
$autoload['drivers'] = array();
$autoload['helper'] = array('url');
$autoload['config'] = array('');
$autoload['model'] = array('Chat/Chat_ressources', 'Database_transform', 'UserManagement/User_error', 'Interface_ressources', 'Password', 'UserManagement/User_managment', 'UserManagement/User_ressources');
// FAUT PAS TOUT CHARGER AU DEBUT 