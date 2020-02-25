<?php

class Album extends DB
{
    protected static $table_name = 'albums';
    protected static $db_fields = array('title', "artist", "genre", "art_work_path", "created_at", "updated_at");
    public $id;
    public $title;
    public $artist;
    public $genre;
    public $art_work_path;

    public $created_at;
    public $updated_at;


    public function __construct()
    {
        parent::__construct();
    }



}