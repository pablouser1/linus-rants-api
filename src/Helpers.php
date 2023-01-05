<?php
namespace App;

class Helpers {
    static public function rantType(string $letterType): string {
        $type = '';
        switch ($letterType) {
            case "C":
                $type = "Code";
                break;
            case "P":
                $type = "Personal";
                break;
            case "B":
                $type = "Both";
                break;
            case "U":
                $type = "Unsure";
                break;
        }
        return $type;
    }

    static public function showError(string $message, int $code) {
        $response = [
            "code" => $code,
            "message" => $message
        ];
        http_response_code($code);
        self::sendResponse($response);
    }

    static public function sendResponse(array $response) {
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
