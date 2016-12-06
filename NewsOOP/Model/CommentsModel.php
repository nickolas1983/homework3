<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class CommentsModel extends BaseModel {

    protected $table = 'comments';


    public function allComments($article = ''){

        if ($article) {
            $article =' where article_id = '.$article;
        }
        $result = $this->db->query(
            'SELECT comments.id id_comment, `comment`, categories_id,  comments.user_id id_user, visible, article_id, add_date,change_date, parent_id, login, email,  sum(`like`) - sum(dislike) as rating'.
            ' from ' . $this->table .
            ' left join users on users.id = comments.user_id'.
            ' left join articles a on  a.id = `comments`.article_id'.
            ' left join rating on rating.comment_id = comments.id'.$article.
            ' group by comments.id , `comment`, comments.user_id , article_id, add_date,change_date, parent_id, login, email'
        );

        return $result;
    }


    public function getLastComment($field, $order = ""){
        if (!$order){
            $order = " order by comments.$field ";
        }
        else{
            $order = " ORDER BY comments.$field DESC ";
        }

        $result = $this->db->query(
            'SELECT comments.id id_comment, `comment`, comments.user_id id_user, article_id, add_date,change_date, parent_id, login, email,  sum(`like`) - sum(dislike) as rating'.
            ' from ' . $this->table .
            ' left join users on users.id = comments.user_id'.
            ' left join rating on rating.comment_id = comments.id'.
            ' group by comments.id , `comment`, comments.user_id, article_id, add_date,change_date, parent_id, login, email'.
            ' ' . $order . 'limit 1'
        );

        if(!$result) {
            return array();
        }

        return $result[0];
    }

    public function getByID($id){

        $result = $this->db->query(
            'SELECT comments.id id_comment, `comment`, comments.user_id id_user, article_id, add_date,change_date, parent_id, login, email,  sum(`like`) - sum(dislike) as rating'.
            ' from ' . $this->table .
            ' left join users on users.id = comments.user_id'.
            ' left join rating on rating.comment_id = comments.id'.
            ' where comments.id = '.$id.
            ' group by comments.id , `comment`, comments.user_id, article_id, add_date,change_date, parent_id, login, email'
        );

        if(!$result) {
            return array();
        }

        return $result[0];
    }
    
    public function getTopCommentators($top){

        if ( isset($_SESSION['login']) && $_SESSION['login'] == ADMIN_LOGIN){
            $condition = " 1 ";
        }
        else {
            $condition = " (users.id = comments.user_id) and ((categories_id = 4 and visible = 1) or (categories_id != 4))";
        }

        $result = $this->db->query(
            "SELECT  comments.user_id id_user, login,  count(user_id) as comments
             from  `comments`
             left join users on users.id = comments.user_id
             left join articles a on  a.id = `comments`.article_id
             where $condition
             group by comments.user_id, login order by comments DESC
             limit $top"
        );

        return $result;
    }

    public function getCommentsByUser($user_id, $count = '', $countFrom = '')
    {

        if ($countFrom != '') $countFrom .= " , ";

        if ( isset($_SESSION['login']) && $_SESSION['login'] == ADMIN_LOGIN){
            $condition = "";
        }
        else {
            $condition = " and ((categories_id = 4 and visible = 1) or (categories_id != 4))";
        }

        $query  = 'select comments.id as comment_id, `comment`,  visible, user_id, login, add_date, title';
        $query  .= ' from comments';
        $query  .= ' left join users on comments.user_id = users.id';
        $query  .= ' left join articles on articles.id = comments.article_id';
        $query  .= " where user_id = $user_id".$condition ;
        $query  .= ' order by add_date DESC';
        $query  .= " limit $countFrom $count";

        $result = $this->db->query($query);
        if($result){ 
            return $result;
        }
        return array();
    }

    public function getCommentsByCategory($category_id, $count = '', $countFrom = '')
    {

        if ($countFrom != '') $countFrom .= " , ";

        $query  = 'select comments.id as comment_id, `comment`, visible, user_id, login, add_date, title';
        $query  .= ' from comments';
        $query  .= ' left join users on comments.user_id = users.id';
        $query  .= ' left join articles on articles.id = comments.article_id';
        $query  .= " where categories_id = $category_id";
        $query  .= ' order by add_date DESC';
        $query  .= " limit $countFrom $count";

        $result = $this->db->query($query);
        if($result){
            return $result;
        }
        return array(); 
    }

    public function updateVisible($visible, $id){

        $query = " update comments
                    set visible = $visible
                    where id = $id;
        ";

        return $this->db->execute($query);
    }

    public function updateComment($id, $text){

        $query = " update comments
                    set `comment` = '".$text."'
                    where id = $id;
        ";

        return $this->db->execute($query);
    }

    public function countPagesByUsersComments($user_id){

        if ( isset($_SESSION['login']) && $_SESSION['login'] == ADMIN_LOGIN){
            $condition = "";
        }
        else {
            $condition = " and ((categories_id = 4 and visible = 1) or (categories_id != 4))";
        }

        $query = "select count(*) as quantity
                  from comments
                  left join articles on articles.id = comments.article_id
                  where user_id = $user_id".$condition;

        $quantity = $this->db->query($query);

        $result =  ceil( $quantity[0]['quantity'] / ARTICLES_ON_PAGE);
        return $result;
    }

    public function countPagesByCategoriesComments($categories_id){

        $query = "select count(*) as quantity
                  from comments
                  left join articles on articles.id = comments.article_id
                  where categories_id = $categories_id";

        $quantity = $this->db->query($query);

        $result =  ceil( $quantity[0]['quantity'] / ARTICLES_ON_PAGE);
        return $result;
    }

    public function getTopCommentsByArticle($article_id, $top){
        $query = "select comment_id, `comment`, login, count(`like`) as rate
        from comments c
        left join rating r on r.comment_id = c.id
        left join users u on u.id = c.user_id
        where c.article_id = $article_id
        group by comment_id, `comment`
        order by rate desc
        limit $top";

        $result = $this->db->query($query);
        if($result){
            return $result;
        }
        return array();
    }
}