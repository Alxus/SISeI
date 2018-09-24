<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistentes_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
    if(!$this->authentication->check_user()){
      redirect(base_url());
      return;
    }
        $this->load->model('Asistentes_model');
    $this->load->library('Pdf');

    $this->form_validation->set_rules('nombre_real', 'Nombre_real', 'trim|required');
    $this->form_validation->set_rules('apellido_real', 'Apellido_real', 'trim|required');
    $this->form_validation->set_rules('no_control', 'No_control', 'trim|required');
    $this->form_validation->set_rules('tel', 'Tel', 'required');
    $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
    $this->form_validation->set_rules('carera', 'Carera', 'integer|required');
    $this->form_validation->set_rules('sexo', 'Sexo', 'integer|required');
    $this->form_validation->set_rules('talla', 'Talla', 'integer|required');
    $this->form_validation->set_rules('pro', 'Pro', 'integer|required');

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

public function details(){
 $id = $this->input->get('id');
 $data['asistente'] = $this->Asistentes_model->get_carnets_by_id_for_panel_asistente($id);
 $data['title'] = 'Detalles del Asistente';
 $this->load->view('backend/templates/header', $data);
 $this->load->view('backend/templates/navbar');
 $this->load->view('backend/asistente_details', $data);
 $this->load->view('backend/templates/footer');
}

public function delete()
{
    $id = $this->input->get('id');
    $this->load->model('Asistentes_model');
    $this->Asistentes_model->delete($id);
    $this->index();
        echo '<script language="javascript">';
        echo 'alert("Se a borrado el asistente con exito")';
        echo '</script>';
}

/*Aun no funciona el update*/
public function edit(){
    $id = $this->input->get('id');
            //$id = $this->input->post('id');
    $resultado = $this->Asistentes_model->get_carnets_by_id_for_panel_asistente($id);
    $data['nombre_real']=$this->input->post('nombre_real');
    $data['apellido_real']=$this->input->post('apellido_real');
    $data['no_control']=$this->input->post('no_control');
    $data['tel']=$this->input->post('tel');
    $data['email']=$this->input->post('email');
    $data['carrera']=$this->input->post('carrera');
    $data['sexo']=$this->input->post('sexo');
    $data['talla']=$this->input->post('talla');
    $data['pro']=$this->input->post('pro');
    if($resultado!=null)
    {
        $data['asistente'] = $resultado;
        $data['title'] = 'Modificar Asistente';
        $this->load->view('backend/templates/header', $data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/formulario_asistentes', $data);
        $this->load->view('backend/templates/footer');
    }
    else
    {
        $id = $this->input->post('id');
        /*if ($this->form_validation->run()){  */     
              if($this->Asistentes_model->update($id, $data)){
                  $data['error']="ALL_OK";   
                    echo '<script language="javascript">';
                    echo 'alert("Se a actualizado el asistente con exito")';
                    echo '</script>'; 
                    $this->index();
              }
              else{
                $data['error']="NOT_CREATED";//ocurrio un error
                    echo '<script language="javascript">';
                    echo 'alert("Ocurrio un error: No se han podido actualizar los datos.")';
                    echo '</script>';
                    $this->index();
              }
        }
        /*else{
          $data['error']="BAD_POST";  
                echo '<script language="javascript">';
                echo 'alert("Datos incorrectos.")';
                echo '</script>';
          $this->index();
        }  
    }*/
}


/*public function edit(){
        $id = $this->input->get('id');
            //$id = $this->input->post('id');
        $resultado = $this->Asistentes_model->get_carnets_by_id_for_panel_asistente($id);
        $nombre_real = $this->input->post('nombre_real');
        $data['nombre_real'] = $nombre_real;
        $apellido_real = $this->input->post('apellido_real');
        $data['apellido_real'] = $apellido_real;
        $no_control = $this->input->post('no_control');
        $data['no_control'] = $no_control;
        $tel = $this->input->post('tel');
        $data['tel'] = $tel;
        $email = $this->input->post('email');
        $data['email'] = $email;
        $carrera = $this->input->post('carrera');
        $data['carrera'] = $carrera;
        $sexo = $this->input->post('sexo');
        $data['sexo'] = $sexo;
        $talla = $this->input->post('talla');
        $data['talla'] = $talla;
        $pro = $this->input->post('pro');
        $data['pro'] = $pro;
        
        if($resultado!=null){
            $data['asistente'] = $resultado;
            $data['title'] = 'Modificar Asistente';
            $this->load->view('backend/templates/header', $data);
            $this->load->view('backend/templates/navbar');
            $this->load->view('backend/formulario_asistentes', $data);
            $this->load->view('backend/templates/footer');
        } else {
            $id = $this->input->post('id');
            if ($this->form_validation->run()) {
                if($this->Asistentes_model->update($id, $data)){
                    $data['error']="ALL_OK";
                    echo '<script language="javascript">';
                    echo 'alert("Se a actualizado el asistente con exito")';
                    echo '</script>';
                } else {
                    $data['error']="NOT_CREATED";//ocurrio un error
                    echo '<script language="javascript">';
                    echo 'alert("Ocurrio un error: No se han podido actualizar los datos.")';
                    echo '</script>';
                }
            } else {
                $data['error']="BAD_POST";
                echo '<script language="javascript">';
                echo 'alert("Datos incorrectos.")';
                echo '</script>';
            }
            $this->index();
        }
    }*/

public function searchAsistenteByNc(){
 $search=$this->input->post('dato');
 $asistente=$this->Asistentes_model->getAsistenteByNC($search);
 if($asistente==null){
  echo json_encode($asistente);
  return;
 }
 for ($i=0; $i <sizeof($asistente) ; $i++) { 
  $result[$i]=$this->Asistentes_model->get_asistente_by_id($asistente[$i]['id'],$asistente[$i]['cid']);
 }
 echo json_encode($result);
}

public function searchAsistenteByName(){
 $nombre=$this->input->post('nombre');
 $asistente=$this->Asistentes_model->getAsistenteByNombre($nombre);
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
  $this->pdf->tablewidths = array(10, 22, 55, 35, 20, 25, 10);
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
     case 1:
     $data['asistentes'][$i]['Pro']="Sí";
     break;
     case 0:
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
