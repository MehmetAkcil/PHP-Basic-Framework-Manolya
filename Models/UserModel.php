<?php

namespace Models;

use Config\Model;

class UserModel extends Model
{

    public String $database = 'gorevyap';

    public String $tableName = 'db_users';
    public String $primaryId = 'user_id';

}