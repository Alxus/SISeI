<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'Login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Rutas Panel
$route['login']['POST']='Login_controller/login/$data';
$route['logout']='Login_controller/logout';
$route['admin/panel']='Admin_controller';
$route['admin/panel/usuarios']='Admin_controller/vista_usuarios';
$route['admin/panel/']='Admin_controller/vista_usuarios';
$route['admin/create_user']['POST']='Admin_controller/create_user/$data';
$route['pago']='Pagos_controller';
$route['admin/panel/talleres']='Talleres_controller';
$route['admin/create_taller']='Talleres_controller/create_taller/$data';
$route['admin/update_taller']='Talleres_controller/editar_taller/$data';
$route['admin/panel/talleres/info/(:num)']='Talleres_controller/info/$1';
$route['admin/panel/talleres/editar/(:num)']='Talleres_controller/edit/$1';

$route['admin/panel/ponentes']='Ponentes_controller'; 
$route['admin/create_ponente']='Ponentes_controller/add/$data'; 
$route['admin/update_ponente']='Ponentes_controller/edit/$data'; 

$route['admin/panel/carnets']='Carnets_controller'; 
$route['admin/create_carnet']='Carnets_controller/add/$data'; 
$route['admin/update_carnet']='Carnets_controller/edit/$data'; 

$route['admin/panel/asistentes']='Asistentes_controller'; 
$route['admin/create_asistente']='Asistentes_controller/add/$data'; 
$route['admin/asistente_details']='Asistentes_controller/details/$data';
/*$route['admin/update_carnet']='Asistentes_controller/edit/$data'; */

$route['admin/panel/conferencia']='Conferencias_controller';
$route['admin/create_conferencia']='Conferencias_controller/add/$data'; 
$route['admin/update_conferencia']='Conferencias_controller/edit/$data'; 

$route['admin/panel/asistentes']='Asistentes_controller';
$route['admin/panel/usrlst']='Admin_controller/lista_usuarios';
//Panel de ventas
$route['admin/panel/ventas']='Ventas_controller'; 
$route['admin/panel/ventas/Abono']['POST']='Ventas_controller/Abono/$data'; 
$route['admin/searchAsistenteByNC']['POST']='Asistentes_controller/searchAsistenteByNc/$data'; 
$route['admin/searchAsistenteByName']['POST']='Asistentes_controller/searchAsistenteByName/$data';
$route['admin/panel/ventas/pdf']='Ventas_controller/printComprobante'; 
//Comentarios



//Listas
$route['admin/panel/talleres/pdf']='Talleres_controller/printlst';
$route['admin/panel/usrlst/pdf']='Admin_controller/printlst';
$route['admin/panel/asistentes/pdf']='Asistentes_controller/printlst';
$route['admin/panel/conferencias/pdf']='Conferencias_controller/printlst';
$route['admin/panel/ponentes/pdf']='Ponentes_controller/printlst';
$route['admin/panel/taller/pdf/(:num)']='Talleres_controller/printlstA/$1';


//RUTAS API
$route['api/checkuser']['POST']='Api_controller/checkuser/$data';
$route['api/get_asistente/(:num)/(:num)']='Api_controller/get_asistente_by_id/$1/$2';
$route['api/coment']['POST']='Api_controller/crear_comentario/$data'; 
$route['api/get_conferencias']='Api_controller/get_conferencias';
$route['api/get_talleres']='Api_controller/get_talleres';
$route['api/get_ponentes']='Api_controller/get_ponentes';


