<?php
class Order {

	private $conn;
	private $table_name = "order";

	public $id_order;
	public $id_product;
	public $unit_of_measurement;
	public $date;
	public $kol-vo;
	public $id_provider;

	public function __construct($db) {
		$this->conn = $db;
	}

	function read() {
		$query = "SELECT `ID_ORDER`,`ID_PRODUCT`,`UNIT_OF_MEASUREMENT`,`DATE`,`KOL-VO`,`ID_PROVIDER` FROM ".$this->table_name;

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		return $stmt;
	}
	function create() {
		$query = "INSERT INTO ".$this->table_name." (`ID_ORDER`,`ID_PRODUCT`,`UNIT_OF_MEASUREMENT`,`DATE`,`KOL-VO`,`ID_PROVIDER`) VALUES (:id_order, :id_product, :unit_of_measurement, :date, :kol-vo, :id_provider)";

		$stmt = $this->conn->prepare($query);

		$this->id_order = htmlspecialchars(strip_tags($this->id_order));
		$this->id_product = htmlspecialchars(strip_tags($this->id_product));
		$this->unit_of_measurement = htmlspecialchars(strip_tags($this->unit_of_measurement));
		$this->date = htmlspecialchars(strip_tags($this->date));
		$this->kol-vo = htmlspecialchars(strip_tags($this->kol-vo));
		$this->id_provider = htmlspecialchars(strip_tags($this->id_provider));

		$stmt->bindParam(":id_order", $this->id_order);
		$stmt->bindParam(":id_product", $this->id_product);
		$stmt->bindParam(":unit_of_measurement", $this->unit_of_measurement);
		$stmt->bindParam(":date", $this->date);
		$stmt->bindParam(":kol-vo", $this->kol-vo);
		$stmt->bindParam(":id_provider", $this->id_provider);

		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	function search($keyword){
	        $query = "SELECT `ID_ORDER`, `ID_PRODUCT`, `UNIT_OF_MEASUREMENT`, `DATE`, `KOL-VO`, `ID_PROVIDER` FROM " . $this->table_name . " ORDER BY `ID_PRODUCT` DESC";

	        $stmt = $this->conn->prepare($query);

	        $keywords=htmlspecialchars(strip_tags($keywords));
	        $keywords = "%{$keywords}%";

	        $stmt->bindParam(1, $keywords);

	        $stmt->execute();

                return $stmt;
        }
	function delete(){
	        $query = "DELETE FROM " . $this->table_name . " WHERE `ID_ORDER` = ?";

	        $stmt = $this->conn->prepare($query);

	        $this->id_order=htmlspecialchars(strip_tags($this->id));

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