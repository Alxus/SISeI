<?php
class Comentarios_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		date_default_timezone_set( 'America/Mazatlan' );
	}

	public function create_coment($data){
		return $this->db->insert('comentario',$data);
	}

	public function get_coments_conf($id){
		$this->db->select('c.*, CONCAT(a.nombre_real," ",a.apellido_real) autor');
		$this->db->from('comentario as c');
		$this->db->join('asistente as a','c.asistente_id=a.id');
		$this->db->where("c.conferencia_id=".$id);
		return $this->db->get()->result_array();
	}

	public function get_coments_taller($id){
		$this->db->select('c.*, CONCAT(a.nombre_real," ",a.apellido_real) autor');
		$this->db->from('comentario as c');
		$this->db->join('asistente as a','c.asistente_id=a.id');
		$this->db->where("c.taller_id=".$id);
		return $this->db->get()->result_array();
	}  
}
