<?php
class Pagos_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function create($data){
        $this->db->insert('pago',$data);
        return $this->db->affected_rows()!=0;
    }


}
