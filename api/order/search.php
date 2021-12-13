<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../confin/core.php';
include_once '../config/db.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $order->search($keywords);
$num = $stmt->rowCount();

if ($num>0) {
	$orders_arr = array();
	$orders_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        extract($row);
	        
	        $student_item=array(
		        "id_order" => $ID_ORDER,
		        "id_product" => $ID_PRODUCT,
		        "unit_of_measurement" => $UNIT_OF_MEASUREMENT,
				"date" => $DATE,
				"kol-vo" => $KOL-VO,
				"id_provider" => $ID_PROVIDER,
		);

	        array_push($orders_arr["records"], $order_item);
	}

        http_records_code(200);

        echo json_encode($orders_arr);
}

else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>
