<?php
namespace App\Controller;

use App\Model\User;

class AuthController
{
    public static function login()
    {
        if (self::isLoggedIn()) {
            redirect('/webfinal/');
        }
        view('login.php');
    }

  public function register()
{
    view('register.php');
}


    public static function storeUser()
    {
        $user = User::create([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);

        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;

        redirect('/webfinal/');
    }

    public static function loginUser()
    {
        $user = User::where('email', $_POST['email'])->first();

        if ($user && password_verify($_POST['password'], $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            redirect('/webfinal/');
        }

        redirect('/webfinal/login');
    }

    private static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}