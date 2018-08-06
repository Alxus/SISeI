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
		$this->form_validation->set_rules('nombre', 'Nombre_real', 'trim|required');
		$this->form_validation->set_rules('apellido', 'Apellido_real', 'trim|required');
		$this->form_validation->set_rules('noControl', 'No_control', 'numeric|required');
		$this->form_validation->set_rules('tel', 'Tel', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('carrera', 'Carrera', 'integer|required');
		$this->form_validation->set_rules('sexo', 'Sexo', 'integer|required');
		$this->form_validation->set_rules('talla', 'Talla', 'integer|required');
		$this->form_validation->set_rules('abono', 'abono', 'numeric|required');
		$this->form_validation->set_rules('carnet', 'carnet', 'integer|required');
	}
	
	public function index(){
		$data['title']='Panel de ventas';
		$data['Asistentes']=$this->Asistentes_model->get_Asistentes_ventas();
		$data['Carnets']=$this->Carnets_model->get();
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/panel_ventas');
		$this->load->view('backend/templates/footer');
	}

	public function Abono(){
		if($this->form_validation->run()){
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
				$asistente['password']=$this->encryption->encrypt($this->random_str(10));
				$asistente['email']=$this->input->post('email');
				$result=$this->Asistentes_model->ingresar_Asistente($asistente);
				if($result['affected_rows']==1){
					$precio=$this->Carnets_model->get_carnets_by_id($this->input->post('carnet'))['precio'];
					$abono['asistente_id']=$result['Id_Asistente'];
					$abono['carnet_id']=$this->input->post('carnet');
					$asistente['debia']=$precio;
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
			if($abono['estado']=='PAGADO' && ($this->Pagos_model->getPagados()['total']+$this->Asistentes_model->getPagados()['total'])<50){
				$asistente['pro']=true;
			}
			$this->Asistentes_model->abono_asistente($abono);
			$asistente['comprobante']=$abono;
			$this->printComprobante($asistente);
		}else{
			echo '<script language="javascript">';
			echo 'alert("Verifique los datos del asistente.")';
			echo '</script>';
		}
	}

	public function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces []= $keyspace[rand(0, $max)];
		}
		return implode('', $pieces);
	}

	public function printComprobante($asistente){
		$data['cliente']=$asistente['nombre_real'].' '.$asistente['apellido_real'];
		$data['vendedor']=$_SESSION['SISeI_User']['nombres']." ".$_SESSION['SISeI_User']['apellidos'];
		$data['correo']=$asistente['email'];
		$data['password']=$this->encryption->decrypt($asistente['password']);
		$data['debe']=$asistente['debe'];
		$data['actual']=$asistente['comprobante']['debe'];
		$this->pdf->AliasNbPages();
		$this->pdf->Recibo();
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Ln(30);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->MultiCell(0,10,'Nombre del cliente: '.$data['cliente']);
		$this->pdf->MultiCell(0,10,'Nombre del vendedor: '.$data['vendedor']);
		$this->pdf->MultiCell(0,10,'Correo: '.$data['correo']);
		$this->pdf->MultiCell(0,10,'Contraseña: '.$data['password']);
		if(isset($datos['debe'])){		
			$this->pdf->MultiCell(0,10,'Adeudo anterior: $'.$data['debe']);
		}
		$this->pdf->MultiCell(0,10,'Adeudo actual: $'.$data['actual']);
		$datos = array();
		$datos['data'][0]="Comprobante de pago por la compra de su carnet para la XII edicion de SISeI, macroevento organizado por el comité organizador del Simposio Internacional de Sistemas e Informática SISeI.\n\nNOTA: No perder este comprobante y seguir las instrucciones previamente mencionadas por el organizador encargado de su registro.\n";
		$datos['data'][1]="";
		$this->pdf->tablewidths = array(125, 60);
		$this->pdf->tablaRecibo($datos,5);
		$this->pdf->Image(base_url().'assets/img/logo_cosisei.png',150,65,32);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(78, 93, 114);
		$this->pdf->Cell(170, 80,"Sello de COSISeI",0,0,"R",false);
		$this->pdf->Output('comprobante_'.$asistente['nombre_real'].'_'.$asistente['apellido_real'].'.pdf', 'I');
	}

}