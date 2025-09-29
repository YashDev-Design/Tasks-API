<?php
class Request {
    public string $method;
    public array $query;
    public $body;

    public function __construct() {
        // GET, POST, PUT, DELETE, PATCH
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->query = $_GET ?? [];
        $this->body = $this->parseBody();
    }

    private function parseBody() {
        if (in_array($this->method, ['POST','PUT','PATCH'])) {
            $raw = file_get_contents('php://input');
            $data = json_decode($raw, true);
            return is_array($data) ? $data : [];
        }
        return null;
    }
}