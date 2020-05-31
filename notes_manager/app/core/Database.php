<?php
class Database {
    
    private $db;
    private $dbname = DB_NAME;
    private $hostname = DB_HOSTNAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    
    public function __destruct() {
        $this->db = null;
    }
    
    public function connect() {
        try {
        $this->db = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error occured - " . $e->getMessage();
        }
        return $this->db;
    }
}