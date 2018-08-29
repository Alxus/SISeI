<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talleres_controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->authentication->check_user()){
          redirect(base_url());
          return;
      }
		//Cargamos los modelos que vamos a necesitar en el constructor
		$this->load->model('Talleres_model');
		$this->load->library('Pdf');
		//Reglas para validar formularios.
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		$this->form_validation->set_rules('requisitos', 'Requisitos', 'required');
		$this->form_validation->set_rules('lugar', 'Lugar', 'required');
		$this->form_validation->set_rules('fecha', 'Fecha', 'required');
		$this->form_validation->set_rules('hora', 'Hora', 'required');
		$this->form_validation->set_rules('limite', 'Limite', 'integer|required');
		$this->form_validation->set_rules('nivel', 'Nivel', 'integer|required');
		$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_rules('icono', 'Icono', 'required');
		//reglas para subir imagenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
		$config['remove_spaces'] = TRUE;
		$this->upload->initialize($config);
		date_default_timezone_set( 'America/Mazatlan' );
		setlocale(LC_ALL , "es_CO.UTF-8");
		$this->load->model('Comentarios_model');
	}
	
	public function index(){
		$data['title']='Talleres';
		$data['talleres']=$this->Talleres_model->get_talleres();
		$data['Ponentes'] = $this->Talleres_model->getPonentes();
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/lista_talleres');
		$this->load->view('backend/templates/footer');
	}

	public function create_taller(){
		 if($this->form_validation->run()){
		      $data['ponente_id']=0;
		      $data['nombre']=$this->input->post('nombre');
		      $data['descripcion']=$this->input->post('descripcion');
		      $data['requisitos']=$this->input->post('requisitos');
		      $data['lugar']=$this->input->post('lugar');
		      $data['fecha']=$this->input->post('fecha');
		      $data['hora']=$this->input->post('hora');
		      $data['limite']=$this->input->post('limite');
		      $data['nivel']=$this->input->post('nivel');
		      if($this->upload->do_upload('btnimg')){
		        $data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
		        if($this->upload->do_upload('btnicon')){
		          $data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
		          if($this->Talleres_model->create_taller($data)){
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
		      $data['error']="BAD_POST";
		    }
		    redirect(base_url()."admin/panel/talleres");
	}

	public function edit(){
			$id = $this->input->get('id');
            $resultado = $this->Talleres_model->get_taller_by_id($id);
            $nombre = $this->input->post('nombre');
            $data['nombre'] = $nombre;
            $descripcion = $this->input->post('descripcion');
            $data['descripcion'] = $descripcion;
            $requisitos = $this->input->post('requisitos');
            $data['requisitos'] = $requisitos;
            $lugar = $this->input->post('lugar');
            $data['lugar'] = $lugar;
            $fecha = $this->input->post('fecha');
            $data['fecha'] = $fecha;
            $hora = $this->input->post('hora');
            $data['hora'] = $hora;
            $limite = $this->input->post('limite');
            $data['limite'] = $limite;
            $nivel = $this->input->post('nivel');
            $data['nivel'] = $nivel;

            if($resultado!=null)
            {
                redirect(base_url()."admin/panel/talleres");
            }
            else
            {
                $id = $this->input->post('id');
                if ($this->form_validation->run())                        
                {
	                if($this->upload->do_upload('btnimg')){
						$data['imagen']=base_url().'assets/img/'.$this->upload->data('file_name');
						if($this->upload->do_upload('btnicon')){
							$data['icono']=base_url().'assets/img/'.$this->upload->data('file_name');
							if($this->Talleres_model->update_taller($data)){

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
				$data['error']="BAD_POST";
				}
				echo json_encode($data);

     	  }
     }

	public function delete()
        {
        	$id = $this->input->get('id');
            $this->Talleres_model->delete_taller($id);
            $this->index();
            echo '<script language="javascript">';
            echo 'alert("Se a borrado el taller con exito")';
            echo '</script>';
        }

	public function lista_talleres(){
		echo json_encode($this->Talleres_model->get_talleres());
	}

	public function info($id){
		$data['taller']=$this->Talleres_model->get_taller($id);
		$data['comentarios'] = $this->Comentarios_model->get_coments_taller($id);
		$data['title']=$data['taller']['nombre'];
		$this->load->view('backend/templates/header',$data);
		$this->load->view('backend/templates/navbar');
		$this->load->view('backend/info_taller');
		$this->load->view('backend/templates/footer');
	}

	public function printlst(){
		$data['talleres']=$this->Talleres_model->get_talleresPDF();
		$header=array_keys($data['talleres'][0]);
		$this->pdf->SetFillColor(33 , 150 , 243);
		$this->pdf->AliasNbPages();
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->MultiCell(0,10,'Lista de Talleres');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->tablewidths = array(10, 30, 30, 30, 30, 30, 12, 25);
		for($i=0; $i<sizeof($header); $i++){
			$this->pdf->Cell($this->pdf->tablewidths[$i],7,$header[$i],1,0,'C',true);
		}
		for ($i=0; $i<sizeof($data['talleres']);$i++) {
			$date = date_timestamp_get(date_create($data['talleres'][$i]['Fecha']));
			$data['talleres'][$i]['Fecha']=strftime('%a, %d/%b/%Y %l:%M %p', $date);
		}
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->morepagestable($data['talleres'],5,"C",false);
		$this->pdf->Output('lista_talleres.pdf', 'I');
	}

	public function printlstA($id){
		$data['asistentes']=$this->Talleres_model->get_asistentesPDF($id);
		$taller = $this->Talleres_model->get_taller_by_id($id);
		$header=array_keys($data['asistentes'][0]);
		$this->pdf->SetFillColor(33 , 150 , 243);
		$this->pdf->AliasNbPages();
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial','B',16);
		$this->pdf->MultiCell(0,10,"Taller: ".$taller['nombre'],0,"C");
		$this->pdf->MultiCell(0,10,'Lista de Asistentes',0,"C");
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->tablewidths = array(12, 25, 153);
		for($i=0; $i<sizeof($header); $i++){
			$this->pdf->Cell($this->pdf->tablewidths[$i],7,$header[$i],1,0,'C',true);
		}
		$this->pdf->Ln();
		$this->pdf->SetFont('Arial','',12);
		$this->pdf->tablaAsistentes($data['asistentes'],8,"C",true);
		$this->pdf->Output('lista_talleres.pdf', 'I');
	}

	 

}
