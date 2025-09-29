<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../controllers/TasksController.php';
require_once __DIR__ . '/../core/Response.php';

$request = new Request();
$path = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $path);

$controller = new TasksController();

$pos = array_search('tasks', $segments);
if ($pos !== false) {
    $id = $segments[$pos + 1] ?? null;
    $action = $segments[$pos + 2] ?? null;

    if ($request->method === 'GET' && !$id) {
        $controller->index();
    } elseif ($request->method === 'POST' && !$id) {
        $controller->store($request->body);
    } elseif ($request->method === 'GET' && is_numeric($id)) {
        $controller->show((int)$id);
    } elseif ($request->method === 'PUT' && is_numeric($id)) {
        $controller->update((int)$id, $request->body);
    } elseif ($request->method === 'DELETE' && is_numeric($id)) {
        $controller->destroy((int)$id);
    } elseif ($request->method === 'PATCH' && is_numeric($id) && $action === 'toggle') {
        $controller->toggle((int)$id);
    } else {
        Response::error("Route not found", 404);
    }
} else {
    Response::json(["message" => "Tasks API running"]);
}