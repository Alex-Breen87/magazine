<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/db.php";
include_once "../objects/sale.php";

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_sale) && !empty($data->date) && !empty($data->kol-vo) && !empty($data->sum) && !empty($data->id_product)) {
	$student->id_sale = $data->id_sale;
	$student->date = $data->date;
	$student->kol-vo = $data->kol-vo;
	$student->sum = $data->sum;
	$student->id_product = $data->id_product;

	if ($sale->create()) {
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

