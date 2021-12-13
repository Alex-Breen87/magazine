<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/db.php";
include_once "../objects/entrance.php";

$database = new Database();
$db = $database->getConnection();

$entrance = new Entrance($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_postavka) && !empty($data->date_postavka) && !empty($data->kol-vo) && !empty($data->sum_postavka) && !empty($data->id_provider) && !empty($data->id_product)) {
	$entrance->id_postavka = $data->id_postavka;
	$entrance->date_postavka = $data->date_postavka;
	$entrance->kol-vo = $data->kol-vo;
	$entrance->sum_postavka = $data->sum_postavka;
	$entrance->id_provider = $data->id_provider;
	$entrance->id_product = $data->id_product;

	if ($entrance->create()) {
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

