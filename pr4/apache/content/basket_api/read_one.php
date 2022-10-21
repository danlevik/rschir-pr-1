<?php

include_once "../database_connection.php";
include_once "basket_db.php";

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

$database = new Database();
$db = $database->getConnection();

$basket = new Basket($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "INCORRECT REQUEST"));
} else {
    $basket->id = $_GET["id"];
    $found = $basket->readOne();
    if ($found != null) {
        $result = array(
            "id" => $found[0],
            "naming" => $found[1],
            "price" => $found[2],
            "amount" => $found[3],
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "BASKET NOT FOUND"));
    }
}