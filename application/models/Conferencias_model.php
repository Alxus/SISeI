<?php
class Conferencias_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
     public function add($data){
   		 $this->db->insert('conferencia',$data);
   		 return $this->db->affected_rows()!=0;
   }

	public function get()
    {
       $this->db->select('c.*,CONCAT(p.nombres," ",p.apellidos) as ponente,  CONCAT(c.fecha," ",c.hora) as Fecha');
        $this->db->from('conferencia as c');
        $this->db->join('ponente as p','c.ponente_id=p.id');
        return $this->db->get()->result_array();
    }

    public function get_conferencias_landing(){
        return $this->db->get('vw_conferencias')->result_array();
    }

    public function getPonentes()
    {
        $this->db->order_by('id', 'asc');
        $this->db->select('id, nombres, apellidos');
        $query = $this->db->get('ponente');
        return $query->result_array();
    }

	public function delete($id)
	{
	    $this->db->delete('conferencia', array('id' => $id));
	}

    function get_conferencia_by_id($id)
    {
        $this->db->select('c.*,CONCAT(p.nombres," ",p.apellidos) as ponente,  CONCAT(c.fecha," ",c.hora) as Fecha');
        $this->db->from('conferencia as c');
        $this->db->join('ponente as p','c.ponente_id=p.id');
        $this->db->where('c.id',$id);
        return $this->db->get()->row_array();
    }
    function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('conferencia', $data);
    }


    public function get_conferenciasPDF(){
        $this->db->select('c.nombre as Conferencia,
            CONCAT(p.nombres," ",p.apellidos) as Conferencista,
            c.descripcion as Descripcion,
            CONCAT(c.fecha," ",c.hora)as Fecha,
            c.ubicacion as Ubicacion'
        );
        $this->db->from('conferencia as c');
        $this->db->join('ponente as p','c.ponente_id=p.id');
        return $this->db->get()->result_array();
    }

    public function get_importantes(){
        return $this->db->get('vw_conferencias',3)->result_array();
    }
}
?>