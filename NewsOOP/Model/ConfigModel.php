<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class ConfigModel extends BaseModel
{

    protected $table = 'config';

    public function updateConfig($property, $value){

        $query = " update config
                    set `value` = '".$value."'
                    where `property` = '".$property."';
        ";
        return $this->db->execute($query);
    }
}