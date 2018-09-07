<?php
class Conferencias_controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authentication->check_user()){
          redirect(base_url());
          return;
      }
        $this->load->model('Conferencias_model');
        $this->load->library('Pdf');
        $this->form_validation->set_rules('ponente_id', 'Ponente_Id', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('imagen', 'Imagen', 'required'); 
        $this->form_validation->set_rules('icono', 'Icono', 'required'); 
        $this->form_validation->set_rules('logo', 'Logo', 'required'); 
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
        date_default_timezone_set( 'America/Mazatlan' );
        setlocale(LC_ALL , "es_CO.UTF-8");
        $this->load->model('Comentarios_model');
    }
    public function index(){
        $data['title'] = 'Lista de Conferencias';
        $data['Conferencias'] = $this->Conferencias_model->get();
        $data['Ponentes'] = $this->Conferencias_model->getPonentes();
        $this->load->view('backend/templates/header',$data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/pagina_conferencias', $data);
        $this->load->view('backend/templates/footer');
    }
    public function add(){
        if($this->form_validation->run()){//La validacion del formulario fue exitosa
            $data['ponente_id']=$this->input->post('ponente_id');
            $data['nombre']=$this->input->post('nombre');
            $data['descripcion']=$this->input->post('descripcion');
            $data['ubicacion']=$this->input->post('ubicacion');
            $data['fecha']=$this->input->post('fecha');
            $data['hora']=$this->input->post('hora');
            $data['calificacion']=0;
            if($this->upload->do_upload('btnimg')){
                $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
                if($this->upload->do_upload('btnicon')){
                    $data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
                    if($this->upload->do_upload('btnlog')){
                        $data['logo_empresa']=base_url().'assets/img/'.$this->upload->data('file_name');
                        if($this->Conferencias_model->add($data)){
                             $data['error']="ALL_OK";//el usuario fue agregado a la db sin problemas
                         }
                         else{
                            $data['error']="NOT_CREATED";//ocurrio un error            
                        }
                    }
                    else{
                        $data['error']=$this->upload->display_errors(); 
                    }
                }
                else{
                    $data['error']=$this->upload->display_errors(); 
                }    
            }
            else{
                $data['error']=$this->upload->display_errors(); 
            }       
        }
        else{
            //La validacion no fue exitosa
            $data['error']="BAD_POST";
            
        }

        //JSON de respuesta
        redirect(base_url()."index.php/admin/panel/conferencia");

    }
    public function delete()
    {
        $id = $this->input->get('id');
        $this->load->model('Conferencias_model');
        $this->Conferencias_model->delete($id);
        $this->index();
        echo '<script language="javascript">';
        echo 'alert("Se a borrado la conferencia con exito")';
        echo '</script>';
    }

    public function edit(){
        $id = $this->input->get('id');
        $resultado = $this->Conferencias_model->get_conferencia_by_id($id);
        $ponente_id = $this->input->post('ponente_id');
        $data['ponente_id'] = $ponente_id;
        $nombre = $this->input->post('nombre');
        $data['nombre'] = $nombre;
        $descripcion = $this->input->post('descripcion');
        $data['descripcion'] = $descripcion;
        $ubicacion = $this->input->post('ubicacion');
        $data['ubicacion'] = $ubicacion;
        $fecha = $this->input->post('fecha');
        $data['fecha'] = $fecha;
        $hora = $this->input->post('hora');
        $data['hora'] = $hora;
        if($resultado!=null){
            $data['conferencia'] = $resultado;
            $data['Ponentes'] = $this->Conferencias_model->getPonentes();
            $data['title'] = 'Modificar Conferencia';
            $this->load->view('backend/templates/header', $data);
            $this->load->view('backend/templates/navbar');
            $this->load->view('backend/formulario_conferencias', $data);
            $this->load->view('backend/templates/footer');
        }
        else{
         $id = $this->input->post('id');
         if ($this->form_validation->run()){
            if($this->upload->do_upload('btnimg')){
                $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
            
                if($this->upload->do_upload('btnicon')){
                    $data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
            
                    if($this->upload->do_upload('btnlog')){
                        $data['logo_empresa']=base_url().'assets/img/'.$this->upload->data('file_name');
            
                        if($this->Conferencias_model->update($id, $data)){
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
                    $data['error']=$this->upload->display_errors(); 
                } 
            }   
            else{
                $data['error']=$this->upload->display_errors(); 
            }      
        }     
        else{
           $data['error']="BAD_POST";
       }
        redirect(base_url()."index.php/admin/panel/conferencia");
   }
}

public function details(){
   $id = $this->input->get('id');
   $data['conferencias'] = $this->Conferencias_model->get_conferencia_by_id($id);
   $data['comentarios'] = $this->Comentarios_model->get_coments_conf($id);
   $data['title'] = 'Detalles de la Conferencia';
   $this->load->view('backend/templates/header', $data);
   $this->load->view('backend/templates/navbar');
   $this->load->view('backend/conferencia_details');
   $this->load->view('backend/templates/footer');
}
 public function printlst(){
        $data['conferencias']=$this->Conferencias_model->get_conferenciasPDF();
        $header=array_keys($data['conferencias'][0]);
        $this->pdf->SetFillColor(33 , 150 , 243);
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->MultiCell(0,10,'Lista de Talleres');
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->tablewidths = array(30, 30, 30, 30, 30);
        for($i=0; $i<sizeof($header); $i++){
            $this->pdf->Cell($this->pdf->tablewidths[$i],7,$header[$i],1,0,'C',true);
        }
        for ($i=0; $i<sizeof($data['conferencias']);$i++) {
            $date = date_timestamp_get(date_create($data['conferencias'][$i]['Fecha']));
            $data['conferencias'][$i]['Fecha']=strftime('%a, %d/%b/%Y %l:%M %p', $date);
        }
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->morepagestable($data['conferencias'],5);
        $this->pdf->Output('lista_talleres.pdf', 'I');
    }

}
?>