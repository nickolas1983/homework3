<?php

namespace Controller;

use Model\ReclameModel;
use Model\MenuModel;
use Model\ConfigModel;

class BaseController
{
    protected $name = 'Index';

    protected $layout = 'default';

    /* data for views */
    protected $data;

    protected $message;

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    protected function render($templateName) {
 
        $data = $this->data;
        $message = $this->message;

        $configModel = new ConfigModel();

        $data['config'] = $configModel->getAll();

        foreach ($data['config'] as $property){

            if ($property['property'] == 'edit_background'){
                if (isset($property['value']) && $property['value']){
                    $data['background-color'] = "style = 'background-color: ".$property['value'].";'";
                }
                else{
                    $data['background-color'] = "";
                }
            }

            if ($property['property'] == 'edit_top_menu'){
                if (isset($property['value']) && $property['value']){
                    $data['menu_color'] = "style='background-color: ".$property['value']."; background-image: none'";
                }
                else {
                    $data['menu_color'] = "";
                }
            }
        }

        ob_start();
        include SITE_DIR . DS. "View" .DS . $this->name . DS. $templateName . '.php';
        $content = ob_get_clean();

        $reclame = $this->renderReclame();
        $left_content = $reclame[0][0];
        $right_content = $reclame[1][0];

        $menu_content = $this->renderMenu();

        include SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }
    
    protected function renderMenu(){

        $menuModel = new MenuModel();

        $data['menu'] = $menuModel->getAll();

        $menuTree = '';

        $this->menuTree($data['menu']   , 0, $menuTree);
        
        return $menuTree;
    }

    public function menuTree($menu, $root, &$menuTree){
        $childTree = 0;
        foreach ($menu as $item){

            if ($root == $item['parent_id']){

                foreach ($menu as $child){
                    if ($child['parent_id'] == $item['id']){
                        $childTree = 1;
                        break;
                    }
                }

                if ($childTree > 0) {

                    $menuTree .= " <li class='dropdown-submenu'><a href='#'>".$item['text']."</a><ul class='dropdown-menu'>";

                    $this->menuTree($menu, $item['id'], $menuTree);

                    $menuTree .= "</ul></li>";

                    $childTree = 0;
                }
                else {
                    $menuTree .= "<li><a href='#'>".$item['text']."</a></li>";
                }
            }
        }
    }
    

    protected function renderReclame(){

        $reclameModel = new ReclameModel();

        $data['reclames'] = $reclameModel->getRandomElements(6);

        ob_start();
        include SITE_DIR . DS. "View" .DS . "Reclame" . DS. "left_content" . '.php';
        $left_content = ob_get_clean();

        ob_start();
        include SITE_DIR . DS. "View" .DS . "Reclame" . DS. "right_content" . '.php';
        $right_content = ob_get_clean();

        return array([$left_content],[$right_content]);
    }

    protected function render404() {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS. "View" .DS .'404.php';
        $content = ob_get_clean();

        include SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }

    protected function renderMessage() {

        $data = $this->data;
        $message = $this->message;

        ob_start();
        include SITE_DIR . DS. "View" .DS .'message.php';
        $content = ob_get_clean();

        include SITE_DIR . DS. "View" .DS . "Layout" .DS . $this->layout .'.php';
    }

    public static function redirect($location) {
        $addpath = ADDITIONAL_PATH;
        header("location: {$addpath}{$location}");
    }

    public static function countPages($array){
        $result =  ceil( count($array) / ARTICLES_ON_PAGE);
        return $result;
    }

    public function categoryFilter($array, $id){
        $result = array();
        foreach ($array as $item){
            if ($item['id'] != $id){
                $result[] = $item;
            }
        }
        return $result;
    }

    public function shortArticle(&$array, $id) {
            if ($array['analytics'] == $id){
                $array['full_text'] = mb_substr($array['full_text'], 0, 255).'...';
            }
    }
    
    public function tagsFromArticles($articles){
        $tags = array();
        foreach ($articles as $article){

            $array = explode(',', $article['meta_key']);

            foreach ($array as $tag) {
                $tag = mb_strtolower(trim($tag));
                $tags[] = $tag;
            }
        }
        return $tags;
    }

}