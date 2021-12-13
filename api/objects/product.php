<?php
class Student {

	private $conn;
	private $table_name = "product";

	public $id_product;
	public $name;
	public $unit_of_measurement;
	public $sale_price;
	public $purchase_price;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `ID_PRODUCT`,`NAME`,`UNIT_OF_MEASUREMENT`,`SALE_PRICE`,`PURCHASE_PRICE` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
	function create() {
		$query = "INSERT INTO ".$this->table_name." (`ID_PRODUCT`,`NAME`,`UNIT_OF_MEASUREMENT`,`SALE_PRICE`,`PURCHASE_PRICE`) VALUES (:id_product, :name, :unit_of_measurement, :sale_price, :purchase_price)";

		$stmt = $this->conn->prepare($query);

		$this->id_product = htmlspecialchars(strip_tags($this->id_product));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->unit_of_measurement = htmlspecialchars(strip_tags($this->unit_of_measurement));
		$this->sale_price = htmlspecialchars(strip_tags($this->sale_price));
		$this->purchase_price = htmlspecialchars(strip_tags($this->purchase_price));

		$stmt->bindParam(":id_product", $this->id_product);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":unit_of_measurement", $this->unit_of_measurement);
		$stmt->bindParam(":sale_price", $this->sale_price);
		$stmt->bindParam(":purchase_price", $this->purchase_price);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}
	
	function search($keyword){
	        $query = "SELECT `ID_PRODUCT`, `NAME`, `UNIT_OF_MEASUREMENT`, `SALE_PRICE`, `PURCHASE_PRICE` FROM " . $this->table_name . " ORDER BY `NAME` DESC";

	        $stmt = $this->conn->prepare($query);

	        $keywords=htmlspecialchars(strip_tags($keywords));
	        $keywords = "%{$keywords}%";

	        $stmt->bindParam(1, $keywords);

	        $stmt->execute();

                return $stmt;
        }
	function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE `ID_PRODUCT` = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_product=htmlspecialchars(strip_tags($this->id_product));

	        $stmt->bindParam(1, $this->id);

	        if ($stmt->execute()) {
		        return true;
		}
	 
	        return false;
	}
	
        public function count(){
	        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

	        $stmt = $this->conn->prepare( $query );
	        $stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

	        return $row['total_rows'];
	}	
}
?>
