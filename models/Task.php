<?php
require_once __DIR__ . '/../config/db.php';

class Task {
    private PDO $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->pdo();
    }

    // Get all tasks
    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Find a task by ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Create a new task
    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO tasks (title, description, status, priority, due_date)
            VALUES (:title, :description, :status, :priority, :due_date)
        ");
        $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'] ?? 'pending',
            ':priority' => $data['priority'] ?? 'medium',
            ':due_date' => $data['due_date'] ?? null,
        ]);
        return $this->pdo->lastInsertId();
    }

    // Update a task
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE tasks SET 
                title = :title, 
                description = :description, 
                status = :status, 
                priority = :priority, 
                due_date = :due_date
            WHERE id = :id
        ");
        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'] ?? 'pending',
            ':priority' => $data['priority'] ?? 'medium',
            ':due_date' => $data['due_date'] ?? null,
            ':id' => $id,
        ]);
    }

    // Delete a task
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Toggle task status (pending <-> completed)
    public function toggle($id) {
        $task = $this->find($id);
        if (!$task) return false;

        $newStatus = $task['status'] === 'completed' ? 'pending' : 'completed';
        $stmt = $this->pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $id]);

        return $this->find($id);
    }
}