<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once "../config/db.php";
include_once "../objects/provider.php";

$database = new Database();
$db = $database->getConnection();

$provider = new Provider($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->address) && !empty($data->phone) && !empty($data->shet)) {
    $provider->id_provider = $data->id_provider;
	$provider->name = $data->name;
	$provider->address = $data->address;
	$provider->phone = $data->phone;
    $provider->shet = $data->shet;
	if ($provider->create()) {
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

