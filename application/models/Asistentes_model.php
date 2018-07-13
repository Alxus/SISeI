<?php
class Asistentes_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    /*public function getAsistentes()
    { 
        $query = $this->db->get('asistente');//Consulta que regresa todos los asistentes de la BD
        if ($query->num_rows()>0){ //verifica que la consulta regrese datos
            return $query;
        }else{
            return FALSE;
        }   
    }*/

    public function getAsistentes($nombre = FALSE)
    {
        if ($nombre === FALSE)
        {
            $this->db->order_by('id', 'asc');
            $query = $this->db->get('asistente');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('asistente', array('nombre' => $nombre));
        return $query->result_array();
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

    public function add($data){
         $this->db->insert('asistente',$data);
         return $this->db->affected_rows()!=0;
   }

    public function get_asistente_by_id($id){
        $where['id']=$id;
        return $this->db->get_where('asistente', $where)->result_array();
    }
    
    public function get_Asistentes_ventas(){
        $this->db->select('a.*, ac.*,c.nombre as carnet');
        $this->db->from('asistente as a');
        $this->db->join('asistente_carnet as ac','a.id=ac.asistente_id','left');
        $this->db->join('carnet as c','c.id=ac.carnet_id','left');
        return $this->db->get()->result_array();
    }

    public function abono_asistente($data){
        if($this->db->where('asistente_id',$data['asistente_id'])->where('carnet_id',$data['carnet_id'])->get('asistente_carnet')==null){
            return $this->db->insert('asistente_carnet',$data);
        }
        else{
            $data['updated_at']=date('Y-d-m H:i:s');
            return $this->db->where('asistente_id',$data['asistente_id'])->where('carnet_id',$data['carnet_id'])->update('asistente_carnet',$data);
        }
    }

    public function getPagados(){
        $this->db->select('COUNT(id) as total')->from('asistente')->where('estado=PAGADO');
        return $this->db->get()->result_array();
    }

    public function getbByEmail_OR_FbId($data){
        if($data['facebook_id']!=null){
            $this->db->select('a.*, ac.*');
            $this->db->from('asistente as a');
            $this->db->join('asistente_carnet as ac','a.id=ac.asistente_id');
            $this->db->join('carnet as c','c.id=ac.carnet_id');
            $this->db->where('a.facebook_id',$data['facebook_id']);
            return $this->db->get()->result_array();        
        }
        if($data['email']!=null){
            $this->db->select('a.*, ac.*');
            $this->db->from('asistente as a');
            $this->db->join('asistente_carnet as ac','a.id=ac.asistente_id');
            $this->db->join('carnet as c','c.id=ac.carnet_id');
            $this->db->where('a.email',$data['email']);
            return $this->db->get()->result_array(); 
        }
        return null;
    }
}