<?php

namespace App\JurusanProses;

require_once './App.php';

use Modules\Jurusan\Entity\JurusanEntity;

$act = $_GET['act'];

if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $jurusanService->delete($id);
        $msg = "Jurusan berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Jurusan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Jurusan.php');
    }
}

if ($act == 'create') {
    $nama = $_POST['nama'];
    $idKajur = $_POST['id_kajur'];
    $akreditasi = $_POST['akreditasi'];
    $jenjang = $_POST['jenjang'];
    $idFakultas = $_POST['idFakultas'];

    try {
        $req = new JurusanEntity();
        $req->nama = $nama;
        $req->idKajur = $idKajur;
        $req->akreditasi = $akreditasi;
        $req->jenjang = $jenjang;
        $req->idFakultas = $idFakultas;

        if ($idFakultas == "") {
            $req->idFakultas = null;
        }

        if ($idKajur == "") {
            $req->idKajur = null;
        }
        
        $jurusanService->create($req);
        $msg = "Jurusan berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Jurusan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Jurusan.php');
    }
}

if ($act == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $idKajur = $_POST['kajur'];
    $akreditasi = $_POST['akreditasi'];
    $jenjang = $_POST['jenjang'];
    $idFakultas = $_POST['idFakultas'];

    try {
        $req = new JurusanEntity();
        $req->id = $id;
        $req->idKajur = $idKajur;
        $req->nama = $nama;
        $req->akreditasi = $akreditasi;
        $req->jenjang = $jenjang;
        $req->idFakultas = $idFakultas;

        $jurusanService->update($req);
        $msg = "Jurusan berhasil di update";
        setcookie('success', $msg, time() + 5);
        header('Location: Jurusan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Jurusan.php');
    }
}
