<?php

namespace Core\Models;

use Core\Config\Model;
class UserModel extends Model
{

    public String $database = 'default';

    public String $tableName = 'db_user';
    public String $primaryId = 'user_id';

    public function login($email, $password): object|false
    {
        $userData = $this->findWhere('user_email', $email);

        if(! $userData){
            return false;
        }
        if(! password_verify($password, $userData->user_password)){
            return false;
        }

        return $userData;
    }

}