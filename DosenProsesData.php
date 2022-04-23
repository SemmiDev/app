<?php

namespace App\DosenProses;

use Modules\Dosen\Entity\DosenEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'create') {
    $nip = $_POST['nip'];
    $namaDepan = $_POST['namaDepan'];
    $namaBelakang = $_POST['namaBelakang'];
    $golonganPNS = $_POST['golongan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $noTelp = $_POST['noTelp'];
    $noHP = $_POST['noHP'];
    $status = $_POST['status'];
    $jenisKelamin = $_POST['jenisKelamin'];

    $req = new DosenEntity();
    $req->nip = $nip;
    $req->namaDepan = $namaDepan;
    $req->namaBelakang = $namaBelakang;
    $req->golonganPNS = $golonganPNS;
    $req->alamat = $alamat;
    $req->email = $email;
    $req->noTelp = $noTelp;
    $req->noHP = $noHP;
    $req->status = $status;
    $req->jenisKelamin = $jenisKelamin;

    try {
        $dosenService->create($req);
        $msg = "Dosen berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Dosen.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Dosen.php');
    }
}

if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $dosenService->delete($id);
        $msg = "Dosen berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Dosen.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Dosen.php');
    }
}

if ($act == 'update') {
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $namaDepan = $_POST['namaDepan'];
    $namaBelakang = $_POST['namaBelakang'];
    $golonganPNS = $_POST['golongan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $noTelp = $_POST['noTelp'];
    $noHP = $_POST['noHP'];
    $status = $_POST['status'];
    $jenisKelamin = $_POST['jenisKelamin'];

    $req = new DosenEntity();
    $req->id = $id;
    $req->nip = $nip;
    $req->namaDepan = $namaDepan;
    $req->namaBelakang = $namaBelakang;
    $req->golonganPNS = $golonganPNS;
    $req->alamat = $alamat;
    $req->email = $email;
    $req->noTelp = $noTelp;
    $req->noHP = $noHP;
    $req->status = $status;
    $req->jenisKelamin = $jenisKelamin;

    try {
        $dosenService->update($req);
        $msg = "Dosen berhasil di update";
        setcookie('success', $msg, time() + 5);
        header('Location: Dosen.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Dosen.php');
    }
}
