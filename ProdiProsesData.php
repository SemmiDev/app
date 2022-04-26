<?php

namespace App\ProdiProses;

use Modules\Prodi\Entity\ProdiEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'delete') {
    $id = $_GET['id'];
    try {
        $prodiService->delete($id);
        $msg = "Prodi berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Prodi.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Prodi.php');
    }
}

if ($act == 'create') {
    $nama = $_POST['nama'];
    $akreditasi = $_POST['akreditasi'];
    $kaprodiId = $_POST['kaprodi'];
    $jurusanId = $_POST['jurusan'];
    
    try {
        $req = new ProdiEntity();
        $req->nama = $nama;
        $req->akreditasi = $akreditasi;
        $req->idKaprodi = $kaprodiId;
        $req->idJurusan = $jurusanId;

        $prodiService->create($req);
        $msg = "Prodi berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Prodi.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Prodi.php');
    }
}

if ($act == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $akreditasi = $_POST['akreditasi'];
    $kaprodiId = $_POST['kaprodi'];
    $jurusanId = $_POST['jurusan'];

    try {
        $req = new ProdiEntity();
        $req->id = $id;
        $req->nama = $nama;
        $req->akreditasi = $akreditasi;
        $req->idKaprodi = $kaprodiId;
        $req->idJurusan = $jurusanId;

        $prodiService->update($req);
        $msg = "Prodi berhasil di update";
        setcookie('success', $msg, time() + 5);
        header('Location: Prodi.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Prodi.php');
    }
}
