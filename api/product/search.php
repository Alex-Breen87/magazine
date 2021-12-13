<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../confin/core.php';
include_once '../config/db.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $product->search($keywords);
$num = $stmt->rowCount();

if ($num>0) {
	$products_arr = array();
	$products_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	        extract($row);
	        
	        $product_item=array(
		        "id_product" => $ID_PRODUCT,
		        "name" => $NAME,
		        "unit_of_measurement" => $UNIT_OF_MEASUREMENT,
				"sale_price" => $SALE_PRICE,
				"purchase_price" => $PURCHASE_PRICE
		);

	        array_push($products_arr["records"], $product_item);
	}

        http_records_code(200);

        echo json_encode($products_arr);
}

else {
	http_response_code(404);

	echo json_encode(array("message" => "NE NAIDENO"), JSON_UNESCAPED_UNICODE);
}
?>
