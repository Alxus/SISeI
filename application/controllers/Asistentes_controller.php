<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistentes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
			redirect('admin');
		}
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Asistentes_model');
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

	public function index(){
		/*$result = $this->Asistente_model->getAsistentes();
		$data = array('asistente'=>$result); *///Cargo los datos de la consulta de asistentes para mandarsela al panel_asistentes
		$datatitle['title']='Talleres';
		//$data['talleres']=$this->Talleres_model->get_talleres();
		$this->load->view('backend/templates/header',$datatitle);
		$this->load->view('backend/templates/navbar');
		echo "Seccion pendiente, esperese al otro viernes joven :v";
		//$this->load->view('backend/panel_asistentes',$data);
		$this->load->view('backend/templates/footer');
	}


	public function checkuser(){
		$result  = NULL;
		$Fb_Link = $this->input->post('Fb_Link');
		$Fb_Id = $this->input->post('Fb_Id');
		$Fb_Name = $this->input->post('Fb_Name');
		$Fb_FirstName = $this->input->post('Fb_FirstName');
		$Id_Asistente=null;
		$data_request = array( 'facebook_id' => $Fb_Id,'facebook_name' => $Fb_Name,
			'facebook_first_name' => $Fb_FirstName, 'facebook_link' => $Fb_Link
		);
		$datos_asistente = $this->_checkAsistente($data_request);
		if( $datos_asistente != null){
			$result = $datos_asistente;
			$result['error'] = 'ALL_OK';
		}
		else
			$result['error'] = 'Error-Fcheckuser-1';
		echo json_encode($result);
	}

	public function _checkAsistente($Data_Asistente){ 
		$Fb_Id = $Data_Asistente['facebook_id'];
		$result_data  = NULL;
		$Id_Asistente = NULL;
		$lista_Insignias = NULL;
		$Carnet = array();
		$Masterkeys = NULL;

		$asistente = $this->Asistentes_model->exist_Asistente($Fb_Id);

		if( $asistente != NULL ){
			$Id_Asistente    =  $asistente['id'];
			$result_data = $asistente +  array(
				'Id_Asistente' => $Id_Asistente,
			); 
		}else{
			$Data_Asistente['created_at'] = date('Y-m-d H:i:s');
			$registro = $this->Asistentes_model->ingresar_Asistente($Data_Asistente);
			if($registro['affected_rows'] > 0 ){
				$Id_Asistente = $registro['Id_Asistente'];
				$result_data = $Data_Asistente +  array('Id_Asistente' => $Id_Asistente,
					'carnet' => $Carnet
				);         
			}
		}
		return $result_data;
	}
}
