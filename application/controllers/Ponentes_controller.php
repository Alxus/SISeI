<?php
class Ponentes_controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authentication->check_user()){
            redirect('admin');
        }
        $this->load->model('Ponente_model');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('tel', 'Tel', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
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

            if($this->Ponente_model->add($data)){
                 $data['error']="ALL_OK";
              
            }
            else{
                $data['error']="NOT_CREATED";           
            }
            $this->index();
        }
        else{
            $data['error']="BAD_POST";
            
        }
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
            if(count($resultado) > 0)
            {
                $data['ponente'] = $resultado[0];
                $data['title'] = 'Modificar Ponente';
                $this->load->view('backend/templates/header', $data);
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/formulario_ponentes', $data);
                $this->load->view('backend/templates/footer');
            }
            else
            {
                $id = $this->input->post('id');
                if ($this->form_validation->run())                        
                {
                    
                    if($this->Ponente_model->update($id, $data)){
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
                echo json_encode($data);
 
            }

        }

        public function details(){
             $id = $this->input->get('id');
            //$id = $this->input->post('id');
            $resultado = $this->Ponente_model->get_ponente_by_id($id);
            $data['ponente'] = $resultado[0];
            $data['taller'] = $this->Ponente_model->getnombretaller($id);
            $data['conferencia'] = $this->Ponente_model->getnombreconferencia($id);
            $data['title'] = 'Detalles del Ponente';
                $this->load->view('backend/templates/header', $data);
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/info_ponente', $data);
                $this->load->view('backend/templates/footer');
        }
    }
?>