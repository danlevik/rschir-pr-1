<?php

class Basket {
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

    function create() {
        $this->naming = htmlspecialchars(strip_tags($this->naming));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->amount = htmlspecialchars(strip_tags($this->amount));

        $query = "INSERT INTO basket(naming, price, amount) VALUE ('".$this->naming."', '".$this->price."', '".$this->amount."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT s.id, s.naming, s.price, s.amount FROM basket AS s WHERE s.id = ".$this->id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }

    function update() {
        $query = "
            UPDATE basket 
            SET naming = '".$this->naming."', price = '".$this->price."', amount = '".$this->amount."' 
            WHERE id = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM basket WHERE id = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}