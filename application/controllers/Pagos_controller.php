<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/third_party/CompropagoSdk/UnitTest/autoload.php';
use CompropagoSdk\Client;
use CompropagoSdk\Factory\Factory;
class Pagos_controller extends CI_Controller {
	private $webhook;
	private $client;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set( 'America/Mazatlan' );
		$this->load->model('Pagos_model');
		$this->client = new Client(
		    'pk_test_9952f9b28224929214',  # publickey
		    'sk_test_4fc2245775a04e095c',  # privatekey
		    FALSE                         # live
		);
	}
	
	public function index(){
		$this->generar_orden();
	}

	public function paylistener(){
		$body = @file_get_contents('php://input');
		$event_json = json_decode($body,TRUE);
		$resp=["status"=> "success",  
		"short_id"=> $event_json['short_id'],
		"message"=> "",
		"reference"=> null];
  		        //Si esta bien constituido el JSON
		if($this->_checkJson($event_json)){
            //Obtener los datos del abono
			$Abono = $this->Pagos_model->getAbono($event_json['id'],$event_json['short_id']);
            //Si existe el abono
			if (!empty((array)$Abono)) {
				if(!empty((array)$Abono[0])){
					$actualizacion = $this->Pagos_model->up_Abonos(
						$Abono[0]->asistente_carnet_id, 
						$Abono[0]->id_cargo, 
						$Abono[0]->folio_Cargo, 
						$Abono[0]->cantidad, 
						$event_json['type']
					);
					if($actualizacion == 1){
                    //Se realizo la operacion exitosamente
						$resp["message"]='ALL_OK';
					}else{
                    //La actualizacion no se logro
						$resp["message"]= 'No se actualizo nada';
					}
				}else{
					$resp["message"]= 'Abono no existe en if interno';
				}
			}else{
				$resp["message"]= 'No existe el abono';
			}       
		}
		echo json_encode($resp);
	}

	//Funcion para checar los datos del JSON obtenido
	public function _checkJson($JSON)
	{
      //Checar que existan esos campos
		if (isset($JSON['id'], $JSON['short_id'], $JSON['type'] , $JSON['amount'] )){
			return true;
		}else{
			return false;
		}
	}

	public function generar_orden(){
		$order_info = [
			'order_id' => 1,
			'order_name' => 'Carnet Basico',
			'order_price' => 6.00,
			'customer_name' => 'David Adrian Meza Valenzuela',
			'customer_email' => 'davidmv1295@gmail.com',
			'payment_type' => 'OXXO',
			'currency' => 'MXN',
			'expiration_time'=>1540533600
		];
		$order = Factory::getInstanceOf('PlaceOrderInfo', $order_info);
		$order->customer_phone = 6677745430;
		$neworder = $this->client->api->placeOrder($order);
		$verify=$this->client->api->verifyOrder($neworder->id);
		$description=$neworder->instructions->description;
		$step_1=$neworder->instructions->step_1;
		$step_2=$neworder->instructions->step_2;
		$step_3=$neworder->instructions->step_3;
		$note_extra_comition=$neworder->instructions->note_extra_comition;
		$note_expiration_date=$neworder->instructions->note_expiration_date;
		$descripcion_abono=$description.
		'\n Paso 1.- '.$step_1.
		'\n Paso 2.- '.$step_2.
		'\n Paso 3.- '.$step_3.
		'\n Nota extra de comisión.- '.$note_extra_comition.
		'\n Nota extra de expiración .- '.$note_expiration_date;
		$data=[
			'asistente_carnet_id'=>1,
			'id_cargo'=>$neworder->id,
			'folio_cargo'=>$neworder->short_id,
			'customer_name'=>$verify->customer->customer_name,
			'cantidad'=>$verify->amount,
			'fecha_solicitud'=>date("Y-m-d H:i:s", substr($verify->created, 0, 10)),
			'fecha_expiracion'=>date("Y-m-d H:i:s", substr($neworder->exp_date, 0, 10)),
			'tienda'=>"OXXO",
			'status'=>$verify->type,
			'descripcion_abono'=>$descripcion_abono
		];
		if($this->Pagos_model->create($data)){
			$data['error']="ALL_OK";
		}
		else{
			$data['error']="NOT_CREATED";
		}
		echo json_encode($data);
	}

}
