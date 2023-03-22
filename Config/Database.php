<?php
namespace Config;

use PDO;
use PDOException;

class Database
{

    public String $database = 'default';

    private $conn;

    public function connect(): void
    {

        if(! isset($this->database)){
            $this->database = 'default';
        }

        $databases = Config::$databases;

        $dsn = 'mysql:host=' . $databases[$this->database]['host'] . ';dbname=' . $databases[$this->database]['database'];

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conn = new PDO($dsn, $databases[$this->database]['username'], $databases[$this->database]['password'], $options);
        } catch (PDOException $e) {
            throw $e;
        }

    }

    public function query($sql, $params = [])
    {
        if (!$this->conn) {
            $this->connect();
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getRow($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRows($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data): false|string
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $this->query($sql, array_values($data));

        return $this->conn->lastInsertId();
    }

    public function update($table, $data, $where): false|string
    {
        $columns = array_keys($data);
        $set = implode('=?,', $columns) . '=?';

        $sql = "UPDATE $table SET $set WHERE $where";

        $params = array_merge(array_values($data), array_values($where));
        $this->query($sql, $params);

        return $this->conn->lastInsertId();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $this->query($sql, $where);
    }
}