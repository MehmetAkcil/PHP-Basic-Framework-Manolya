<?php

namespace Models;

use Config\Database;

class UserModel extends Database
{
    public String $tableName = 'db_user';
    public String $primaryId = 'user_id';
    public function find()
    {
        $data = $this->getRow("SELECT * FROM {$this->tableName}");
        return $data;
    }
}