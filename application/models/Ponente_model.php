<?php
class Ponente_model extends CI_Model{

    function __construct(){
        $this->load->database();
    }
    
     public function add($data){
   		 $this->db->insert('ponente',$data);
   		 return $this->db->affected_rows()!=0;
   }

	public function get($nombre = FALSE)
    {
        if ($nombre === FALSE)
        {
            $this->db->order_by('id', 'asc');
            $query = $this->db->get('ponente');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('ponente', array('nombres' => $nombres));
        return $query->result_array();
    }

    public function getnombretaller($id)
    {
       $resultado = $this->db->select('nombre')->from('taller')->where('ponente_id',$id)->get();
       return $resultado->result_array();
        
    }

     public function getnombreconferencia($id)
    {
       $resultado = $this->db->select('nombre')->from('conferencia')->where('ponente_id',$id)->get();
       return $resultado->result_array();
        
    }

	public function delete($id)
	{
	    $this->db->delete('ponente', array('id' => $id));
	}

    function get_ponente_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('ponente');
        return $query->row_array();
    }
    function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('ponente', $data);
    }


    public function get_ponentesPDF(){
        $this->db->select('p.id as "No.",
            CONCAT(p.nombres," ",p.apellidos) as Ponente,
            p.descripcion as Descripcion,
            t.nombre as Taller,
            c.nombre as Conferencia'
        );
        $this->db->from('ponente as p');
        $this->db->join('taller as t','t.ponente_id=p.id','left');
        $this->db->join('conferencia as c','c.ponente_id=p.id','left');
        return $this->db->get()->result_array();
    }


     public function get_ponentes(){
        $this->db->select('p.*,
            CONCAT(p.nombres," ",p.apellidos) as nombre,
            p.descripcion as descripcion,
            t.nombre as taller,
            c.nombre as conferencia'
        );
        $this->db->from('ponente as p');
        $this->db->join('taller as t','t.ponente_id=p.id','left');
        $this->db->join('conferencia as c','c.ponente_id=p.id','left');
        return $this->db->get()->result_array();
    }
}
?>