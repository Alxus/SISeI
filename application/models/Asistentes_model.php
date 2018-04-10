<?php
class Asistente_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

   public function getAsistentes()
   { 
        $query = $this->db->get('asistente');//Consulta que regresa todos los asistentes de la BD
        if ($query->num_rows()>0){ //verifica que la consulta regrese datos
            return $query;
        }else{
            return FALSE;
        }   
    }

}