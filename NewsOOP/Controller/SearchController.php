<?php

namespace Controller;


use Model\CategoriesModel;
use Model\MessageModel;
use Model\ArticlesModel;
use Model\CommentsModel;
use Model\TagsModel;

class SearchController extends BaseController
{
    protected $name = 'Search';


    public function search()
    {
        /* adding message*/
        //var_dump($_POST);
        if ($_POST) {
            $articleModel = new ArticlesModel();

            if (!isset($_POST['selectTags'])) $tags = "-1";
            else $tags = $_POST['selectTags'];

            if (!isset($_POST['selectCategories'])) $categ = "-1";
            else $categ = $_POST['selectCategories'];

            if (!isset($_POST['begin_date']) || !$_POST['begin_date']) $begin_date = "-1";
            else $begin_date = $_POST['begin_date'];

            if (!isset($_POST['end_date']) || !$_POST['end_date']) $end_date = "-1";
            else $end_date = $_POST['end_date'];

            $this->data['articles'] = $articleModel->getExpandedSearch($categ, $tags, $begin_date, $end_date);

            $this->render("searchResult");
        }
        else {

            $categoriesModel = new CategoriesModel();
            
            $this->data['categories'] = $categoriesModel->getAll();

            $tegsModel = new TagsModel();
            
            $this->data['tags'] = $tegsModel->getAllTags();

            $this->render("search");
        }


    }
}