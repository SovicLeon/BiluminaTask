<?php

// import model and controller
require_once "models/ArticleModel.php";
require_once "controllers/ArticleController.php";

$articleController = new ArticleController;

// set header
header('Content-Type: application/json');
// grant access to all origins
header("Access-Control-Allow-Origin: *");

// set method
$method = $_SERVER['REQUEST_METHOD'];

// based on method call controller or error response
switch ($method) {
    case "GET":
        $sort = $_GET['sortPrice'] ?? null;
        $articleController->index($sort);
        break;
    default:
        http_response_code(405);
        echo json_encode((object)[
            "status" => "405",
            "message" => "Method not allowed"
        ]);
        break;
}
