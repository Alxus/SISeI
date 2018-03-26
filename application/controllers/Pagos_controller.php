<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'application/third_party/CompropagoSdk/UnitTest/autoload.php';
use CompropagoSdk\Client;
use CompropagoSdk\Service;
use CompropagoSdk\Factory\Factory;
class Pagos_controller extends CI_Controller {
	private $client;
	private $webhook;
	public function __construct(){
		parent::__construct();
		$this->load->model('Pagos_model');
		$this->client = new Client(
		    'pk_test_9952f9b28224929214',  # publickey
		    'sk_test_4fc2245775a04e095c',  # privatekey
		    false                         # live
		);
	}
	
	public function index(){
		$this->generar_orden();
	}

	function generar_orden(){
		//generamos una nueva orden
		$order_info = [
			'order_id' => 1,
			'order_name' => 'Carnet Basico',
			'order_price' => 6.00,
			'customer_name' => 'David',
			'customer_email' => 'davidmv1295@gmail.com',
			'payment_type' => 'OXXO',
			'currency' => 'MXN',
			'expiration_time' => 1484799158,
			'customer'=>[
				'customer_name' => 'David',
				'customer_email' => 'davidmv1295@gmail.com',
				'customer_phone' => '6677745430'
			]
		];
		$order = Factory::getInstanceOf('PlaceOrderInfo', $order_info);
		echo json_encode($order);
		$neworder = $this->client->api->placeOrder($order);
		echo json_encode($neworder);
		//insertamos en la base de datos
		/*$order_id = $neworder->id;
		$info = $this->client->api->verifyOrder($order_id);
		$data=[
			'asistente_carnet_id'=>1,
			'id_cargo'=> $info->id,
			'folio_cargo'=> $info->sort_id,
			'customer_name'=>'David',
			'cantidad'=> $info->amount,
			'fecha_solicitud'=>$info->created_at,
			'fecha_expiracion'=>$info->expires_at,
			'fecha_pago'=>null,
			'tienda'=>'OXXO',
			'status'=> $info->type,
			'descripcion_abono'=>''
		];
		if($this->Pagos_model->create($data)){
			$data['error']="Fierro alv";
			echo json_encode($data);
		}*/

	}

}
