<?php
class Conferencias_controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authentication->check_user()){
            redirect('admin');
        }
        $this->load->model('Conferencias_model');
        $this->form_validation->set_rules('ponente_id', 'Ponente_Id', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('imagen', 'Imagen', 'required'); 
        $this->form_validation->set_rules('icono', 'Icono', 'required'); 
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
    }
    public function index(){
        $data['title'] = 'Lista de Conferencias';
        $data['Conferencias'] = $this->Conferencias_model->get();
        $this->load->view('backend/templates/header',$data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/pagina_conferencias', $data);
        $this->load->view('backend/templates/footer');
    }
     public function add(){
        if($this->form_validation->run()){//La validacion del formulario fue exitosa
            $data['ponente_id']=$this->input->post('ponente_id');
            $data['nombre']=$this->input->post('nombre');
            $data['fecha']=$this->input->post('fecha');
            $data['hora']=$this->input->post('hora');
            $data['calificacion']=NULL;

            if($this->upload->do_upload('btnimg')){
                $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
            }
             if($this->upload->do_upload('btnimg')){
                $data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
            }
            if($this->Conferencias_model->add($data)){
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
        $this->index();
        echo json_encode($data);
 
    }
        public function delete()
        {
            $id = $this->input->get('id');
            $this->load->model('Conferencias_model');
            $this->Conferencias_model->delete($id);
            $this->index();
            echo '<script language="javascript">';
            echo 'alert("Se a borrado el carnet con exito")';
            echo '</script>';
        }

       public function edit(){
            $id = $this->input->get('id');
            //$id = $this->input->post('id');
            $resultado = $this->Conferencias_model->get_conferencia_by_id($id);
            $ponente_id = $this->input->post('ponente_id');
            $data['ponente_id'] = $ponente_id;
            $nombre = $this->input->post('nombre');
            $data['nombre'] = $nombre;
            $fecha = $this->input->post('fecha');
            $data['fecha'] = $fecha;
            $hora = $this->input->post('hora');
            $data['hora'] = $hora;
            $imagen = $this->input->post('imagen');
            $data['imagen'] = $imagen;
            $icono = $this->input->post('icono');
            $data['icono'] = $icono; 
            if(count($resultado) > 0)
            {
                $data['conferencia'] = $resultado[0];
                $data['title'] = 'Modificar Conferencia';
                $this->load->view('backend/templates/header', $data);
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/formulario_conferencias', $data);
                $this->load->view('backend/templates/footer');
            }
            else
            {
               $id = $this->input->post('id');
                if ($this->form_validation->run())                        
                {
                    if($this->upload->do_upload('btnimg')){
                        $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
                    }
                    if($this->upload->do_upload('btnimg')){
                        $data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
                    }
                    if($this->Conferencias_model->update($id, $data)){
                        $data['error']="ALL_OK";
                        
                        
                    }
                    else
                    {
                        $data['error']="NOT_CREATED";//ocurrio un error
                    }
                }
                else
                {
                    $data['error']="BAD_POST";
                   
                }

 
                $this->index();

            }

        }

        public function details(){
             $id = $this->input->get('id');
            //$id = $this->input->post('id');
            $resultado = $this->Conferencias_model->get_conferencia_by_id($id);
            $data['conferencias'] = $resultado[0];
            $data['title'] = 'Detalles de la Conferencia';
                $this->load->view('backend/templates/header', $data);
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/conferencia_details', $data);
                $this->load->view('backend/templates/footer');
        }
    }
?>