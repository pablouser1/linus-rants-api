<?php
class DB {
    private $conn;
    function __construct() {
        $this->conn = new SQLite3("data/rants.db");
    }

    public function query(string $query) {
        $result = $this->conn->query($query);
        return $result;
    }

    public function statement(string $query, int $id, mixed $value) {
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam($id, $value);
        $result = $stmt->execute();
        return $result;
    }
}