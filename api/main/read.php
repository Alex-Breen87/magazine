<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";
include_once "../objects/main.php";

$database = new Database();
$db = $database->getConnection();

$main = new Maine($db);

$stmt = $main->read();
$num = $stmt->rowCount();

if ($num > 0) {
	$maine_arr = array();
	$maine_arr['records'] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$main_item = array(
			"main_name" => $MAIN_NAME,
			"name" => $NAME,
			"address" => $ADDRESS,
			"phone" => $PHONE,
			"KPP" => $KPP,
			"INN" => $INN
		);

		array_push($maine_arr['records'], $main_item);
	}
        http_response_code(200);

        echo json_encode($maine_arr);
}
else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>

