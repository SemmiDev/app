<?php

namespace App\MengajarProses;

use Modules\Mengajar\Entity\MengajarEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'create') {
    $idDosen = $_POST['idDosen'];
    $idMataKuliah = $_POST['idMataKuliah'];
    $hari = $_POST['hari'];
    $jamMulai = $_POST['jamMulai'];
    $jamSelesai = $_POST['jamSelesai'];
    
    try {
        $req = new MengajarEntity();
        $req->idDosen = $idDosen;
        $req->idMataKuliah = $idMataKuliah;
        $req->hari = $hari;
        $req->jamMulai = $jamMulai;
        $req->jamSelesai = $jamSelesai;

        if ($idDosen == "") {
            $req->idDosen = null;
        }
        if ($idMataKuliah == "") {
            $req->idMataKuliah = null;
        }
        
        $mengajarService->create($req);
        $msg = "Mengajar berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Mengajar.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mengajar.php');
    }
}


if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $mengajarService->delete($id);
        $msg = "Mengajar berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Mengajar.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mengajar.php');
    }
}

if ($act == 'update') {
    $idMengajar = $_POST['id'];
    $idDosen = $_POST['idDosen'];
    $idMataKuliah = $_POST['idMataKuliah'];
    $hari = $_POST['hari'];
    $jamMulai = $_POST['jamMulai'];
    $jamSelesai = $_POST['jamSelesai'];
    
    try {
        $req = new MengajarEntity();
        $req->id = $idMengajar;
        $req->idDosen = $idDosen;
        $req->idMataKuliah = $idMataKuliah;
        $req->hari = $hari;
        $req->jamMulai = $jamMulai;
        $req->jamSelesai = $jamSelesai;

        if ($idDosen == "") {
            $req->idDosen = null;
        }
        if ($idMataKuliah == "") {
            $req->idMataKuliah = null;
        }
        
        $mengajarService->update($req);
        $msg = "Mengajar berhasil duiubah";
        setcookie('success', $msg, time() + 5);
        header('Location: Mengajar.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mengajar.php');
    }
}
