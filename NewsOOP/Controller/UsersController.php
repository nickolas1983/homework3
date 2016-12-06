<?php


namespace Controller;

use Model\UsersModel;

class UsersController extends BaseController
{
    protected $name = 'Users';

    public function login() {
        if ($_POST && isset($_POST['login']) && $_POST['password']){
            $userModel = new UsersModel();
            $user = $userModel->getByLogin($_POST['login']);
            $hash = md5(SALT.$_POST['password']);
            //var_dump($hash);
            if ( $user && $user['is_active'] && $hash == $user['password']) {
                $_SESSION['login'] = $user['login'];
                $_SESSION['user_id'] = $user['id'];
                BaseController::redirect('');
            }
            else {
                $this->message = "Ошибочка";
                $this->render('login');
            }
        } else {
            $this->render('login');
        }
    }


    public function registry(){
        if (isset($_POST) && isset($_POST['login']) && $_POST['login'] && $_POST['password'] && $_POST['email']){
            $userModel = new UsersModel();
            $user = $userModel->getByLogin($_POST['login']);
            $hash = md5(SALT.$_POST['password']);
            //var_dump($hash);
            if (!$user && $_POST['login']) {

                $newUser = array(
                    "login"=>"{$_POST['login']}",
                    "email"=>"{$_POST['email']}",
                    "password"=>$hash,
                    "is_active"=>1,
                );

                $result = $userModel->insert($newUser);
                    //var_dump($result);
                if ($result){
                    $user = $userModel->getByLogin($_POST['login']);
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['user_id'] = $user['id'];
                    BaseController::redirect('');
                }
            }
            else {
                $this->message = "Ошибочка";
                $this->render('registry');
            }
        }
        else {
            $this->render('registry');
        }
    }
    

    public function logout() {
        session_destroy();
        BaseController::redirect('');
    }
}