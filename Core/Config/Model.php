<?php

namespace Core\Config;

class Model extends Database
{

    public function findAll()
    {
        return $this->getRow("SELECT * FROM {$this->tableName}");
    }

    public function find(Int $ID)
    {
        return $this->getRow("SELECT * FROM {$this->tableName} WHERE {$this->primaryId} = ?", [
            $ID
        ]);
    }

    public function findWhere($where)
    {
        return $this->getRow("SELECT * FROM {$this->tableName} WHERE {$where}");
    }

    public function insert(Array $data): false|string
    {
        return $this->insertTable($this->tableName, $data);
    }

    public function update(Array $data, Int $id): false|string
    {
        return $this->updateTable($this->tableName, $data, $this->primaryId . ' = ' . $id);
    }

    public function updateWhere(Array $data, Int $where): false|string
    {
        return $this->updateTable($this->tableName, $data, $where);
    }

}