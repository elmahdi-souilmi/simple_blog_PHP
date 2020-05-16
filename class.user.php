<?php


class user
{
    private $id;
    private $first_name;
    private $last_name;
    private $login;
    private $password;
    // constracture
    public function __construct( $first_name, $last_name, $login, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->login = $login;
        $this->password = $password;

    }
    // getters 
    public function getID()
    {
        echo $this->id;
    }
    public function getFIRSTNAME()
    {
        echo $this->first_name;
    }
    public function getLASTNAME()
    {
        echo $this->last_name;
    }
    public function getLOGIN()
    {
        echo $this->login;
    }
    public function getPASSWORD()
    {
        echo $this->password;
    }
    // setters
    public function setLOGIN($login)
    {
        $this->login = $login;
    }
    public function setFIRSTNAME($firstname)
    {
        $this->first_name = $firstname;
    }
    public function setLASTNAME($lastname)
    {
        $this->last_name= $lastname;
    }
    public function setPASSWORD($password)
    {
        $this->password = $password;
    }

    // methodes
    public function register()
    {    // connect to datebase
        include 'config/db_connect.php';
        // create sql
        $sql = " INSERT INTO user(first_name, last_name, login, password) VALUES( '$this->first_name', '$this->last_name', '$this->login', '$this->password' ) ";
        // save to database and check
        if (mysqli_query($connect, $sql)) {

        } else {
            echo 'query error : ' . mysqli_error($connect);
        }
    
    }
    public function login()
    {
        //code
        echo 'login succed  email is : ' . $this->email;
    }
    public function add_post()
    {
        // code
        echo 'add fonction';
    }
    public function update_post()
    {
        // code
        echo 'update fonction';
    }
    public function delete_post()
    {
        // code
        echo 'delete fonction';
    }
}
