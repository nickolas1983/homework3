<?php

namespace Model;


use Common\DB;

class BaseModel
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = new DB();
    }

    
    
    public function getAll($sort = '')
    {
        if ($sort){
            $sort = 'order by '.$sort;
        }
        $result = $this->db->query('select * from ' . $this->table .' '. $sort);
        return $result;
    }

    public function get($id)
    {
        $id = intval($id);

        $result = $this->db->query('select * from ' . $this->table . ' where id= ' . $id );

        if(!$result) {
            return array();
        }

        return $result[0];
    }
    
    public function getLast($field, $order = ""){

        if (!$order){
            $order = " order by `$field` ";
        }
        else{
            $order = " ORDER BY `$field` DESC ";
        }
        
        $result = $this->db->query('select * from ' . $this->table . $order . 'limit 1' );

        if(!$result) {
            return array();
        }

        return $result[0];
    }

    public function getRandomElements($count, $order = false) {

        if (!$order){
            $order = ' order by rand()';
        }
        else{
            $order = " ORDER BY `$order` DESC";
        }

        $result = $this->db->query('select * from ' . $this->table . $order.' limit ' . $count );

        if(!$result) {
            return array();
        }

        return $result;
    }

    public function getByField($field, $fieldValue, $order = '', $count = '', $countFrom='', $up = false){
        if ($count){
            if ($countFrom){
                $count = ' limit '.$countFrom.', '.$count;
            } else {
                $count = ' limit '.$count;
            }
        }
        if (!$order) $order = " ORDER BY `id`";
        else {
            $order = " ORDER BY `$order` DESC";
            if ($up) $order = " ORDER BY `$order`";
        }

        $result = $this->db->query('select * from ' . $this->table . ' where '.$field.' in ' . $fieldValue . $order . $count);

        //var_dump('select * from ' . $this->table . ' where '.$field.' = ' . $fieldValue . $order . $count);

        if(!$result) {
            return array();
        }
 
        return $result;
    }
    
    public function countByFild($fild = '', $fildValue = ''){
        if ($fild && $fildValue) {
            $where = ' where '.$fild.' in ' . $fildValue;
        }
        else {
            $where = '';
        }
            
        $result = $this->db->query('select COUNT(*) from ' . $this->table . $where);
        return $result[0]["COUNT(*)"];
    }


    public function insert($new_values) {

        $table_name = $this->table;
        $query = "INSERT INTO $table_name (";
        //echo "<br>";
        foreach ($new_values as $field => $value) $query .="`".$field."`,";
        $query = substr($query, 0, -1);
        $query .=") VALUES (";
        //echo "<br>";
        foreach ($new_values as $value) $query .="'".addslashes($value)."',";
        $query = substr($query, 0, -1);
        $query .=")";
        return $this->db->execute($query);
    }
}