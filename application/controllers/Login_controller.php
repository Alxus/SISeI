<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->view('backend/templates/header');
		$this->load->view('backend/login');
		$this->load->view('backend/templates/footer');
	}
}
