<?php

namespace App\FakultasProses;

use Modules\Fakultas\Entity\FakultasEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'delete') {
    $id = $_GET['id'];
    try {
        $fakultasService->delete($id);
        $msg = "Fakultas berhasil dihapus";
        setcookie('success', $msg, time() + 3600);
        header('Location: Fakultas.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 3600);
        header('Location: Fakultas.php');
    }
}


if ($act == 'create') {
    $nama = $_POST['nama'];
    try {
        $req = new FakultasEntity();
        $req->nama = $nama;
        $fakultasService->create($req);
        $msg = "Fakultas berhasil ditambahkan";
        setcookie('success', $msg, time() + 3600);
        header('Location: Fakultas.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 3600);
        header('Location: Fakultas.php');
    }
}

if ($act == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    
    try {
        $req = new FakultasEntity();
        $req->id = $id;
        $req->nama = $nama;

        $fakultasService->update($req);
        $msg = "Fakultas berhasil di update";
        setcookie('success', $msg, time() + 3600);
        header('Location: Fakultas.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 3600);
        header('Location: Fakultas.php');
    }
}