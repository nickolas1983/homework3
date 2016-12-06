<?php

namespace Controller;


use Model\ArticlesModel;
use Model\CategoriesModel;
use Model\CommentsModel;
use Model\RatingModel;


class ArticleController extends BaseController
{
    protected $name = 'Article';

    public function index() {
       
    }

    public function categoryList($category, $page = '1') {

        $categoriesModel = new CategoriesModel();
        $this->data['category'] = $categoriesModel->get($category);
        
        $articlesModel = new ArticlesModel();

        if ($page){
            $countFrom = ARTICLES_ON_PAGE * $page - ARTICLES_ON_PAGE; // calculate first article on page
        }
        else {
            $countFrom = '';
        }

        $this->data['articles'] = $articlesModel->getByCategories($category, ARTICLES_ON_PAGE, $countFrom);

        $this->data['pagination']['lastPage'] = $articlesModel->countPagesOnCategory($category);

        $this->render('list');
    }
    
    public function tagList($tag, $page = '1'){

        $articlesModel = new ArticlesModel();

        if ($page){
            $countFrom = ARTICLES_ON_PAGE * $page - ARTICLES_ON_PAGE; // calculate first article on page
        }
        else {
            $countFrom = '';
        }

        $this->data['article']['tag'] = $tag;

        $this->data['articles'] = $articlesModel->getByTag($tag, ARTICLES_ON_PAGE, $countFrom);

        $this->data['pagination']['lastPage'] = $articlesModel->countPagesOnTag($tag);

        $this->render('tagList');
    }

    public function commentatorsList($user_id, $page = '1'){

        if ($page){
            $countFrom = ARTICLES_ON_PAGE * $page - ARTICLES_ON_PAGE; // calculate first article on page
        }
        else {
            $countFrom = '';
        }
 
        $commentsModel = new CommentsModel();

        $this->data['comments_list'] = $commentsModel->getCommentsByUser($user_id, ARTICLES_ON_PAGE, $countFrom);

        //var_dump((!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['login'] != ADMIN_LOGIN)) && !0);
        //var_dump($this->data['comments_list'][0]);

        $this->data['pagination']['lastPage'] = $commentsModel->countPagesByUsersComments($user_id);
        //var_dump($this->data['pagination']['lastPage']);
        $this->render('commentsList');
    }
    

    
    public function display($id){


        $articlesModel = new ArticlesModel();

        $this->data['article'] = $articlesModel->get($id);

        /*Закрытые аналитические статьи*/
        if (!isset($_SESSION['login'])) {
            $this->shortArticle($this->data['article'], '8');
        }
        /*------------------------*/

        $tags = $this->data['article']['meta_key'];

        $this->data['article']['tags'] = explode(',', $tags);

        $commentsModel = new CommentsModel();

        $this->data['comments'] = $commentsModel->allComments($this->data['article']['id']);
        
        $this->data['top_comments'] = $commentsModel->getTopCommentsByArticle($this->data['article']['id'], TOP_COMMENTS);

        $commentTree = '';

        $this->commentsTree($this->data['comments'], 0, $commentTree);

        $this->data['comments']['html'] = $commentTree;
        
        $this->render('article');
    }

    public function commentsTree($comments, $root, &$commentTree){
        $childTree = 0;
        foreach ($comments as $comment){

            if ($root == $comment['parent_id']){

                foreach ($comments as $child){
                    if ($child['parent_id'] == $comment['id_comment']){
                        $childTree = 1;
                        break;
                    }
                }



                if ( (!isset($_SESSION['login']) || (isset($_SESSION['login']) && $_SESSION['login'] != ADMIN_LOGIN)) && (!$comment['visible'] && $comment['categories_id'] == 4)){
                    $visible = "; display: none;";
                }
                else {
                    $visible = "";
                }

                if ((isset($_SESSION['login']) && $_SESSION['login'] == ADMIN_LOGIN)){
                    $edit = "<button class='edit' id='edit_comment_".$comment['id_comment']."'>Редактировать</button>";
                } else {
                    $edit ="";
                }

                $rating = $this->showRating($comment['rating']);

                $commentTree .= "<li class=\"well well-small\" id='comment_".$comment['id_comment']."' style='text-decoration: none ".$visible."'>";
                $commentTree .= "<p><b>".$comment['login'] ." :</b><span> ".$comment['comment']."</span></p><div style='text-align: right'>";
                $commentTree .= " $rating <button class='like' id='+_comment_".$comment['id_comment']."'>+</button><button class='like' id='-_comment_".$comment['id_comment']."'>-</button>";
                $commentTree .= "<button class='like' id='answer_comment_".$comment['id_comment']."'>Ответить</button>".$edit."</div>";
                $commentTree .= "</li>\n";

                if ($childTree > 0) {

                    $commentTree .= "    <ul>";

                    $this->commentsTree($comments, $comment['id_comment'], $commentTree);

                    $commentTree .= "</ul>\n";

                    $childTree = 0;
                }
            }
         }
    }

