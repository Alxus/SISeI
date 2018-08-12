<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentarios_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Comentarios_model');
	}
	
	public function index(){
		
	}

	public function create(){
		$body = file_get_contents("php://input");
		$data = json_decode($body,TRUE);
		$this->Comentarios_model->create_coment($data);
		echo json_encode($data);	
	}
}