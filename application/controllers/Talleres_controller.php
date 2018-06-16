<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talleres_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Talleres_model');
		//Reglas para validar formularios.
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('requisitos', 'Requisitos', 'required');
		$this->form_validation->set_rules('lugar', 'Lugar', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('hora', 'Hora', 'required');
		$this->form_validation->set_rules('limite', 'Limite', 'integer|required');
		$this->form_validation->set_rules('nivel', 'Nivel', 'integer|required');
		$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_rules('icono', 'Icono', 'required');
		//reglas para subir imagenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
		$config['remove_spaces'] = TRUE;
		$this->upload->initialize($config);
	}
	
	public function index(){
		$data['title']='Talleres';
		$data['talleres']=$this->Talleres_model->get_talleres();
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/lista_talleres');
		$this->load->view('backend/templates/footer');
	}

	public function create_taller(){
		if($this->form_validation->run()){
			$data['ponente_id']=0;
			$data['nombre']=$this->input->post('nombre');
			$data['descripcion']=$this->input->post('descripcion');
			$data['requisitos']=$this->input->post('requisitos');
			$data['lugar']=$this->input->post('lugar');
			$data['fecha']=$this->input->post('fecha');
			$data['hora']=$this->input->post('hora');
			$data['limite']=$this->input->post('limite');
			$data['nivel']=$this->input->post('nivel');
			if($this->upload->do_upload('btnimg')){
				$data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
				if($this->upload->do_upload('btnicon')){
					$data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
					if($this->Talleres_model->create_taller($data)){
						$data['error']="ALL_OK";
					}
					else{
						$data['error']="NOT_CREATED";
					}
				}
				else{
					$data['error']=$this->upload->display_errors();
				}
			}
			else{
				$data['error']=$this->upload->display_errors();
			}
		}
		else{
			$data['error']="BAD_POST";
		}
		echo json_encode($data);
	}

	public function lista_talleres(){
		echo json_encode($this->Talleres_model->get_talleres());
	}
}