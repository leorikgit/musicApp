<?php


class DB
{
    protected  $_db;
    private
            $_error = false,
            $_count = 0,
            $_query,
            $_result;

    public function __construct()
    {
        $this->_db = Connection::get();
    }


    public function find($id){
        $result_set  = $this->query("SELECT * FROM ".static::$table_name." WHERE id=? ",array($id));

        return !empty($result_set) ? array_shift($result_set) : false;
    }
    public function findAll(){
        return $this->query("SELECT * FROM ".static::$table_name." ",array());
    }
    public  function query($sql, $params = array()){
        $this->_error = false;
        $obj_array = [];
        if($this->_query = $this->_db->getConnection()->prepare($sql)){
            if(count($params)){
                $counter = 1;
                foreach ($params as $param){
                    $this->_query->bindValue($counter, $param);
                    $counter++;
                }
            }
            if(!$this->_query->execute()){
                $this->_error = true;
                return $obj_array;
            }
            $queryFunction = explode(" ",$sql);
            if($queryFunction[0] == "SELECT"){

                $this->_result= $this->_query->fetchAll(PDO::FETCH_ASSOC);

                foreach($this->_result as $result){
                    $obj_array[] = self::instantiation($result);
                }
            }
            $this->_count = $this->_query->rowCount();
        }
        return $obj_array;
    }

    protected static function instantiation($row){
        $callingClass = get_called_class();
        $new_obj = new $callingClass;
        foreach($row as $key => $value){
            if($new_obj->check_attr($key)){
                $new_obj->$key = $value;
            }
        }
        return $new_obj;
    }
    protected function check_attr($attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);

    }
    public function insert(){
       $properties = $this->get_table_properties();

       $keys = implode(',',array_keys($properties));
       $counter = 1;
       $values = "";
       foreach ($properties as $property){
           $values .='?';
           if($counter < count($properties)){
               $values .= ',';
               $counter++;
           }
       }
       $sql = "INSERT INTO ".static::$table_name." (".$keys.") VALUES ({$values})";
        $this->query($sql, $properties);
       if(!$this->getError() && $this->count() > 0){
           return true;
       }
       return false;
    }

    public function put(){
        $properties = $this->get_table_properties();

            $keys = implode(',',array_keys($properties));
            $counter = 1;
            $set = "";
            foreach ($properties as $name => $value){
                $set .="{$name}=?";
                if($counter < count($properties)){
                    $set .= ',';
                    $counter++;
                }
            }
            $sql = "UPDATE ".static::$table_name." SET ".$set." WHERE id=".$this->id." ";
            $this->query($sql, $properties);
            if(!$this->getError() || $this->count() > 0){
                return true;
            }

        return false;
    }
    public function destroy(){

        $sql = "DELETE FROM  ".static::$table_name." WHERE id=".$this->id." ";
        $this->query($sql);
            if(!$this->getError() || $this->count() > 0){
                return true;
            }

        return false;
    }

    public function getError(){
        return $this->_error;
//        return $this->_query->errorInfo();
    }
    public function getResult(){
        return $this->_result;
    }
    public function first(){
        return $this->getResult()[0];
    }
    public function count(){
        return $this->_count;
    }
    protected function get_table_properties(){
        $properties = [];
        foreach(static::$db_fields as $field){
            if(property_exists($this, $field) && !empty($this->$field)){

                $properties[$field] = $this->$field;

            }
        }
        return $properties;
    }

}