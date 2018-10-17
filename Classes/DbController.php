<?php

class DbController
{

    //Database credentials
    protected $username = "hrnatural";
    protected $password = "testtest";
    protected $host = "127.0.0.1";
    protected $dbName = "hr";
    public $loginOK = "/Views/secure-area/loggedin.php";
    public $loginError;

    /*
     * Function: conn
     * returns: PDO Connection
     */
    private function conn()
    {

        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
        $conn = new PDO($dsn, $this->username, $this->password);
        return $conn;

    }

    /*
     * Function: getUser
     * Accepts: String, String
     * returns: PDO User Object
     */
    public function getUser($email, $password = null, $action = null)
    {

        $user = $this->conn()->prepare('SELECT password, fullname, email, file FROM users WHERE email = :email');
        $user->bindParam('email', $email); //Can also use $user->execute(array('username' => $username))
        $user->execute();
        $user = $user->fetchObject();

        if(!empty($user)) {
            if($action === "check") {
                return true;
            } else {
                $password = hash('sha256', $password . $user->email);

                if ($user->password === $password)
                    return $user;
                else
                    return null;

            }
        } else {

            return null;

        }


    }

    /*
     * Function: setUser
     * Accepts: String, String, String, String
     * returns: Boolean
     */
    public function setUser($email, $password, $fullname, $file)
    {

        if(!empty($email) && !$this->getUser($email, null, $action = "check")) {

            $password = hash('sha256', $password . $email);
            $user = $this->conn()->prepare('INSERT INTO users SET email = :email, password = :password, fullname = :fullname,  file = :file');
            $user->bindParam('password', $password);
            $user->bindParam('email', $email);
            $user->bindParam('fullname', $fullname);
            $user->bindParam('file', $file['file']);

            if ($user->execute())
                return true;
            else
                return false;

        } else
            return false;

    }

}