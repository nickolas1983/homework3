<?php
class login
{
    protected $login;
    protected $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = md5($password);
    }
}

if (isset($_POST['authorisation'])){
    new login($_POST['login'], $_POST['password']);
}
?>

<form>
    <label for="login">Enter login</label>
    <input type="text" name="login" id="login"><br>
    <label for="password">Enter password</label>
    <input type="password" name="password" id="password"><br>
    <input type="submit" name="authorisation" value="login">
</form>
