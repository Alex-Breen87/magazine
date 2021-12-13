<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../confin/core.php';
include_once '../config/db.php';
include_once '../objects/sale.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $sale->search($keywords);
$num = $stmt->rowCount();

if ($num>0) {
	$sales_arr = array();
	$sales_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        extract($row);
	        
	        $sale_item=array(
		        "id_sale" => $ID_SALE,
		        "date" => $DATE,
		        "kol-vo" => $KOL-VO,
				"sum" => $SUM,
				"id_product" => $ID_PRODUCT,
		);

	        array_push($sales_arr["records"], $sale_item);
	}

        http_records_code(200);

        echo json_encode($sales_arr);
}

else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>
