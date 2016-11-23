<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:09
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Database
{
    private $host = "localhost";  // Db connection host (tsuts.tskoli.is) on tskola server
    private $db_name = "calendar"; // Db name
    private $username = "test"; // Username for db login (KENNITALA)
    private $password = "test"; // Your dp password (DEFAULT: mypassword)
    public $conn;

    public function dbConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}