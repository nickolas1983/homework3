<?php

namespace Model;


class MessageModel extends BaseModel
{
    protected $table = 'messages'; 
    

    public function save($data) {

        $data['name'] = $this->db->escape($data['name']);
        $data['email'] = $this->db->escape($data['email']);
        if (isset($data['message']) && $data['message']){
           $message = $data['message'] = $this->db->escape($data['message']);
        }
        else {
            $message ="";
        }


        $query = " INSERT INTO messages
                    set `name` = '{$data['name']}',
                        email = '{$data['email']}',
                        message = '{$message}'
        ";

        return $this->db->execute($query);
    }
} 