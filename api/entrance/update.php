<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");

include_once "../config/db.php";
include_once "../objects/entrance.php";

$database = new Database();
$db = $databse->getConnection();

$entrance = new Entrance($db);

$data = json_decode(file_get_contents("php://input"));

$entrance->id_postavka = $data->$id_postavka;

$entrance->date_postavka = $data->date_postavka;
$entrance->kol-vo = $data->kol-vo;
$entrance->sum_postavka = $data->sum_postavka;
$entrance->id_provider = $data->id_provider;
$entrance->id_product = $data->id_product;

if ($entrance->update()) {
	http_response_code(200);

	echo json_encode(array("message" => "IZMENENO"), JSON_UNESCAPED_UNICODE);
}

else {
	http_response_code(503);

	echo json_encode(array("message" => "NEVOZMOZHNO"), JSON_UNESCAPED_UNICODE);
}
?>
