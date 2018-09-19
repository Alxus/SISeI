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
		$this->form_validation->set_rules('tel', 'Tel', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
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
			$carnet=$this->Carnets_model->get_carnets_by_id($this->input->post('carnet'));
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
					$abono['asistente_id']=$result['Id_Asistente'];
					$abono['carnet_id']=$this->input->post('carnet');
					$asistente['precio_carnet']=$carnet['precio'];
					$asistente['pago']=$this->input->post('abono');
					$asistente['adeudo_anterior']=$carnet['precio'];
					$abono['debe']=$carnet['precio']-$this->input->post('abono');
					if($abono['debe']<0){
						$abono['debe'] = 0;
					}
					$abono['estado']=($abono['debe']==0)?'PAGADO':'APARTADO';
				}
			} else {
				$adeudo=$this->Asistentes_model->tiene_carnet($asistente['id'],$this->input->post('carnet'));
				if($adeudo!=null){
					$asistente['pago']=$this->input->post('abono');
					$abono['asistente_id']=$asistente['id'];
					$abono['carnet_id']=$adeudo['carnet_id'];
					$asistente['adeudo_anterior']=$adeudo['debe'];
					$abono['debe']=$adeudo['debe']-$this->input->post('abono');
					if($abono['debe']<0){
						$abono['debe'] = 0;
					}
					$abono['estado']=($abono['debe']==0)?'PAGADO':'APARTADO';
				}else{
					$asistente['pago']=$this->input->post('abono');
					$abono['asistente_id']=$asistente['id'];
					$abono['carnet_id']=$this->input->post('carnet');
					$asistente['precio_carnet']=$carnet['precio'];
					$asistente['pago']=$this->input->post('abono');
					$asistente['adeudo_anterior']=$carnet['precio'];
					$abono['debe']=$carnet['precio']-$this->input->post('abono');
					if($abono['debe']<0){
						$abono['debe'] = 0;
					}
					$abono['estado']=($abono['debe']==0)?'PAGADO':'APARTADO';
				}
			}
		

		if($abono['estado']=='PAGADO'){
			if(($this->Pagos_model->getPagados()['total']+$this->Asistentes_model->getPagados()['total'])<50){
				$asistente['pro']=true;
				$this->Asistentes_model->pro($asistente);
			}
		}
		$asistente['folio']=$this->Asistentes_model->abono_asistente($abono);
		$asistente['debe']=$abono['debe'];
		$asistente['estado']=$abono['estado'];
		$asistente['carnet']=$carnet;
		$this->printComprobante($asistente,1);
		}
		else{
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

	public function printComprobante($asistente,$g){
		$vendedor=$_SESSION['SISeI_User']['nombres'].' '.$_SESSION['SISeI_User']['apellidos'];
		$cliente=$asistente['nombre_real'].' '.$asistente['apellido_real'];
		$folio =str_pad($asistente['folio'],6,"0",STR_PAD_LEFT);
		$this->pdf->AliasNbPages();
		$this->pdf->Recibo('','',0,$folio,date("d/m/Y"));
		$this->pdf->Ln(30);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Nombre del asistente: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$cliente,$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Nombre del vendedor: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$vendedor,$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Email del asistente: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['email'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Número de telefono: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['tel'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Carnet: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['carnet']['nombre'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Precio del carnet: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(50,10,"$".$asistente['carnet']['precio'],$g,0,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Adeudo Anterior: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,'$'.$asistente['adeudo_anterior'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Pago: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(50,10,'$'.$asistente['pago'],$g,0,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Adeudo Actual: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,'$'.$asistente['debe'],$g,1,"L",false);
		$this->pdf->Ln(25);
		$this->pdf->Cell(90,10,"Firma del asistente","T",0,"C",false);
		$this->pdf->Cell(10,10,"",0,0,"C",false);
		$this->pdf->Cell(90,10,"Firma del organizador","T",0,"C",false);
		$this->pdf->Ln(15);
		$this->pdf->Cell(0,10," - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ",0,1,"C",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(30,10,"FECHA: ".date("d/m/Y"),0,0,"L",false);
		$this->pdf->Cell(0,10,"FOLIO: ".$folio,0,1,"R",false);
		$this->pdf->Cell(0,5,"Comprobante de compra para entrada a la 12 edición de SISeI",0,1,"C",false);
		$this->pdf->Cell(65,40,$this->pdf->Image(base_url().'assets/img/logo_cosisei.png',$this->pdf->GetX()+12,$this->pdf->GetY()+7,45),$g,0,"L",false);
		$this->pdf->Cell(50,10,'Nombre del asistente: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$cliente,$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,' ',0,0,"L",false);
		$this->pdf->Cell(50,10,'Nombre del vendedor: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$vendedor,$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,' ',0,0,"L",false);
		$this->pdf->Cell(50,10,'Email del asistente: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['email'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,' ',0,0,"L",false);
		$this->pdf->Cell(50,10,'Número de telefono: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['tel'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,'Carnet: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,$asistente['carnet']['nombre'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,'Precio del carnet: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(30,10,"$".$asistente['carnet']['precio'],$g,0,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Adeudo Anterior: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,'$'.$asistente['adeudo_anterior'],$g,1,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(65,10,'Pago: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(30,10,'$'.$asistente['pago'],$g,0,"L",false);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(50,10,'Adeudo Actual: ',$g,0,"L",false);
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->Cell(0,10,'$'.$asistente['debe'],$g,1,"L",false);
		$this->pdf->Ln(5);
		$this->pdf->multicell(0,5,'*Utilice el correo electrónico proporcionado y la contraseña "'.$this->encryption->decrypt($asistente['password']).'" para acceder a su perfil de usuario en www.sisei.com.mx');
		$this->pdf->multicell(0,5,"**Este comprobante no es válido sin sello.");
		$this->pdf->multicell(0,5,"***No hay devoluciones.");
		$this->pdf->Output('comprobante'.$cliente.'.pdf', 'I');
	}

}