<?php
class BasketsModel extends Model {
    public function getBasketList() {
        $mysqli = new mysqli("db", "root", "example", "appDB");
        return $mysqli->query("SELECT * FROM basket");
    }
    private ?mysqli $conn;
    private string $table_name = "basket";

    public int $id;
    public ?string $naming;
    public int $price;
    public int $amount;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.naming, s.price, s.amount FROM basket AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create($entity) {
        $query = "INSERT INTO basket(naming, price, amount) VALUE ('".$entity['naming']."', '".$entity['price']."', '".$entity['amount']."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne($id) {
        $query = "SELECT s.id, s.naming, s.price, s.amount FROM basket AS s WHERE s.id = ".$id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }

    function update($entity) {
        $query = "
            UPDATE basket 
            SET naming = '".$entity['naming']."', price = '".$entity['price']."', amount = '".$entity['amount']."' 
            WHERE id = ".$entity['id'].";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete($id) {
        $query = "DELETE FROM basket WHERE id = ".$id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}