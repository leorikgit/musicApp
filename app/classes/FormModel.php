<?php


abstract  class FormModel
{
    protected $_errors = [];
    protected $_passed = false;

    abstract protected function load($data);
    abstract public function validate();

    public function setError($key, $value){
        $this->_errors[$key] = $value;
    }
    public function getError($key){
        return (isset($this->_errors[$key])? $this->_errors[$key] : '');
    }
    public function  getAllError(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}