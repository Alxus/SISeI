<?php
class Api_controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		header('Content-type: application/json');
		header('Access-Control-Allow-Origin: *');
		$this->load->model('Asistentes_model');
		$this->load->model('Comentarios_model');
		$this->load->model('Conferencias_model');
		$this->load->model('Ponente_model');
		$this->load->model('Talleres_model');
	}

	public function checkuser(){
		$result  = NULL;
		$body=@file_get_contents("php://input");
		$post_json = json_decode($body,TRUE);
		$Fb_Link = $post_json['Fb_Link'];
		$Fb_Id = $post_json['Fb_Id'];
		$Fb_Name = $post_json['Fb_Name'];
		$Fb_FirstName = $post_json['Fb_FirstName'];
		$Id_Asistente=null;
		$request=array('facebook_id'=>$Fb_Id,'facebook_name'=>$Fb_Name,'facebook_first_name'=>$Fb_FirstName,'facebook_link'=>$Fb_Link);
		$datos_asistente=$this->_checkAsistente($request);

		if($datos_asistente != null){
			$result = $datos_asistente;
			$result['error'] = 'ALL_OK';
		}
		else{
			$result['error'] = 'Error-Fcheckuser-1';
		}
		echo json_encode($result);
	}

	public function _checkAsistente($Data_Asistente){ 
		$Fb_Id = $Data_Asistente['facebook_id'];
		$result_data  = NULL;
		$Id_Asistente = NULL;
		$lista_Insignias = NULL;
		$Masterkeys = NULL;
		$asistente = $this->Asistentes_model->exist_Asistente($Fb_Id);
		if($asistente != NULL){
			$Id_Asistente = $asistente['id'];
			$result_data = $asistente + array('Id_Asistente' => $Id_Asistente,); 
		}
		else{
			$Data_Asistente['created_at'] = date('Y-m-d H:i:s');
			$registro = $this->Asistentes_model->ingresar_Asistente($Data_Asistente);
			if($registro['affected_rows'] > 0){
				$Id_Asistente = $registro['Id_Asistente'];
				$result_data = $Data_Asistente +  array('Id_Asistente' => $Id_Asistente);         
			}
		}
		return $result_data;
	}

	public function get_asistente_by_id($id,$cid){
		echo json_encode($this->Asistentes_model->get_asistente_by_id($id,$cid));
	}

	public function crear_comentario(){
		$body = file_get_contents("php://input");
		$data = json_decode($body,TRUE);
		$this->Comentarios_model->create_coment($data);
		echo json_encode($data);	
	}

	public function get_conferencias(){
		echo json_encode($this->Conferencias_model->get());
	}

	public function get_ponentes(){
		echo json_encode($this->Ponente_model->get_ponentes());
	}

	public function get_talleres(){
		echo json_encode($this->Talleres_model->get_talleres());
	}
}