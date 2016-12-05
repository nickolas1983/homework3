<?php

namespace Common;


class DB {

    protected $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection->query("SET NAMES 'utf8'");
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        //var_dump($sql);
        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function execute($sql)
    {
        $result = $this->connection->query($sql);
        return $result;
    }

    public function escape($value)
    {
        return mysqli_escape_string($this->connection, $value);
    }

} 