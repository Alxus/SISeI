<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/third_party/CompropagoSdk/UnitTest/autoload.php';
use CompropagoSdk\Client;
use CompropagoSdk\Factory\Factory;
class Pagos_controller extends CI_Controller {
	private $webhook;
	public function __construct(){
		parent::__construct();
		$this->load->model('Pagos_model');
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
						$Abono[0]->Id_Detalle_Carnet, 
						$Abono[0]->Id_Cargo, 
						$Abono[0]->Folio_Cargo, 
						$Abono[0]->Cantidad, 
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
		//generamos una nueva orden
		$client = new Client(
		    'pk_test_9952f9b28224929214',  # publickey
		    'sk_test_4fc2245775a04e095c',  # privatekey
		    FALSE                         # live
		);
		$order_info = [
			'order_id' => 1,
			'order_name' => 'Carnet Basico',
			'order_price' => 6.00,
			'customer_name' => 'David',
			'customer_email' => 'davidmv1295@gmail.com',
			'payment_type' => 'OXXO',
			'currency' => 'MXN'
		];
		$order = Factory::getInstanceOf('PlaceOrderInfo', $order_info);
		$order->expires_at=1484799158;
		$neworder = $client->api->placeOrder($order);
		$verify=$client->api->verifyOrder($neworder->id);
		$data=[
			'asistente_carnet_id'=>1,
			'id_cargo'=>$verify->id,
			'folio_cargo'=>$verify->short_id,
			'customer_name'=>$verify->customer->customer_name,
			'cantidad'=>$verify->amount,
			'fecha_solicitud'=>$verify->created_at,
			'fecha_expiracion'=>$verify->expires_at,
			'fecha_pago'=>null,
			'tienda'=>"OXXO",
			'status'=>$verify->type,
			'descripcion_abono'=>'SOLICITADO'
		];
		echo json_encode($data);
		echo json_encode($verify);
		if($this->Pagos_model->create($data)){
			echo json_encode("ALL_OK");
		}
		else{
			echo json_encode("NOT_CREATED");
		}

	}

}
