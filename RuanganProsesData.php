<?php

namespace App\RuanganProses;

require_once './App.php';

use Modules\Ruangan\Entity\RuanganEntity;

$act = $_GET['act'];

if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $ruanganService->delete($id);
        $msg = "Ruangan berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Ruangan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Ruangan.php');
    }
}

if ($act == 'create') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $kapasitas = $_POST['kapasitas'];
    $lantai = $_POST['lantai'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    try {
        $req = new RuanganEntity();
        $req->nama = $nama;
        $req->jenis = $jenis;
        $req->kapasitas = $kapasitas;
        $req->lantai = $lantai;
        $req->latitude = $latitude;
        $req->longitude = $longitude;

        $ruanganService->create($req);
        $msg = "Ruangan berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Ruangan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Ruangan.php');
    }
}


if ($act == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $kapasitas = $_POST['kapasitas'];
    $lantai = $_POST['lantai'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $req = new RuanganEntity();
    $req->id = $id;
    $req->nama = $nama;
    $req->jenis = $jenis;
    $req->kapasitas = $kapasitas;
    $req->lantai = $lantai;
    $req->latitude = $latitude;
    $req->longitude = $longitude;

    try {
        $ruanganService->update($req);
        $msg = "Ruangan berhasil di update";
        setcookie('success', $msg, time() + 5);
        header('Location: Ruangan.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Ruangan.php');
    }
}
