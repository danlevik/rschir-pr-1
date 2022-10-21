<?php

include_once "../database_connection.php";
include_once "material_db.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();

$material = new Material($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->id) &&
    !empty($data->naming) &&
    !empty($data->price)
) {
    $material->id = $data->id;
    $material->naming = $data->naming;
    $material->price = $data->price;

    $stmt = $material->update();

    if ($stmt) {
        http_response_code(201);
        echo json_encode(array("message" => "SUCCESS"), JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "CAN'T PROCESS THIS REQUEST"), JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "INCOMPLETE DATA"), JSON_UNESCAPED_UNICODE);
}