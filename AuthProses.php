<?php

namespace App\LoginProses;

use Modules\User\Entity\UserEntity;
use Modules\User\Repository\UserRepository;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'login') {
    $captcha = $_POST['captcha'];
    $captchaCode = $_COOKIE['CaptchaCode'];
    
    if (!password_verify($captcha, $captchaCode)) {
        $msg = "Captcha Salah";
        setcookie('error', $msg, time() + 5, '/');
        header('Location: Login.php');        
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];
    
    try {
        $req = new UserEntity();
        $req->email = $email;
        $req->password = $password;

        $user = $userService->login($req);
        $sessionService->create($user->id);
        $msg = "Login berhasil";
        setcookie('success', $msg, time() + 5, '/');
        header('Location: index.php');
    } catch (\Exception $exception) {
        $msg = "Login Gagal $exception";
        setcookie('error', $msg, time() + 5, '/');
        header('Location: index.php');
    }
}


if ($act == "logout") {
    $sessionService->destroy();
    $msg = "Logout berhasil";
    setcookie('success', $msg, time() + 5, '/');
    header('Location: Login.php');
}