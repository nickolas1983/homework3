<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class UsersModel extends BaseModel {

    protected $table = 'users';

    public function getByLogin($login)
    {
        $result = $this->db->query("select * from users where login = '{$login}'");
        if($result){
            return $result[0];
        }

        return array();

    }

    public function regUser($login, $password, $email){
        
    }
} 