<?php

/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:08
 */
class Auth
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
     * @param $uname
     * @param $upass
     * @return PDOStatement
     */
    public function register($uname,$upass,$uemail,$uphone)
    {
        try
        {
            $new_password = password_hash($upass, PASSWORD_DEFAULT); // hash password
            $id = time(); // make uniq id for new user
            $stmt = $this->conn->prepare("INSERT INTO users(id, username, password, email, phone)
		                                               VALUES(:id, :uname, :upass, :uemail, :uphone)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":uname", $uname);
            $stmt->bindParam(":upass", $new_password);
            $stmt->bindParam(":uemail", $uemail);
            $stmt->bindParam(":uphone", $uphone);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * @param $uname
     * @param $upass
     * @return bool
     */
    public function doLogin($uname,$upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT id, username, password FROM users WHERE username=:uname");
            $stmt->execute(array(':uname'=>$uname));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() == 1)
            {
                if(password_verify($upass, $userRow['password']))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    /**
     * @return bool
     */
    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

}