<?php

require_once 'app_controller.php';
require_once __DIR__.'/../models/item.php';
require_once __DIR__.'/../repository/items_repository.php';
class ItemsController extends AppController {
    private $items_repository;

    public function __construct() {
        $this->items_repository = new ItemsRepository();
    }

    public function items() {
        session_start();
        if (!isset($_SESSION["logged_in"])) {
            return $this->redirect_to("login");
        }
        if (!isset($_SESSION["name"]) || $_SESSION["name"] == "admin") {
            return $this->redirect_to("logout");
        }
        $items = $this->items_repository->get_items("", "", 1, 10);
        $this->render('items', ['items' => $items]);
    }

    public function get_items() {
        $content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($content_type === "application/json") {
            $d = $this->http_predispose_and_get_input();
            echo json_encode($this->items_repository->get_items($d["name"], $d["category"], $d["start"], $d["interval"]));
        }
        else echo json_encode($this->items_repository->get_items("", "", 1, 10));
    }
    public function get_items_count() {
        $content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($content_type === "application/json") {
            $d = $this->http_predispose_and_get_input();
            echo json_encode($this->items_repository->get_items_count($d["name"], $d["category"]));
        }
        else echo json_encode($this->items_repository->get_items_count("", ""));
    }

    public function cart() {
        session_start();
        if (!isset($_SESSION) || !isset($_SESSION["logged_in"])) {
            return $this->redirect_to("login");
        }
        if (!isset($_SESSION["name"]) || $_SESSION["name"] == "admin") {
            return $this->redirect_to("logout");
        }
        $this->render("cart");
    }

    private function http_predispose_and_get_input() {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        header("Content-type: application/json");
        http_response_code(200);
        return $decoded;
    }
}