<?php
class Response {
    // Send a JSON response
    public static function json($data, int $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Send an error message as JSON
    public static function error(string $message, int $status = 400) {
        self::json(['error' => $message], $status);
    }
}