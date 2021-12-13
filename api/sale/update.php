<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");

include_once "../config/db.php";
include_once "../objects/sale.php";

$database = new Database();
$db = $databse->getConnection();

$sale = new Sale($db);

$data = json_decode(file_get_contents("php://input"));

$sale->id_sale = $data->$id_sale;
$sale->date = $data->date;
$sale->kol-vo = $data->kol-vo;
$sale->sum = $data->$sum;
$sale->id_product = $data->$id_product;

if ($sale->update()) {
	http_response_code(200);

	echo json_encode(array("message" => "IZMENENO"), JSON_UNESCAPED_UNICODE);
}

else {
	http_response_code(503);

	echo json_encode(array("message" => "NEVOZMOZHNO"), JSON_UNESCAPED_UNICODE);
}
?>
