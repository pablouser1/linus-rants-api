<?php
namespace App;

class Db {
    private \SQLite3 $conn;

    function __construct() {
        $this->conn = new \SQLite3(__DIR__ . '/../data/rants.db', SQLITE3_OPEN_READONLY);
    }

    function __destruct() {
        $this->conn->close();
    }

    public function all(string $sort = ''): array {
        $sql = 'SELECT * FROM rants';

        if ($sort && in_array($sort, ['timestamp', 'hate'])) {
            $sql .= " ORDER BY $sort DESC";
        }

        $rants = [];
        $result = $this->conn->query($sql);
        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $row["type"] = Helpers::rantType($row["type"]);
                array_push($rants, $row);
            }
        }
        return $rants;
    }

    public function random(): ?array {
        $rant = $this->conn->query("SELECT * FROM rants ORDER BY RANDOM() LIMIT 1")->fetchArray(SQLITE3_ASSOC);
        if ($rant) {
            $rant["type"] = Helpers::rantType($rant["type"]);
        }
        return $rant !== false ? $rant : null;
    }

    public function one(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM rants WHERE id=:id");
        $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result !== false ? $result->fetchArray(SQLITE3_ASSOC) : null;
    }
}
