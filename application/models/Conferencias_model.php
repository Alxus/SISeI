<?php
class Conferencias_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
     public function add($data){
   		 $this->db->insert('conferencia',$data);
   		 return $this->db->affected_rows()!=0;
   }

	public function get($nombre = FALSE)
    {
        if ($nombre === FALSE)
        {
            $this->db->order_by('id', 'asc');
            $query = $this->db->get('conferencia');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('conferencia', array('nombre' => $nombre));
        return $query->result_array();
    }

	public function delete($id)
	{
	    $this->db->delete('conferencia', array('id' => $id));
	}

    function get_conferencia_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('conferencia');
        return $query->row_array();
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
}
?>