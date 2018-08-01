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
		$this->form_validation->set_rules('nombre_real', 'Nombre_real', 'required');
		$this->form_validation->set_rules('apellido_real', 'Apellido_real', 'required');
		$this->form_validation->set_rules('no_control', 'No_control', 'required');
		$this->form_validation->set_rules('tel', 'Tel', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('carrera', 'Carrera', 'integer|required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'integer|required');
		$this->form_validation->set_rules('talla', 'Talla', 'integer|required');
		$this->form_validation->set_rules('pro', 'Pro', 'integer|required');
		//reglas para subir imagenes
		date_default_timezone_set( 'America/Mazatlan' );
	}

	public function index(){
		/*$result = $this->Asistente_model->getAsistentes();
		$data = array('asistente'=>$result); *///Cargo los datos de la consulta de asistentes para mandarsela al panel_asistentes
		$datatitle['title']='Asistentes';
		$data['asistentes']=$this->Asistentes_model->getAsistentes();
		$this->load->view('backend/templates/header',$datatitle);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel_asistentes', $data);
		$this->load->view('backend/templates/footer');
	}

	public function add(){
        if(/*$this->form_validation->run()*/true){//La validacion del formulario fue exitosa
        	$data['nombre_real']=$this->input->post('nombre_real');
        	$data['apellido_real']=$this->input->post('apellido_real');
        	$data['no_control']=$this->input->post('no_control');
        	$data['tel']=$this->input->post('tel');
        	$data['email']=$this->input->post('email');
        	$data['carrera']=$this->input->post('carrera');
        	$data['sexo']=$this->input->post('sexo');
        	$data['talla']=$this->input->post('talla');
        	$data['pro']=$this->input->post('pro');

        	if($this->Asistentes_model->add($data)){
                $data['error']="ALL_OK";//el usuario fue agregado a la db sin problemas
                echo '<script language="javascript">';
                echo 'alert("Se agrego el asistente con exito")';
                echo '</script>';
            }
            else{
                $data['error']="NOT_CREATED";//ocurrio un error  
                echo '<script language="javascript">';
                echo 'alert("No fue posible agregar el asistente con exito")';
                echo '</script>';          
            }
            $this->index();
        }
        else{
            //La validacion no fue exitosa
        	$data['error']="BAD_POST";
        	echo '<script language="javascript">';
        	echo 'alert("Error en validación.")';
        	echo '</script>';

        }
        //JSON de respuesta 
        //echo json_encode($data);
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
    			$result_data = $Data_Asistente +  array('Id_Asistente' => $Id_Asistente
    		);         
    		}
    	}
    	return $result_data;
    }

    public function details(){
    	$id = $this->input->get('id');
        //$id = $this->input->post('id');
    	$resultado = $this->Asistentes_model->get_asistente_by_id($id);
    	$data['asistente'] = $resultado[0];
    	$data['title'] = 'Detalles del Asistente';
    	$this->load->view('backend/templates/header', $data);
    	$this->load->view('backend/templates/navbar');
    	$this->load->view('backend/asistente_details', $data);
    	$this->load->view('backend/templates/footer');
    }

    public function searchAsistenteByNc(){
    	$search=$this->input->post('dato');
        $asistente=$this->Asistentes_model->getAsistenteByNC($search);
        if (isset($asistente[0])) {
            $asistente=$asistente[0];
        }
    	echo json_encode($asistente);
    }

     public function searchAsistenteByName(){
    	$data['nombre_real']=$this->input->post('nombres');
    	$data['apellido_real']=$this->input->post('apellidos');
    	$asistente=$this->Asistentes_model->getAsistenteByNombre($data);
        if (isset($asistente[0])) {
            $asistente=$asistente[0];
        }
        echo json_encode($asistente);
    }
}
