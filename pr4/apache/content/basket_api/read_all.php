<?php

include_once "../database_connection.php";
include_once "basket_db.php";

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$basket = new Basket($db);

$query_result = $basket->read();

$result = array("baskets" => array());
foreach ($query_result as $basket) {
    $basket_obj = array(
        "id" => $basket["id"],
        "naming" => $basket["naming"],
        "price" => $basket["price"],
        "amount" => $basket["amount"]
    );
    $result["baskets"][] = $basket_obj;
}

http_response_code(200);
echo json_encode($result);