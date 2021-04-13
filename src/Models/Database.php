<?php
namespace App\Models;

use PDO;

class Database
{
    public $conn;
    protected $dbType;
    protected $sql;
    protected $result;
    protected $row;

    public function __construct(
        $dbType = 'mysql',
        $dbHost = 'localhost',
        $dbUser = 'root',
        $dbPass = '',
        $dbName = ''
    ) {
        try {
            $this->conn = new PDO("$dbType:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function setSQL($sql)
    {
        $this->sql = $sql;
    }

    public function query()
    {
        $this->result = $this->conn->query($this->sql);
    }

    public function querySQL($sql)
    {
        $this->sql = $sql;
        $this->query();
    }

    public function fetch_array()
    {
        $myArray = array();
        if ($this->result) {
            while ($row = $this->result->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public function fetch_array_sql($sql)
    {
        $this->querySQL($sql);
        $myArray = $this->fetch_array();
        return $myArray;
    }

    public function db_close()
    {
        mysqli_close($this->conn);
    }

    public function countNumRows()
    {
        $this->query();
        return $this->result->rowCount();
    }

    public function CountNumRowsSQL($sql)
    {
        $this->querySQL($sql);
        $num_rows = $this->result->rowCount();
        return $num_rows;
    }
}
