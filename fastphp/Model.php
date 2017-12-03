<?php

class Model extends Sql
{
    protected $_model;
    protected $_table;
    public static $dbConfig = [];
    public static $_params = [];

    public function __construct()
    {
        // Link to DB
        $this->connect(self::$dbConfig['host'], self::$dbConfig['username'], self::$dbConfig['password'],
            self::$dbConfig['dbname']);

        // Get table name
        if (!$this->_table) {
            // Get Model Name
            $this->_model = get_class($this);
            // Delete Model in name
            $this->_model = substr($this->_model, 0, -5);

            $this->_table = strtolower($this->_model);
        }
    }
}