<?php

include_once "../database_connection.php";
include_once "basket_db.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();

$basket = new Basket($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "INCORRECT REQUEST"));
} else {
    $basket->id = $_GET["id"];
    $stmt = $basket->delete();
    if ($stmt) {
        http_response_code(200);
        echo json_encode(array("message" => "SUCCESS"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "BASKET NOT FOUND"));
    }
}