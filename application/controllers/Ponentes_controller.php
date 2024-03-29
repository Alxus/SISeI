<?php
class Ponentes_controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         if(!$this->authentication->check_user()){
              redirect(base_url());
              return;
          }
        $this->load->model('Ponente_model');
        $this->load->library('Pdf');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('tel', 'Tel', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('imagen', 'Imagen', 'required');
        //reglas para subir imagenes
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
    }
    public function index(){
      $data['title'] = 'Lista de Ponentes';
      $data['ponentes'] = $this->Ponente_model->get();
      $this->load->view('backend/templates/header',$data);
      $this->load->view('backend/templates/navbar');
      $this->load->view('backend/lista_ponentes', $data);
      $this->load->view('backend/templates/footer');
  }
  public function add(){
    if($this->form_validation->run()){
      $data['nombres']=$this->input->post('nombres');
      $data['apellidos']=$this->input->post('apellidos');
      $data['tel']=$this->input->post('tel');
      $data['email']=$this->input->post('email');
      $data['linkedin']=$this->input->post('linkedin');
      $data['descripcion']=$this->input->post('descripcion');
      if($this->upload->do_upload('btnimg')){
        $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
        if($this->Ponente_model->add($data)){
           $data['error']="ALL_OK";
        }
        else{
          $data['error']="NOT_CREATED";  
        }     
      }
      else{
        $data['error']=$this->upload->display_errors();           
      }
    }
    else{
      $data['error']="BAD_POST";  
    }
    $this->index();
  }

public function delete()
{
    $id = $this->input->get('id');
    $this->load->model('Ponente_model');
    $this->Ponente_model->delete($id);
    $this->index();
    echo '<script language="javascript">';
    echo 'alert("Se a borrado el carnet con exito")';
    echo '</script>';
}

public function edit(){
    $id = $this->input->get('id');
            //$id = $this->input->post('id');
    $resultado = $this->Ponente_model->get_ponente_by_id($id);
    $data['nombres']=$this->input->post('nombres');
    $data['apellidos']=$this->input->post('apellidos');
    $data['tel']=$this->input->post('tel');
    $data['email']=$this->input->post('email');
    $data['linkedin']=$this->input->post('linkedin');
    $data['descripcion']=$this->input->post('descripcion');
    if($resultado!=null)
    {
        $data['ponente'] = $resultado;
        $data['title'] = 'Modificar Ponente';
        $this->load->view('backend/templates/header', $data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/formulario_ponentes', $data);
        $this->load->view('backend/templates/footer');
    }
    else
    {
        $id = $this->input->post('id');
        if ($this->form_validation->run()) {
            if (!file_exists($_FILES['btnimg']['tmp_name'])) {
                $data['imagen']=$this->input->post('imagen');
            }
            if($this->upload->do_upload('btnimg')){
                $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
            }
            if($this->Ponente_model->update($id, $data)){
                $data['error']="ALL_OK";
            } else {
                $data['error']="NOT_CREATED";//ocurrio un error
            }     
        }
        else{
          $data['error']="BAD_POST";  
        }
        $this->index();      
    }
}

  public function details(){
      if(!$this->authentication->check_user()){
        redirect(base_url());
        return;
    }
    $id = $this->input->get('id');
      //$id = $this->input->post('id');
    $data['ponente'] = $this->Ponente_model->get_ponente_by_id($id);
    $data['taller'] = $this->Ponente_model->getnombretaller($id);
    $data['conferencia'] = $this->Ponente_model->getnombreconferencia($id);
    $data['title'] = 'Detalles del Ponente';
    $this->load->view('backend/templates/header', $data);
    $this->load->view('backend/templates/navbar');
    $this->load->view('backend/info_ponente', $data);
    $this->load->view('backend/templates/footer');
}




public function printlst(){
  $data['ponentes']=$this->Ponente_model->get_ponentesPDF();
  $header=array_keys($data['ponentes'][0]);
  $this->pdf->SetFillColor(33 , 150 , 243);
  $this->pdf->AliasNbPages();
  $this->pdf->AddPage();
  $this->pdf->SetFont('Arial','B',12);
  $this->pdf->MultiCell(0,10,'Lista de Ponentes');
  $this->pdf->SetFont('Arial','B',10);
  $this->pdf->tablewidths = array(10, 50, 50, 40, 40);
  for($i=0; $i<sizeof($header); $i++){
      $this->pdf->Cell($this->pdf->tablewidths[$i],7,$header[$i],1,0,'C',true);
  }
  $this->pdf->Ln();
  $this->pdf->SetFont('Arial','',10);
  $this->pdf->morepagestable($data['ponentes'],5);
  $this->pdf->Output('lista_talleres.pdf', 'I');
}

}
?>