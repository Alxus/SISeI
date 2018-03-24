<?php
class Usuario_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function create_user($data){
        $this->db->insert('usuario',$data);
        return $this->db->affected_rows()!=0;
    }

    public function find_user($data){
        return $this->db->get_where('usuario',$data)->resul_array();
    }

}
