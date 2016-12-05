<?php

interface UserInterface
{
    public function login();
    public function logout();
    public function setLogin($login);
    public function getLogin();
}

class User implements UserInterface
{
    protected $login;
    public $password;
    public $email;
    public $rating = 0;
    protected $isLogged = false;

    public function login()
    {
        $this->isLogged = true;
        echo 'login<br>';
    }

    public function logout()
    {
        $this->isLogged = false;
        echo 'logout<br>';
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    public function __set($name, $value)
    {
        echo 'Try to set '.$name.' value '.$value.'<br>';
    }

    public  function __get($name)
    {
        echo 'try to get '.$name.'<br>';
    }
}

class Manager extends User
{

}

class Admin extends User
{

}

class Car
{
    public $brand;
    public $model;
    public $year;
    public $driver;
    private $price;

    public function __construct()
    {
        echo 'Car created';
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = round($price, 2);
    }

    /**
     * @return mixed
     */
    public function getPrice($true)
    {
        if($true){
            return number_format($this->price, 2);
        }
        else{
            return $this->price;
        }

    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
}

class WaterCar extends Car
{
    public $waterSpeed;
}

$user = new User();
echo $user->login;
$user->login = 2;


$car = new Car();

$admin = new Admin();
$admin->setLogin('Nick');
var_dump($admin->getLogin());

//die();
$toyota = new Car();
$toyota->setPrice(1000.8888);
$price = $toyota->getPrice(1);
echo $price;

//die();
$array = array('name' => 'Nick', 'email' => 'nick@ukr.net', 'message' => 'Hello, there!');
$obj = (object)$array;
var_dump($obj);

//die();
$nick = new User();
$nick->login();
$nick->logout();

//die();
$nick = new User();
$nick->setLogin('Nick');
$nick->password = '123';
$nick->email = 'nick@ukr.net';
$nick->rating = 10;

$bred = new User();
$bred->setLogin('Bred');
$bred->password = '321';
$bred->email = 'Bred@ukr.net';
$bred->rating = '5';

$toyota = new Car();
$toyota->brand = 'Toyota';
$toyota->model = 'Corola';
$toyota->year = '(2000)';
$toyota->driver = $nick;

$mazda = new Car();
$mazda->brand = 'Mazda';
$mazda->model = '6';
$mazda->year = '(2015)';
$mazda->driver = $nick;

$ford = new Car();
$ford->brand = 'Ford';
$ford->model = 'Taurus';
$ford->year = '(1995)';
$ford->driver = $bred;

echo '<pre>';
var_dump($toyota);
var_dump($mazda);
var_dump($ford);

print_r($toyota);
print_r($mazda);
print_r($ford);
echo '</pre>';

