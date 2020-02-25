<?php

class Group extends DB
{
    protected static $table_name = 'groups';
    protected static $db_fields = array('name', "permissions", "created_at", "updated_at");
    public $id;
    public $name;
    public $permissions;
    public $created_at;
    public $updated_at;


    public function __construct()
    {
        parent::__construct();
    }



}