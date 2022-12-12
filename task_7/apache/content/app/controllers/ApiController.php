<?php
require_once "app/models/BasketsModel.php";
require_once "app/models/Database.php";

class ApiController extends Controller {
    private Database $db;
    private BasketsModel $basketsModel;

    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
        $this->basketsModel = new BasketsModel($this->db->getConnection());
    }

    public function basket() {
        header("Content-Type: application/json; charset=UTF-8");
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "GET":
                if (isset($_GET["id"])) {
                    $this->getOne();
                    break;
                }
                $this->getAll();
                break;
            case "POST":
                $this->create();
                break;
            case "PUT":
                $this->update();
                break;
            case "DELETE":
                $this->delete();
                break;
        }
    }

    private function getOne() {
        $id = $_GET["id"];
        $found = $this->basketsModel->readOne($id);
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

    private function getAll() {
        $query_result = $this->basketsModel->read();

        $result = array("results" => array());
        foreach ($query_result as $basket) {
            $basket_obj = array(
                "id" => $basket["id"],
                "naming" => $basket["naming"],
                "price" => $basket["price"],
                "amount" => $basket["amount"]
            );
            $result["results"][] = $basket_obj;
        }

        http_response_code(200);
        echo json_encode($result);
    }

    private function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->naming) &&
            !empty($data->price) &&
            !empty($data->amount)
        ) {
            $basket = array();
            $basket["naming"] = $data->name;
            $basket["price"] = $data->price;
            $basket["amount"] = $data->amount;

            $stmt = $this->basketsModel->create($basket);

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
    }

    private function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->id) &&
            !empty($data->naming) &&
            !empty($data->price) &&
            !empty($data->amount)
        ) {
            $basket = array();
            $basket["id"] = $data->id;
            $basket["naming"] = $data->naming;
            $basket["price"] = $data->price;
            $basket["amount"] = $data->amount;

            $stmt = $this->basketsModel->update($basket);

            if ($stmt) {
                http_response_code(200);
                echo json_encode(array("message" => "SUCCESSFUL UPDATE"), JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "CAN'T PROCESS THIS REQUEST"), JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "INCOMPLETE DATA"), JSON_UNESCAPED_UNICODE);
        }
    }

    private function delete() {
        if (!isset($_GET["id"])) {
            http_response_code(400);
            echo json_encode(array("message" => "INCORRECT REQUEST"));
        } else {
            $id = $_GET["id"];
            $found = $this->basketsModel->readOne($id);
            if ($found != null) {
                $stmt = $this->basketsModel->delete($id);
                if ($stmt) {
                    http_response_code(200);
                    echo json_encode(array("message" => "SUCCESFUL DELETE"));
                } else {
                    http_response_code(503);
                    echo json_encode(array("message" => "UNKNOWN ERROR"), JSON_UNESCAPED_UNICODE);
                }
            }
             else {
                http_response_code(404);
                echo json_encode(array("message" => "BASKET NOT FOUND"));
            }
        }
    }
}
