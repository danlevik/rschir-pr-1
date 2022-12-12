<?php

require_once "app/models/Database.php";

class BasketsController extends Controller
{
    private Database $db;

    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
        $this->model = new BasketsModel($this->db->getConnection());
    }

    function index()
    {
        $data = $this->model->read();
        $this->view->generate('BasketsView.php', $data);
    }
}