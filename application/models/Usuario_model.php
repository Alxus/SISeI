<?php
class Usuario_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        date_default_timezone_set( 'America/Mazatlan' );
    }

    public function create_user($data){
        return($this->db->where('username',$data['username'])->get('usuario')->result_array()==null)?$this->db->insert('usuario',$data):false;
    }

    public function find_user($data){
        $query=$this->db->where('username',$data['username'])->get('usuario')->result_array()[0];
        if($this->encryption->decrypt($query['password'])==$this->encryption->decrypt($data['password'])){
            return $query;
        }
        return null;
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
