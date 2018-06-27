<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
			redirect('admin');
		}
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('usuario_model');
		
	}
	
	public function index(){
		$data['title']='Panel de ventas';
		//Pasamos esta variable como parametro al header para darle titulo a la pagina
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar_ventas');
		$this->load->view('backend/panel_ventas');
		$this->load->view('backend/templates/footer');
	}

}