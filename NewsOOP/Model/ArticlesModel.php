<?php
/**
 * Created by PhpStorm.
 * Users: Andruew
 * Date: 29.10.16
 * Time: 13:37
 */

namespace Model;


class ArticlesModel extends BaseModel {

    protected $table = 'articles';

    public function getByCategories($categ_id, $count = '', $countFrom = '')
    {
        $id =  "(select article_id from articles_categories where category_id = $categ_id)";

        $result = $this->getByField('id', $id, 'date', $count, $countFrom);
        if($result){
            return $result;
        }

        return array();

    }

    public function getByTag($tag, $count = '', $countFrom = ''){

        $order = " ORDER BY `date` DESC";
        if ($count){
            if ($countFrom){
                $count = ' limit '.$countFrom.', '.$count;
            } else {
                $count = ' limit '.$count;
            }
        }

        $tag = mb_strtolower($tag);

        $where = " where lower(meta_key) like '%$tag%' ";
        $result = $this->db->query('select * from ' . $this->table . $where . $order . $count);
        

        if($result){
            return $result;
        }

        return array();
    }


    public function countPagesOnCategory($category){

        $id =  "(select article_id from articles_categories where category_id = $category)";

        $result = $this->countByFild('id', $id);
        $result =  ceil( $result / ARTICLES_ON_PAGE);
        return $result;
    }

    public function countPagesOnTag($tag){
        $where = " where meta_key like '%$tag%' ";
        $result = $this->db->query('select COUNT(*) from ' . $this->table . $where);
        $result = ceil( $result[0]["COUNT(*)"] / ARTICLES_ON_PAGE);
        return $result;
    }

    public function updateViews($visitors, $id){

        $query = " update articles
                    set visitors_count = visitors_count + $visitors
                    where id = $id; 
        ";
        
        return $this->db->execute($query);
    }

    public function getTopThemes($top){
        $query =  "select article_id, title, count(`comment`) as rate
                  from articles a
                  left join comments c on a.id = c.article_id 
                  WHERE TO_DAYS(NOW()) - TO_DAYS(add_date) <= 30
                  group by  article_id, title
                  order by rate DESC
                  limit $top";

        $result = $this->db->query($query);
        
        if($result){
            return $result;
        }

        return array();
    }

    public function getExpandedSearch($categories = "-1", $tags = "-1", $begin_date = "-1", $end_date = "-1"){

        if ($categories != "-1"){
            $categ_str = implode(", ", $categories);
            $categ_str = "a.categories_id in ($categ_str) ";
        }
        else {
            $categ_str = "";
        }

        if ($tags !="-1"){
            $tags_list ="";
            foreach ($tags as $tag){
                $tags_list .= "'$tag', ";
            }
            $tags_list =  mb_substr($tags_list, 0, mb_strlen($tags_list) - 2);
            if ($categ_str) $tags_str = "AND ";
            else $tags_str = " ";
            $tags_str  .= "t.article_id in (select article_id
							from tags
							where tag in ($tags_list)) ";
        }
        else {
            $tags_str = "";
        }

        if ($begin_date != "-1" && $end_date != "-1"){
            $begin_date = strtotime($begin_date);
            $end_date = strtotime($end_date);
            if ($categ_str || $tags_str) $date_str = "AND ";
            else $date_str =" ";
            $date_str = "and `date` BETWEEN $begin_date AND $end_date";
        }
        else {
            $date_str ="";
        }


        $query = "select a.id as id, title
              from articles a
              left join tags t on a.id = t.article_id
              where $categ_str $tags_str $date_str 
               group by  a.id , title";

        $result = $this->db->query($query);

        if($result){
            return $result;
        }

        return array();

    }
    
}