    public function counter(){
        $articlesModel = new ArticlesModel();

        $articlesModel->updateViews($_GET['visitors'], $_GET['id']);
        
        $this->data['article'] = $articlesModel->get($_GET['id']);
        
        echo $this->data['article']['visitors_count'];
    }

    public function editComment(){

        $commentsModel = new CommentsModel();

        $commentsModel->updateComment($_POST['id'], $_POST['text']);
    }
    
    public function search(){
        if (isset($_GET['text']) && $_GET['text']){
            $articlesModel = new ArticlesModel();

            $this->data['articles'] = $articlesModel->getByTag(trim($_GET['text']));


            foreach ($this->data['articles'] as $article){

                $array = explode(',', $article['meta_key']);

                foreach ($array as $tag) {

                    $tag = mb_strtolower(trim($tag));
                    $needle = mb_strtolower(trim($_GET['text']));

                    if (strpos($tag , $needle) !== false){
                        $tags[] = $tag;
                    }
                }
            }

            if (isset($tags) && $tags) echo implode(";", array_unique($tags));
        }

    }

    public function saveComment(){
        if ($_POST['text']){
            $commentsModel = new CommentsModel();
            $comment = array(
                "comment"=>"{$_POST['text']}",
                "user_id"=>"{$_SESSION['user_id']}",
                "article_id"=>$_POST['id'],
                "parent_id"=>$_POST['parent_id'],
            );

            $commentsModel->insert($comment);

            $data = $commentsModel->getLastComment("id", "DESC");

            echo json_encode($data);
        }
    }

    public function like(){
        if (isset($_SESSION['login']) && ($_POST['id'] and $_POST['mark'])){
            $mark = ($_POST['mark'] == "+") ? 1 : 0 ;
            $comment_id = $_POST['id'];
            $ratingModel = new RatingModel();
            $old_mark = $ratingModel->getMark($comment_id);
            $commentsModel = new CommentsModel();

            if ($old_mark){
                if ($mark === 1 && (($old_mark['like'] == 0 && $old_mark['dislike'] == 0) || ($old_mark['like'] == 0 && $old_mark['dislike'] == 1))){
                    $like = 1;
                    $dislike = 0;
                    $ratingModel->changeMark($old_mark['id'], $like, $dislike);
                }
                else if ($mark === 0 && (($old_mark['like'] == 0 && $old_mark['dislike'] == 0) || ($old_mark['like'] == 1 && $old_mark['dislike'] == 0))){
                    
                    $like = 0;
                    $dislike = 1;
                    $ratingModel->changeMark($old_mark['id'], $like, $dislike);
                }
                else {
                    $like = 0;
                    $dislike = 0;
                    $ratingModel->changeMark($old_mark['id'], $like, $dislike);
                }

            }
            else {
                if ($mark) {
                    $like = 1;
                    $dislike = 0;
                }
                else {
                    $like = 0;
                    $dislike = 1;
                }

                $rating = array(
                    "comment_id"=>"{$_POST['id']}",
                    "user_id"=>"{$_SESSION['user_id']}",
                    "like"=>$like,
                    "dislike"=>$dislike,
                );

                $ratingModel->insert($rating);

            }
            $data = $commentsModel->getByID($comment_id);

            echo json_encode($data);
        }
        
    }

    public function showRating($rating){

            if ($rating >= 0){
                $result = "<span style='color: green; font-weight: bold'>$rating </span>";
            }
            else {
                $result = "<span style='color: red; font-weight: bold'>$rating </span>";
            }
            return $result;
    }



}