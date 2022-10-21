<?php

include_once "../database_connection.php";
include_once "material_db.php";

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$material = new Material($db);

$query_result = $material->read();

$result = array("materials" => array());
foreach ($query_result as $material) {
    $material_obj = array(
        "id" => $material["id"],
        "naming" => $material["naming"],
        "price" => $material["price"],
    );
    $result["materials"][] = $material_obj;
}

http_response_code(200);
echo json_encode($result);