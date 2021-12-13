<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';
include_once '../objects/provider.php';

$database = new Database();
$db = $database->getConnection();

$provider = new Provider($db);

$data = json_decode(file_get_contents("php://input"));

$provider->id = $data->id;

if ($provider->delete()) {
	http_response_code(200);

	echo json_encode(array("message" => "UDALEN"), JSON_UNISCAPED_UNICODE);
}
else {
	http_response_code(503);

	echo json_encode(array("message" => "NE VISHLO"));
}
?>
