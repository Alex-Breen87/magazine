<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";
include_once "../objects/provider.php";

$database = new Database();
$db = $database->getConnection();

$provider = new Provider($db);

$stmt = $provider->read();
$num = $stmt->rowCount();

if ($num > 0) {
	$providers_arr = array();
	$providers_arr['records'] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$provider_item = array(
			"id_provider" => $ID_PROVIDER,
			"name" => $NAME,
			"address" => $ADDRESS,
			"phone" => $PHONE,
			"shet" => $SHET,
		);

		array_push($providers_arr['records'], $provider_item);
	}
        http_response_code(200);

        echo json_encode($providers_arr);
}
else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>

