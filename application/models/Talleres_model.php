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
        return $this->db->get('taller')->result_array();
    }
    
    public function edit_taller($data){
        $this->db->update('taller',$data);
        return $this->db->affected_rows()!=0;
    }

    public function find_taller($data){
        return $this->db->get_where('taller',$data)->result_array();
    }

}
