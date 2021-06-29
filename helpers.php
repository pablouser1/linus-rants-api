<?php
class Helpers {
    static private function rantType($letterType) {
        $type = null;
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
    
    static public function showOne($data) {
        $rant = $data["rant"];
        $id = $data["id"];
        $response = [
            "id" => $id,
            "hate" => $rant[0],
            "url" => $rant[1],
            "type" => self::rantType($rant[2]),
            "date" => $rant[3],
            "timestamp" => $rant[4],
            "message" => $rant[5]
        ];

        // Send response as json
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    static public function showAll($rants) {
        header('Content-Type: application/json');
        echo json_encode($rants);
    }

    static public function showError(string $message, int $code) {
        $response = [
            "code" => $code,
            "message" => $message
        ];
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
