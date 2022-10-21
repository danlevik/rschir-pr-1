<?php

class Material {
    private ?mysqli $conn;
    private string $table_name = "material";

    public int $id;
    public ?string $naming;
    public int $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT s.id, s.naming, s.price FROM material AS s
        ORDER BY s.id; 
        ";

        $stmt = $this->conn->query($query);
        return $stmt;
    }

    function create() {
        $this->naming = htmlspecialchars(strip_tags($this->naming));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $query = "INSERT INTO material(naming, price) VALUE ('".$this->naming."', '".$this->price."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT s.id, s.naming, s.price FROM material AS s WHERE s.id = ".$this->id.";";
        $result = $this->conn->query($query)->fetch_row();
        return $result;
    }

    function update() {
        $query = "
            UPDATE material 
            SET naming = '".$this->naming."', price = '".$this->price."' 
            WHERE id = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM material WHERE id = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}