<?php
class Rants {
    private $csv;
    function __construct() {
        // Get rants from cache or file
        if (apcu_exists('rants')) {
            $this->csv = apcu_fetch('rants');
        } else {
            $this->csv = array_map(function ($v) {
                return str_getcsv($v, "\t");
            }, file('rants.tsv'));

            // Add variable to cache
            apcu_add('rants', $this->csv);
        }
    }

    public function all() {
        return $this->csv;
    }

    public function random() {
        $num = array_rand($this->csv);
        return [
            "id" => $num,
            "rant" => $this->csv[$num]
        ];
    }

    public function one(int $id) {
        if (array_key_exists($id, $this->csv)) {
            return [
                "id" => $id,
                "rant" => $this->csv[$id]
            ];
        }
        return false;
    }
}
