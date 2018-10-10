<?php
class Pagos_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function create($data){
		$this->db->insert('pago',$data);
		return $this->db->affected_rows()!=0;
	}

	public function getAbono($Id_Cargo,$Folio_Abono){
		$this->db->select('*');
		$this->db->where('id_Cargo', $Id_Cargo);
		$this->db->where('folio_Cargo', $Folio_Abono);
		$this->db->from('pago');
		$query = $this->db->get();
		return $query->result();
	}

     //funcion para actualizar el estado de un Abono
	public function up_Abonos($asistente_carnet_id,$id_cargo,$folio_cargo,$cantidad_cargo,$status){
             //Fecha del pago vacia
		$fecha_pago='';
             //Si el pago es aprobatorio
		if($status=='charge.success')
			$fecha_pago=date('Y-d-m H:i:s');

		$this->db->trans_start();
             //Actualizar el status del abono
		$qr=$this->db->query("UPDATE pago SET status = '".$status."', fecha_pago = '".$fecha_pago."' WHERE asistente_carnet_id = '".$asistente_carnet_id."' AND id_cargo = '".$id_cargo."' AND folio_cargo = '".$folio_cargo."' ");                
             //Actualizar el status del detalle del carnet y la cantidad, si es una aprobacion de pago
		if ($status =='charge.success') {
			$det_carnet = $this->getListTableWhere('asistente_carnet','id',$asistente_carnet_id);

                  //Si existe el indice 0 del detalle del carnet
			if(isset($det_carnet[0])){
				$status_asistente_carnet = 'Apartado';
                     //Si lo  que Debe menos la cantidad aprobada es igual a 0; Ha finalizado los pagos
				if(((int)$det_carnet[0]->Debe - (int)$cantidad_cargo) == 0)
					$status_asistente_carnet ='Obtenido';
			}
                  //Actualizar el detalle del carnet
			$this->db->query("UPDATE asistente_carnet SET estado = '".$status_asistente_carnet."', debe = debe - ".$cantidad_cargo." WHERE id = '".$asistente_carnet_id."' ");
		}            $this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
			return 0;
		else
			return 1;
	}

	 //Metodo para obtener la lista de la tabla seleccionada
        //Acompañado de un 'WHERE'
	public function getListTableWhere($Table,$Where,$To){
		$this->db->select('*');
		$this->db->where($Where, $To);
		$this->db->from($Table);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPagados(){
		$this->db->select('COUNT(*) as total')->from('pago')->where('status="charge.success"');
        $pagados = $this->db->get()->row_array();
        return $pagados;
	}

}
