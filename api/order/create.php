<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/db.php";
include_once "../objects/order.php";

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_order) && !empty($data->id_product) && !empty($data->unit_of_measurement) && !empty($data->date) && !empty($data->kol-vo) && !empty($data->id_provider)) {
	$order->id_order = $data->id_order;
	$order->id_product = $data->id_product;
	$order->unit_of_measurement = $data->unit_of_measurement;
	$order->date = $data->date;
	$order->kol-vo = $data->kol-vo;
	$order->id_provider = $data->id_provider;

	if ($order->create()) {
		http_response_code(201);

		echo json_encode(array("message" => "SOZDANO"), JSON_UNESCAPED_UNICODE);
	}

	else {
		http_response_code(503);

		echo json_encode(array("message" => "NEVOZMOZHNO"), JSON_UNESCAPED_UNICODE);
	}
}
else {
	http_response_code(400);

	echo json_encode(array("message" => "NEPOLNO"), JSON_UNESCAPED_UNICODE);
}
?>

