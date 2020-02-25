<?php

class User extends DB
{
    protected static $table_name = 'users';
    protected static $db_fields = array('username', "password", "email", "group_id", "img", "token", "created_at", "updated_at");
    public $id;
    public $username;
    public $password;
    public $email;
    public $group_id;
    public $img;
    public $token;
    public $created_at;
    public $updated_at;

    private $_data,
            $_session_name,
            $_is_loggedIn = false;

    public function __construct($user = null)
    {
        parent::__construct();
        $this->_session_name = Config::get('session/session_name');
    }

    public function findUser($param = null){
            if(!$param){
                if(Session::exist($this->_session_name)){
                    $param = Session::get($this->_session_name);
                }
            }
            if(!$param){
                return false;
            }
            $field = (is_numeric($param)) ? "id" : "email";

            if(!$query = $this->_db->getConnection()->prepare("SELECT * FROM ".static::$table_name."  WHERE ".$field."=?")){
                return false;
            }
            $query->bindValue(1,$param);

            if(!$query->execute()){
                return false;
            }
            $result_set = $query->fetchAll(PDO::FETCH_ASSOC);

            $user = !empty($result_set) ? array_shift($result_set) : false;
            if(!$user){
                return false;
            }

            foreach($user as $key => $value){
                if($this->check_attr($key)){
                    $this->$key = $value;
                }
            }
            if($this->id == $param){
                $this->_is_loggedIn = true;
            }

        return $this;
    }
    public function login($password = null, $email = null){


        $user = $this->findUser($email);

        if($user){
            Session::put($this->_session_name, $this->id);
            return true;
        }else{
            return false;
        }
    }
    public function data(){
        return $this->_data;
    }
    public function register(){
        $this->password = Hash::generate($this->password);
        $this->group_id = 1;
        if($this->insert()){
            return true;
        }
        return false;

    }
    public function update(){
        if($this->put()){
            return true;
        }
        return false;

    }
    public function delete(){

        if($this->destroy()){
            return true;
        }
        return false;

    }
    public function isLoggedIn(){
        return $this->_is_loggedIn;

    }

    public function logout(){
        if(Session::exist($this->_session_name)){
            Session::delete($this->_session_name);
        }
        $this->_is_loggedIn = false;
    }
    public function hasPermission($key){
        if($this->isLoggedIn()){

            $group = new Group();
            $group = $group->find($this->id);
            $permissions = json_decode($group->permissions, true);

            if($permissions[$key]){
                return true;
            }

            }
        return false;
        }



}