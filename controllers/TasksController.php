<?php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../core/Response.php';

class TasksController {
    private $task;

    public function __construct() {
        $this->task = new Task();
    }

    // GET /tasks
    public function index() {
        Response::json($this->task->all());
    }

    // GET /tasks/{id}
    public function show($id) {
        $task = $this->task->find($id);
        if (!$task) {
            Response::error("Task not found", 404);
        }
        Response::json($task);
    }

    // POST /tasks
    public function store($data) {
        if (empty($data['title'])) {
            Response::error("Title is required", 422);
        }
        $id = $this->task->create($data);
        Response::json($this->task->find($id), 201);
    }

    // PUT /tasks/{id}
    public function update($id, $data) {
        if (!$this->task->find($id)) {
            Response::error("Task not found", 404);
        }
        $this->task->update($id, $data);
        Response::json($this->task->find($id));
    }

    // DELETE /tasks/{id}
    public function destroy($id) {
        if (!$this->task->find($id)) {
            Response::error("Task not found", 404);
        }
        $this->task->delete($id);
        Response::json(["message" => "Task deleted"]);
    }

    // PATCH /tasks/{id}/toggle
    public function toggle($id) {
        $result = $this->task->toggle($id);
        if (!$result) {
            Response::error("Task not found", 404);
        }
        Response::json($result);
    }
}