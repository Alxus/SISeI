<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
			redirect('admin');
		}
		$this->load->model('Asistentes_model');		
		$this->load->model('Carnets_model');
		$this->load->model('Pagos_model');
		$this->load->library('Pdf');
	}
	
	public function index(){
		$data['title']='Panel de ventas';
		$data['Asistentes']=$this->Asistentes_model->get_Asistentes_ventas();
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar_ventas');
		$this->load->view('backend/panel_ventas');
		$this->load->view('backend/templates/footer');
	}

	public function Abono(){
		$data['facebook_id']=$this->input->post('fb');
		$data['email']=$this->input->post('email');
		$data['carnet_id']=$this->input->post('carnet');
		$asistente=$this->Asistentes_model->getbByEmail_OR_FbId($data);
		//El usuario no se encuentra en nuestra BD
		if($asistente==null){
			$asistente['nombre_real']=$this->input->post('nombre');
			$asistente['apellido_real']=$this->input->post('apellido');
			$asistente['no_control']=$this->input->post('noControl');
			$asistente['tel']=$this->input->post('tel');
			$asistente['carrera']=($this->input->post('carrera')!=null)?$this->input->post('carrera'):0;
			$asistente['sexo']=$this->input->post('sexo');
			$asistente['talla']=$this->input->post('talla');
			$asistente['password']=$this->random_str(10);
			$asistente['email']=$this->input->post('email');
			$result=$this->Asistentes_model->ingresar_Asistente($asistente);
			if($result['affected_rows']==1){
				$precio=$this->Carnets_model->get_carnets_by_id($this->input->post('carnet'))[0]['precio'];
				$abono['asistente_id']=$result['Id_Asistente'];
				$abono['carnet_id']=$this->input->post('carnet');
				$abono['debe']=$precio-$this->input->post('abono');
				$abono['estado']=($abono['debe']==0)?'PAGADO':'APARTADO';
			}
		}
		else{
			$abono['asistente_id']=$asistente['id'];
			$abono['carnet_id']=$asistente['carnet_id'];
			$abono['debe']=$asistente['debe']-$this->input->post('abono');
			$abono['estado']=($abono['debe']==0)?'PAGADO':'APARTADO';
		}
		if($abono['estado']=='PAGADO' && ($this->Pagos_model->getPagados()[0]['total']+$this->Asistentes_model->getPagados()[0]['total'])<50){
			$asistente['pro']=true;
		}
		print_r($abono);
		$this->Asistentes_model->abono_asistente($abono);
		$asistente['comprobante']=$abono;
		$this->printComprobante($asistente);
	}

	public function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces []= $keyspace[random_int(0, $max)];
		}
		return implode('', $pieces);
	}

	public function printComprobante($asistente){
		$this->pdf->AliasNbPages();
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->MultiCell(0,10,'Comprobante de pago');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->MultiCell(0,10,$asistente['nombre_real']);
		$this->pdf->MultiCell(0,10,$asistente['apellido_real']);
		$this->pdf->MultiCell(0,10,$asistente['email']);
		$this->pdf->MultiCell(0,10,$asistente['password']);
		$this->pdf->Output('comprobante_pago.pdf', 'I');
	}

}