<?php
class Asistentes_model extends CI_Model{

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

    public function exist_Asistente($Fb_Id){
        $this->db->select('*');
        $this->db->where('facebook_id', $Fb_Id);
        $query = $this->db->get('asistente');
        return $query->row_array();
    }
    public function ingresar_Asistente($datos){
        $result  = array('affected_rows' , 'Id_Asistente' );
        $this->db->insert('asistente',$datos);
        $result['affected_rows'] = $this->db->affected_rows();          //Columnas afectadas (Solo debe ser 1)
        $result['Id_Asistente']  = $this->db->insert_id();              //El Id que se le asignaró al asistente solo necesario la primera vez
        return $result;
    }
    public function get_Asistente($id){
        $where['id']=$id;
        return $this->db->get_where('asistente', $where)->result_array();
    }
    public function get_Asistentes(){
        return $this->db->get('asistente')->result_array();
    }
}