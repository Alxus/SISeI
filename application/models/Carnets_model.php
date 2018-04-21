<?php
class Carnets_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
     public function add($data){
   		 $this->db->insert('carnet',$data);
   		 return $this->db->affected_rows()!=0;
   }

	public function get($nombre = FALSE)
    {
        if ($nombre === FALSE)
        {
            $this->db->order_by('id', 'asc');
            $query = $this->db->get('carnet');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('carnet', array('nombre' => $nombre));
        return $query->result_array();
    }

	public function delete($id)
	{
	    $this->db->delete('carnet', array('id' => $id));
	}

	

    function get_carnets_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('carnet');
        return $query->result_array();
    }
    function update($id, $nombre, $precio, $limite, $descripcion, $imagen)
    {
        $this->db->where('id', $id);
        $this->db->set('nombre', $nombre);
        $this->db->set('precio', $precio);
        $this->db->set('limite', $limite);
        $this->db->set('descripcion', $descripcion);
        $this->db->set('imagen', $imagen);
        return $this->db->update('carnet');
    }
}
?>