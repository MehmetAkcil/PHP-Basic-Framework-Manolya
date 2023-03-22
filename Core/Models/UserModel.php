<?php

namespace Core\Models;

use Core\Config\Model;

class UserModel extends Model
{

    public String $database = 'default';

    public String $tableName = 'db_user';
    public String $primaryId = 'user_id';

}