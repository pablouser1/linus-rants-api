<?php
require 'db.php';

class Rants {
    private $db;
    function __construct() {
        $this->db = new DB;
    }

    public function all() {
        $rants = [];
        $result = $this->db->query("SELECT * FROM rants");
        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $row["type"] = Helpers::rantType($row["type"]);
                array_push($rants, $row);
            }
        }
        return $rants;
    }

    public function random() {
        $rant = $this->db->query("SELECT * FROM rants ORDER BY RANDOM() LIMIT 1")->fetchArray(SQLITE3_ASSOC);
        if ($rant) {
            $rant["type"] = Helpers::rantType($rant["type"]);
        }
        return $rant;
    }

    public function one(int $id) {
        $rant = $this->db->statement("SELECT * FROM rants WHERE id=?", 1, $id);
        if ($rant) {
            return $rant->fetchArray(SQLITE3_ASSOC);
        }
        return false;
    }

    public function sort($mode) {
        $result = false;
        $rants = [];

        $result = $this->db->query("SELECT * FROM rants ORDER BY $mode DESC");

        if ($result) {
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $row["type"] = Helpers::rantType($row["type"]);
                array_push($rants, $row);
            }
        }

        return $rants;
    }
}
