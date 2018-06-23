<?php
class Usuario_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        date_default_timezone_set( 'America/Mazatlan' );
    }

    public function create_user($data){
        return($this->db->where('username',$data['username'])->get('usuario')==null)?$this->db->insert('usuario',$data):false;
    }

    public function find_user($data){
        return $this->db->get_where('usuario',$data)->result_array();
    }

    public function getAllUsers(){
        return $this->db->get('usuario')->result_array();
    }

    public function updateAccessed($id){
        $this->db->set('last_accessed',date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
        return $this->db->update('usuario');
    }

}
