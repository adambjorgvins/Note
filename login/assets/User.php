<?php

/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 12/11/2016
 * Time: 19:55
 */
class User
{
    private $conn;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    /**
     * @param $sql
     * @return PDOStatement
     */
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    /**
     * @param $fromuser
     * @param $touser
     * @return PDOStatement
     */
    public function addfriend($fromuser,$touser)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO friends(fromuser, touser)
		                                               VALUES(:fromuser, :touser)");
            $stmt->bindParam(":fromuser", $fromuser);
            $stmt->bindParam(":touser", $touser);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
// SELECT id, fromuser, touser FROM friends WHERE fromuser=:uname AND friends=1
    /**
     * @param $userid
     * @return PDOStatement
     */
    public function renderFriends($userid)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, fromuser, touser FROM friends WHERE fromuser=:uname AND friends=1");
            $stmt->bindParam(":uname", $userid);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            echo "Error with query!";
        }
    }

}