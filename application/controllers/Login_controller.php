<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
	}
	
	public function index(){
		if(!$this->authentication->check_user()){
			$data['title']='Login Admin';
			$this->load->view('backend/templates/header',$data);
			$this->load->view('backend/login');
			$this->load->view('backend/templates/footer');
		}
		else{
			redirect('admin/panel');
		}
	}

	public function login(){
		if($this->form_validation->run()){
			$data['username']=$this->input->post('username');
			$data['password']=$this->input->post('password');
			if($this->authentication->login($data)){
				$data['error']='ALL_OK';
			}
		}
		else{
			$data['error']='BAD_LOGIN';
		}
		echo json_encode($data);
	}

	public function logout(){
		$this->authentication->logout();
		redirect('admin');
	}
}
