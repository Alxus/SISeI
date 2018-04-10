<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Asistente_model');
		//Reglas para validar formularios.
		$this->form_validation->set_rules('nombre_real', 'Nombre_real', 'trim|required');
		$this->form_validation->set_rules('apellido_real', 'Apellido_real', 'required');
		$this->form_validation->set_rules('no_control', 'No_control', 'required');
		$this->form_validation->set_rules('tel', 'Tel', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('carrera', 'Carrera', 'integer|required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'integer|required');
		$this->form_validation->set_rules('created_at', 'Created_at', 'required');
		$this->form_validation->set_rules('updated_at', 'Updated_at', 'required');
		//reglas para subir imagenes
		
	}

	public function index()
	{
		$result = $this->Asistente_model->getAsistentes();
		$data = array('asistente'=>$result); //Cargo los datos de la consulta de asistentes para mandarsela al panel_asistentes
		$datatitle['title']='Talleres';
		$data['talleres']=$this->Talleres_model->get_talleres();
		$this->load->view('backend/templates/header',$datatitle);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel_asistentes',$data);
		$this->load->view('backend/templates/footer');
	}
}
