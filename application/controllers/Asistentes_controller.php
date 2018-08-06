<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistentes_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
			redirect('admin');
		}
		$this->load->model('Asistentes_model');
        $this->load->library('Pdf');
        date_default_timezone_set('America/Mazatlan');
    }

    public function index(){
        $data['title']='Asistentes';
        $data['asistentes']=$this->Asistentes_model->getAsistentes();
        $this->load->view('backend/templates/header',$data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/panel_asistentes');
        $this->load->view('backend/templates/footer');
    }

    public function add(){
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
            $data['error']="ALL_OK";
            echo '<script language="javascript">alert("Se agrego el asistente con exito")</script>';
        }
        else{
            $data['error']="NOT_CREATED"; 
            echo '<script language="javascript">alert("No fue posible agregar el asistente con exito")</script>';        
        }
        $this->index();
        $data['error']="BAD_POST";
        echo '<script language="javascript">alert("Error en validación.")</script>';
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
       $request=array('facebook_id'=>$Fb_Id,'facebook_name'=>$Fb_Name,'Fb_FirstName'=>$Fb_FirstName,'facebook_link'=>$Fb_Link);
       $datos_asistente=$this->_checkAsistente($request);

       if($datos_asistente != null){
          $result = $datos_asistente;
          $result['error'] = 'ALL_OK';
      }
      else{
          $result['error'] = 'Error-Fcheckuser-1';
          echo json_encode($result);
      }
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

public function details(){
 $id = $this->input->get('id');
 $data['asistente'] = $this->Asistentes_model->get_asistente_by_id($id);
 $data['title'] = 'Detalles del Asistente';
 $this->load->view('backend/templates/header', $data);
 $this->load->view('backend/templates/navbar');
 $this->load->view('backend/asistente_details', $data);
 $this->load->view('backend/templates/footer');
}

public function searchAsistenteByNc(){
 $search=$this->input->post('dato');
 $asistente=$this->Asistentes_model->getAsistenteByNC($search);
 echo json_encode($asistente);
}

public function searchAsistenteByName(){
 $data['nombre_real']=$this->input->post('nombres');
 $data['apellido_real']=$this->input->post('apellidos');
 $asistente=$this->Asistentes_model->getAsistenteByNombre($data);
 echo json_encode($asistente);
}

public function printlst(){
    $data['asistentes']=$this->Asistentes_model->get_AsistentesPDF();
    $header=array_keys($data['asistentes'][0]);
    $this->pdf->SetFillColor(33 , 150 , 243);
    $this->pdf->AliasNbPages();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->MultiCell(0,10,'Lista de Asistentes');
    $this->pdf->SetFont('Arial','B',10);
    $this->pdf->tablewidths = array(10, 22, 65, 25, 20, 25, 10);
    for($i=0; $i<sizeof($header); $i++){
        $this->pdf->Cell($this->pdf->tablewidths[$i],7,$header[$i],1,0,'C',true);
    }
    for($i=0; $i<sizeof($data['asistentes']); $i++){
        $data['asistentes'][$i]['No.']=$i+1;
        if($data['asistentes'][$i]['No. Control']==""){
            $data['asistentes'][$i]['No. Control']="N/A";
        }
        switch ( $data['asistentes'][$i]['Sexo']) {
           case 0:
           $data['asistentes'][$i]['Sexo']="Hombre";
           break;
           case 1:
           $data['asistentes'][$i]['Sexo']="Mujer";
           break;
       }
       switch ( $data['asistentes'][$i]['Pro']) {
           case 0:
           $data['asistentes'][$i]['Pro']="Sí";
           break;
           case 1:
           $data['asistentes'][$i]['Pro']="No";
           break;
       }

       switch ( $data['asistentes'][$i]['Talla']) {
           case 1:
           $data['asistentes'][$i]['Talla']="Extra Chica";
           break;
           case 2:
           $data['asistentes'][$i]['Talla']="Chica";
           break;
           case 3:
           $data['asistentes'][$i]['Talla']="Mediana";
           break;
           case 4:
           $data['asistentes'][$i]['Talla']="Grande";
           break;
           case 5:
           $data['asistentes'][$i]['Talla']="Extra Grande";
           break;
       }

       switch ( $data['asistentes'][$i]['Carrera']) {
           case 1:
           $data['asistentes'][$i]['Carrera']="SISTEMAS";
           break;
           case 2:
           $data['asistentes'][$i]['Carrera']="TICs";
           break;
           case 3:
           $data['asistentes'][$i]['Carrera']="ELECTRÓNICA";
           break;
           case 4:
           $data['asistentes'][$i]['Carrera']="MECATRÓNICA";
           break;
           case 5:
           $data['asistentes'][$i]['Carrera']="ELÉCTRICA";
           break;
           case 6:
           $data['asistentes'][$i]['Carrera']="MECÁNICA";
           break;
           case 7:
           $data['asistentes'][$i]['Carrera']="AMBIENTAL";
           break;
           case 8:
           $data['asistentes'][$i]['Carrera']="BIOQUÍMICA";
           break;
           case 9:
           $data['asistentes'][$i]['Carrera']="RENOVABLES";
           break;
           case 10:
           $data['asistentes'][$i]['Carrera']="GESTIÓN";
           break;
           case 11:
           $data['asistentes'][$i]['Carrera']="INDUSTRIAL";
           break;
           default:
           $data['asistentes'][$i]['Carrera']="N/A";
           break;
       }
   }
   $this->pdf->Ln();
   $this->pdf->SetFont('Arial','',10);
   $this->pdf->tablaAsistentes($data['asistentes'],5,"C");
   $this->pdf->Output('lista_asistentes.pdf', 'I');
}
}
