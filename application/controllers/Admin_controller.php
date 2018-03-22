<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->view('backend/templates/header');
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel');
		$this->load->view('backend/templates/footer');
	}
}
