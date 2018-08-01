<?php
class Talleres_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function create_taller($data){
        $this->db->insert('taller',$data);
        return $this->db->affected_rows()!=0;
    }

     public function get_talleres(){
        $this->db->select('t.*,CONCAT(p.nombres," ",p.apellidos) as tallerista');
        $this->db->from('taller as t');
        $this->db->join('ponente as p','t.ponente_id=p.id');
        return $this->db->get()->result_array();
    }
    
    public function update_taller($data){
        $this->db->update('taller',$data);
        return $this->db->affected_rows()!=0;
    }

    public function get_taller($id){
        $this->db->select('t.*,CONCAT(p.nombres," ",p.apellidos) as tallerista');
        $this->db->from('taller as t');
        $this->db->join('ponente as p','t.ponente_id=p.id');
        $this->db->where('t.id',$id);
        return $this->db->get()->result_array()[0];
    }

    public function delete_taller($id)
    {
        $this->db->delete('taller', array('id' => $id));
        return $this->db->affected_rows()!=0;
    }

    function get_taller_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('taller');
        return $query->result_array();
    }

    public function get_talleresPDF(){
        $this->db->select('t.nombre as Taller,
            CONCAT(p.nombres," ",p.apellidos) as Tallerista,
            t.descripcion as Descripcion,
            t.requisitos as Requisitos,
            CONCAT(t.fecha," ",t.hora)as Fecha,
            t.limite as Limite,
            t.lugar as Lugar'
        );
        $this->db->from('taller as t');
        $this->db->join('ponente as p','t.ponente_id=p.id');
        return $this->db->get()->result_array();
    }

}
