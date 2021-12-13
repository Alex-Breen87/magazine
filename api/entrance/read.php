<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";
include_once "../objects/entrance.php";

$database = new Database();
$db = $database->getConnection();

$entrance = new Entrance($db);

$stmt = $entrance->read();
$num = $stmt->rowCount();

if ($num > 0) {
	$entrances_arr = array();
	$entrances_arr['records'] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$entrance_item = array(
			"id_postavka" => $ID_POSTAVKA,
			"date_postavka" => $DATE_POSTAVKA,
			"kol-vo" => $KOL-VO,
			"sum_postavka" => $SUM_POSTAVKA,
			"id_provider" => $ID_PROVIDER,
			"id_product" => $ID_PRODUCT
		);

		array_push($entrances_arr['records'], $entrance_item);
	}
        http_response_code(200);

        echo json_encode($entrances_arr);
}
else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>

