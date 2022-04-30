<?php

namespace App\LoginProses;

use EmptyIterator;
use Modules\User\Entity\UserEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    try {
        $req = new UserEntity();
        $req->email = $email;
        $req->password = $password;

        $userService->register($req);
        $msg = "Login berhasil";
        setcookie('success', $msg, time() + 5, '/');
        header('Location: index.php');
    } catch (\Exception $exception) {
        $msg = "Login Gagal $exception";
        setcookie('error', $msg, time() + 5, '/');
        header('Location: index.php');
    }
}
