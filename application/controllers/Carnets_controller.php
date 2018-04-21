<?php

class Carnets_controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Carnets_model');
        
    }

    public function index(){
        $data['carnets'] = $this->Carnets_model->get();
        $this->load->view('backend/templates/header');
        $this->load->view('backend/templates/navbar');
        $this->load->view('backend/pagina_carnets', $data);
        $this->load->view('backend/templates/footer');
    }


     public function add(){
        if($this->form_validation->run()=== FALSE){//La validacion del formulario fue exitosa
            $data['nombre']=$this->input->post('nombre');
            $data['precio']=$this->input->post('precio');
            $data['limite']=$this->input->post('limite');
            $data['descripcion']=$this->input->post('descripcion');
            $data['imagen']=$this->input->post('imagen');
            if($this->Carnets_model->add($data)){
                 $data['error']="ALL_OK";//el usuario fue agregado a la db sin problemas
                 $this->index();;
            }
            else{
                $data['error']="NOT_CREATED";//ocurrio un error
                 $this->index();;
            }
        }
        else{
            //La validacion no fue exitosa
            $data['error']="BAD_POST";
            $this->index();;
        }
        //JSON de respuesta
        echo json_encode($data);
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
                $this->load->view('backend/templates/header');
                $this->load->view('backend/templates/navbar');
                $this->load->view('backend/formulario_carnets', $data);
                $this->load->view('backend/templates/footer');
            }
            else
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required');
                $this->form_validation->set_rules('precio', 'Precio', 'required');
                $this->form_validation->set_rules('limite', 'Limite', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
                $this->form_validation->set_rules('imagen', 'Imagen', 'required'); 
                if ($this->form_validation->run())                        
                {
                    if($this->Carnets_model->update($id, $nombre, $precio, $limite, $descripcion, $imagen)){
                        $data['error']="ALL_OK";
                        redirect($this->index());
                        echo '<script language="javascript">';
                        echo 'alert("Modificaion con exito")';
                        echo '</script>';
                    }
                    else
                    {
                        $data['error']="NOT_CREATED";//ocurrio un error
                        $this->index();;
                    }
                }
                else
                {
                     $data['error']="BAD_POST";
                    $this->load->view('backend/templates/header');
                    $this->load->view('backend/templates/navbar');
                    $this->load->view('backend/formulario_carnets');
                    $this->load->view('backend/templates/footer');
                    $id = $this->input->post('id');
                    
                }
                echo json_encode($data);
            }

        }
}
?>