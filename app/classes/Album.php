<?php

class Album extends DB
{
    protected static $table_name = 'albums';
    private $_data,
        $_session_name,
        $_is_loggedIn = false;

    public function __construct($user = null)
    {
        parent::__construct();
    }



}