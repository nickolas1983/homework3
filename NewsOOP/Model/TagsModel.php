<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class TagsModel extends BaseModel {

    protected $table = 'tags';

    public function getAllTags()
    {
        $result = $this->db->query('select * from ' . $this->table .'  group by tag');
        return $result;
    }

} 