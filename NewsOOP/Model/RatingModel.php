<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class RatingModel extends BaseModel
{

    protected $table = 'rating';


    public function getMark($comment_id, $user_id = ''){

        if ($user_id == ''){
            $user_id = $_SESSION['user_id'];
        }

        $result = $this->db->query('select * from ' . $this->table . ' where user_id= ' . $user_id . ' and comment_id='. $comment_id);

        if(!$result) {
            return array();
        }

        return $result[0];
    }

    public function changeMark($id, $like, $dislike){

        $query = " update rating
                    set `like` = $like , dislike = $dislike
                    where id = $id;
        ";
 
        return $this->db->execute($query);
    }

    public function showRatings(){

        $result = $this->db->query('select comment_id,  sum(`like`) - sum(dislike) as rating  from ' . $this->table  . ' group by comment_id' );

        return $result;
    }
       
}