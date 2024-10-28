<?php

namespace App\Database;

class MyMysqliConnection
{
    protected $connection;

    public function __construct($host, $username, $password, $database)
    {
        $this->connection = new \mysqli($host, $username, $password, $database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function escapeString($string)
    {
        return $this->connection->real_escape_string($string);
    }

    public function fetchAll($result)
    {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function close()
    {
        $this->connection->close();
    }
}
