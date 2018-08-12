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
		date_default_timezone_set( 'America/Mazatlan' );
		$this->load->library('Pdf');
	}
	
	public function index(){
		if(!$this->authentication->check_user()){
      redirect(base_url());
      return;
    }
		$data['title']='Panel';
		//Pasamos esta variable como parametro al header para darle titulo a la pagina
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel');
		$this->load->view('backend/templates/footer');
	}

	public function vista_usuarios(){
		if(!$this->authentication->check_user()){
      redirect(base_url());
      return;
    }
		if($_SESSION['SISeI_User']['tipo']>1){
			redirect('admin');
			return;
		}
		$data['title']='Crear usuario';
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/formulario_usuarios');
		$this->load->view('backend/templates/footer');
	}

	public function lista_usuarios(){
		if($_SESSION['SISeI_User']['tipo']>1){
			redirect('admin');
			return;
		}
		$data['title']='Lista de usuarios';
		$data['usuarios']=$this->Usuario_model->getAllUsers();
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/lista_usuarios');
		$this->load->view('backend/templates/footer');
	}
	//Metodo para crear un usuario del sistema.
	public function create_user(){
		if($this->form_validation->run()){//La validacion del formulario fue exitosa
			$data['username']=$this->input->post('username');
			$data['password']=$this->encryption->encrypt($this->input->post('password'));
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
		}
		//JSON de respuesta
		echo json_encode($data);
	}

	public function printlst(){
		$data['users']=$this->Usuario_model->getAllUsers();
		$Datos=array();
		$i=0;
		foreach ($data['users'] as $key) {
			$Datos[$i]['Id']=$key['id'];
			$Datos[$i]['UserName']=$key['username'];
			if($key['tipo']==0)$Datos[$i]['Tipo']='Root';
			else if($key['tipo']==1)$Datos[$i]['Tipo']='Admin';
			else if($key['tipo']==2)$Datos[$i]['Tipo']='Logistica';
			else if($key['tipo']==3)$Datos[$i]['Tipo']='T y C';
			else if($key['tipo']==4)$Datos[$i]['Tipo']='Vendedor';
			$Datos[$i]['Nombre']=$key['nombres'].' '.$key['apellidos'];
			$Datos[$i]['Ultimo Acceso']=$key['last_accessed'];
			$i++;
		}
		$this->load->library('Pdf');
		$this->pdf->SetFont('Arial', '', 12);
		$this->pdf->AddPage();
		$this->pdf->Cell(0,0,'Lisa de usuarios',0,0,'C');
		$this->pdf->Ln(5);
		$header=array_keys($Datos[0]);
		$this->pdf->SetFillColor(33 , 150 , 243);
		$this->pdf->Cell(10,7,$header[0],1,0,'C',true);
		$this->pdf->Cell(30,7,$header[1],1,0,'C',true);
		$this->pdf->Cell(30,7,$header[2],1,0,'C',true);
		$this->pdf->Cell(70,7,$header[3],1,0,'C',true);
		$this->pdf->Cell(50,7,$header[4],1,0,'C',true);
		$this->pdf->Ln();
		foreach($Datos as $row){
			$this->pdf->Cell(10,6,$row['Id'],1,0,'C');
			$this->pdf->Cell(30,6,$row['UserName'],1,0,'C');
			$this->pdf->Cell(30,6,$row['Tipo'],1,0,'C');
			$this->pdf->Cell(70,6,$row['Nombre'],1,0,'C');
			$this->pdf->Cell(50,6,$row['Ultimo Acceso'],1,0,'C');
			$this->pdf->Ln();
		}
		$this->pdf->Output('lista_usuarios.pdf', 'I');
		echo json_encode($data);
	}
}