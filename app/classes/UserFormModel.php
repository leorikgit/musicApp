<?php


class UserFormModel extends FormModel
{
    private static $_DB_name = 'users';
    private $_data,
            $_Conn;

    public function __construct()
    {
        $this->_Conn = Connection::get();

    }
    public  function getAttribute($key){
        return (isset($this->_data[$key])? $this->_data[$key] : null);
    }
    public function load($data){
        $this->_data = $data;
    }
    public function login(){
        $email = $this->getAttribute('email');
        if(!Validation::required($email)){
            $this->setError('email', 'Email is required.');
        }
        $password = $this->getAttribute('password');

        if(!Validation::required($password)){
            $this->setError('password', 'Password is required.');
        }
        $this->validate();
        return $this;
    }

    public function register(){
        $username = $this->getAttribute('username');
        if(!Validation::required($username)){
            $this->setError('username', 'Username is required.');
        }

        if(!Validation::max($username, 12) || !Validation::min($username, 6)){
            $this->setError('username', 'Username must be max 12 and lower then 6 chars.');
        }
        $email = $this->getAttribute('email');

        if(!Validation::required($email)){
            $this->setError('email', 'Email is required.');
        }
        if(!Validation::email($email)){
            $this->setError('email', 'Invalid email format.');
        }
        $query = $this->_Conn->getConnection()->prepare("SELECT * FROM ".static::$_DB_name."  WHERE email=?");
        $query->bindValue(1,$email);
        $query->execute();
        if($query->rowCount()){
            $this->setError('email', 'Email already exist..');
        }

        $password = $this->getAttribute('password');

        if(!Validation::required($password)){
            $this->setError('password', 'Password is required.');
        }
        $password = $this->getAttribute('password');

        $password_again = $this->getAttribute('password_again');
        if(!Validation::required($password)){
            $this->setError('password', 'Password is required.');
        }
        if(!Validation::match($password, $password_again)){
            $this->setError('password', 'Password must be unique.');
        }
        $this->validate();
        return $this;

    }
    public function validate()
    {
        if(count($this->getAllError()) === 0 ){
            $this->_passed = true;
        }

        return $this->_passed;
    }

}