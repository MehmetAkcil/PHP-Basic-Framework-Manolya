<?php

namespace Config;

class Model extends Database
{

    public function findAll()
    {
        $data = $this->getRow("SELECT * FROM {$this->tableName}");
        return $data;
    }
    public function find($ID)
    {
        $data = $this->getRow("SELECT * FROM {$this->tableName} WHERE {$this->primaryId} = ?", [
            $ID
        ]);
        return $data;
    }
}