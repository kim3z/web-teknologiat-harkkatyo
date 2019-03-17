<?php

class DB {

    private $db_host = '';
    private $db_user = '';
    private $db_password = '';
    private $db_name = '';
    public $conn = null;

    public function newConnection(){
 
        $this->conn = null;
 
        try {
            $this->conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_password);
            $this->conn->exec('set names utf8');
        } catch(PDOException $e) {
            echo 'Tietokantaan ei saat yhteytta. Error: ' . $e->getMessage();
        }
 
        return $this->conn;
    }
}
?>