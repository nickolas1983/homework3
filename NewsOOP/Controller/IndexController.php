<?php

namespace Controller;


use Model\CategoriesModel;
use Model\MessageModel;
use Model\ArticlesModel;
use Model\CommentsModel;

class IndexController extends BaseController
{
    protected $name = 'Index';

    public function index() {

        $this->data['siteName'] = SITE_NAME;



        $categoriesModel = new CategoriesModel();
        $this->data['categories'] = $categoriesModel->getAll();

        /*Фильтр категории АНАЛИТИКА*/        
        if (1!=1){
            $this->data['categories'] = $this->categoryFilter($this->data['categories'], 8);
        }
        /*---------------------*/

        $articlesModel = new ArticlesModel();

        $this->data['articles']['slider'] = $articlesModel->getRandomElements(5, 'date');
        

        foreach ($this->data['categories'] as $category) {
            $this->data['articles'][$category['id']] = $articlesModel->getByCategories($category['id'], ARTICLES_IN_CATEGORY);
        }

        $commentsModel = new CommentsModel();
        
        $this->data['commentators'] = $commentsModel->getTopCommentators(TOP_COMMENTATORS);

        $this->data['top_themes'] = $articlesModel->getTopThemes(TOP_THEMES);

        $this->render("main");
    }




    public function contact(){
        /* adding message*/
        if($_POST) {
            $message = new MessageModel();
            if($message->save($_POST)) {
                //BaseController::redirect('');
                //$this->message = $_POST['name'] . ', thank you for your message!';
                echo "<p>Спасибо! Вашиданныйе успешно сохранены</p>";
            }
            else {
                echo "<p>Не удалось сохранить данные</p>";
            }
        }
        

        //$this->render("contact");
    }
    
}