<?php

class Core {
    public $conn;
    public $query;
    public $table;

    public function __construct($settings)
    {
        $sql = $settings;
        $this->conn = new mysqli($sql['Hostname'], $sql['Username'], $sql['Password'], $sql['Database']);
    }
}