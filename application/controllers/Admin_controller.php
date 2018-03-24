<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Usuario_model');
		//Reglas para validar formularios.
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'trim|required');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
	}
	
	public function index(){
		$data['title']='Login Admin';
		//Pasamos esta variable como parametro al header para darle titulo a la pagina
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel');
		$this->load->view('backend/templates/footer');
	}

	public function vista_usuarios(){
		$this->load->view('backend/templates/header');
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/formulario_usuarios');
		$this->load->view('backend/templates/footer');
	}
	//Metodo para crear un usuario del sistema.
	public function create_user(){
		if($this->form_validation->run()){//La validacion del formulario fue exitosa
			$data['username']=$this->input->post('username');
			$data['password']=$this->input->post('password');
			$data['tipo']=$this->input->post('tipo');
			$data['nombres']=$this->input->post('nombres');
			$data['apellidos']=$this->input->post('apellidos');
			if($this->Usuario_model->create_user($data)){
				$data['error']="ALL_OK";//el usuario fue agregado a la db sin problemas
			}
			else{
				$data['error']="NOT_CREATED";//ocurrio un error
			}
		}
		else{
			//La validacion no fue exitosa
			$data['error']="BAD_POST";
			redirect("admin");
		}
		//JSON de respuesta
		echo json_encode($data);
	}
}