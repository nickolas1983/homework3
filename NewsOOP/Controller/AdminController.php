<?php

namespace Controller;


use Model\CategoriesModel;
use Model\ConfigModel;
use Model\MenuModel;
use Model\MessageModel;
use Model\ArticlesModel;
use Model\CommentsModel;
use Model\ReclameModel;
use Model\TagsModel;
use Model\Art_CatModel;

class AdminController extends BaseController
{
    protected $name = 'Admin';

    public function panel(){
        $this->render('panel');
    }
    public function article(){

        $categoriesModel = new CategoriesModel();

        $this->data['categories'] = $categoriesModel->getAll();


        if (isset($_POST['add_article']) && $_POST['add_article']) {
            $articlesModel = new ArticlesModel();

            if (!isset($_POST['add_news'])) $add_news = "";
            else $add_news = $_POST['add_news'];
            if (!isset($_POST['selectCategory'])) $categories_id = "";
            else $categories_id = $_POST['selectCategory'];
            if (!isset($_POST['full_text'])) $full_text = "";
            else $full_text = $_POST['full_text'];

            if (!isset($_FILES)) $image = "";
            else{
                
                
                
                $uploadfile = 'public'.DS.'images'.DS.$_FILES['image']['name'];

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    $image = $_FILES['image']['name'];
                } else {
                    $image = "";
                }
            }
            if (!isset($_POST['meta_key'])) $meta_key = "";
            else $meta_key = $_POST['meta_key'];
            if (!isset($_POST['analytics'])) $analytics = "";
            else $analytics = $_POST['analytics'];

            $date = time();

            $new_article = array(
                "title"=>$add_news,
                "categories_id"=>$categories_id,
                "full_text"=>$full_text,
                "image"=>$image,
                "meta_key"=>$meta_key,
                "analytics"=>$analytics,
                "date"=>$date,
            );


            if ($articlesModel->insert($new_article)){

                $article = $articlesModel->getLast('id', 'DESC');
                
                $art_CatModel = new Art_CatModel();
                $article_categ = array(
                    "category_id"=>$categories_id,
                    "article_id"=>$article['id'],
                );
                $art_CatModel->insert($article_categ);

                $tagsModel = new TagsModel();
                $tags = explode(',', $meta_key);

                foreach ($tags as $tag) {

                    $tag = mb_strtolower(trim($tag));

                    $new_tag = array(
                        "tag"=>$tag,
                        "article_id"=>$article['id'],
                    );
                    $tagsModel->insert($new_tag);
                }

                
                $this->message = 'Новость добавлена';
            }
        }        
        $this->render('article');
    }
    public function category(){
        if (isset($_POST['add_category']) && $_POST['add_category']) {
            $categoriesModel = new CategoriesModel();
                $category = array(
                    "title"=>"{$_POST['add_category']}",
                    "description"=>"{$_POST['add_category_description']}",
                );

                if ($categoriesModel->insert($category)){
                    $this->message = 'Категория добавлена';
                }
        }
        $this->render('category');
    }
    public function banners(){
        if (isset($_POST['add_title']) && $_POST['add_title']) {
            $reclameModel = new ReclameModel();

            if (!isset($_POST['add_price'])) $add_price = "";
            else $add_price = $_POST['add_price'];
            if (!isset($_POST['add_firm'])) $add_firm = "";
            else $add_firm = $_POST['add_firm'];
            
            $banner = array(
                "title"=>"{$_POST['add_title']}",
                "price"=>"{$_POST['add_price']}",
                "firm"=>"{$_POST['add_firm']}",
            );

            if ($reclameModel->insert($banner)){
                $this->message = 'Категория добавлена';
            }
        }
        $this->render('banners');
    }
    public function menu(){

        $configModel = new ConfigModel();

        if (isset($_POST['edit_background']) && $_POST['edit_background']){
            $configModel->updateConfig('edit_background', $_POST['edit_background']) ;
        }
        if (isset($_POST['edit_top_menu']) && $_POST['edit_top_menu']){
            $configModel->updateConfig('edit_top_menu', $_POST['edit_top_menu']) ;
        }

        $this->render('menu');
    }

    public function reset(){
        $configModel = new ConfigModel();

        $configModel->updateConfig('edit_background', 0) ;
        $configModel->updateConfig('edit_top_menu', 0) ;
        
        $this->render('menu');
    }
    public function comments($page = '1'){
        
        if ($page){
            $countFrom = ARTICLES_ON_PAGE * $page - ARTICLES_ON_PAGE; // calculate first article on page
        }
        else {
            $countFrom = '';
        }

        $commentsModel = new CommentsModel();

        $this->data['comments_list'] = $commentsModel->getCommentsByCategory(POLITICS_ID, ARTICLES_ON_PAGE, $countFrom);

        //var_dump($this->data['comments_list']);

        $this->data['pagination']['lastPage'] = $commentsModel->countPagesByCategoriesComments(POLITICS_ID);
        
        $this->render('comments');
    }

    public function visible(){
        if (isset($_POST)){
            $commentsModel = new CommentsModel();

            $commentsModel->updateVisible($_POST['visible'], $_POST['id']);
        }

    }

    public function menuEdit(){

        $menuModel = new MenuModel();

        $this->data['menu'] = $menuModel->getAll();

        if (isset($_POST['add_point']) && $_POST['add_point']) {

            if (!isset($_POST['parent_id'])) $parent_id = "";
            else $parent_id = $_POST['parent_id'];

            $point = array(
                "text"=>"{$_POST['add_point']}",
                "parent_id"=>"{$_POST['parent_id']}",
            );

            if ($menuModel->insert($point)){
                $this->message = 'Пункт меню добавлен';
            }
        }        
        
        $this->render('menuEdit');
    }
}