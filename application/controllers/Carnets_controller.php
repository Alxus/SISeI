<?php
class Carnets_controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!$this->authentication->check_user()){
            redirect('admin');
        }
        $this->load->model('Carnets_model');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('precio', 'Precio', 'integer|required');
        $this->form_validation->set_rules('limite', 'Limite', 'integer|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('imagen', 'Imagen', 'required'); 
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
    }
    public function index(){
        $data['title'] = 'Lista de Carnets';
        $data['carnets'] = $this->Carnets_model->get();
        $this->load->view('backend/templates/header',$data);
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/pagina_carnets', $data);
        $this->load->view('backend/templates/footer');
    }
     public function add(){
        if($this->form_validation->run()){//La validacion del formulario fue exitosa
            $data['nombre']=$this->input->post('nombre');
            $data['precio']=$this->input->post('precio');
            $data['limite']=$this->input->post('limite');
            $data['descripcion']=$this->input->post('descripcion');
            if($this->upload->do_upload('btnimg')){
                $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
            }

            if($this->Carnets_model->add($data)){
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
        
    }
        public function delete()
        {
            $id = $this->input->get('id');
            $this->load->model('Carnets_model');
            $this->Carnets_model->delete($id);
            $this->index();
            echo '<script language="javascript">';
            echo 'alert("Se a borrado el carnet con exito")';
            echo '</script>';
        }

       public function edit(){
            // Obtenemos el id de la editorial a editar
            $id = $this->input->get('id');
            //$id = $this->input->post('id');
            $resultado = $this->Carnets_model->get_carnets_by_id($id);
            $nombre = $this->input->post('nombre');
            $data['nombre'] = $nombre;
            $precio = $this->input->post('precio');
            $data['precio'] = $precio;
            $limite = $this->input->post('limite');
            $data['limite'] = $limite;
            $descripcion = $this->input->post('descripcion');
            $data['descripcion'] = $descripcion;
            $imagen = $this->input->post('imagen');
            $data['imagen'] = $imagen;
            if(count($resultado) > 0)
            {
                $data['carnet'] = $resultado[0];
                $data['title'] = 'Modificar Carnet';
                $this->load->view('backend/templates/header', $data);
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/formulario_carnets', $data);
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
                    if($this->Carnets_model->update($id, $data)){
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
    }
?>