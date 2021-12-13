<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/db.php";
include_once "../objects/product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_product) && !empty($data->name) && !empty($data->unit_of_measurement) && !empty($data->sale_price) && !empty($data->purchase_price)) {
	$student->id_product = $data->id_product;
	$student->name = $data->name;
	$student->unit_of_measurement = $data->unit_of_measurement;
	$student->sale_price = $data->sale_price;
	$student->purchase_price = $data->purchase_price;

	if ($product->create()) {
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

