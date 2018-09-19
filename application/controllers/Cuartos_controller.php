<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
			redirect(base_url());
			return;
		}
		$this->load->model('Cuartos_model');
		date_default_timezone_set( 'America/Mazatlan' );
		$this->load->library('Pdf');
	}

	public function crear_cuarto(){
		
	}
	
}