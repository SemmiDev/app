<?php

namespace App\MataKuliahProses;

use Modules\MataKuliah\Entity\MataKuliahEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'create') {
    $namaMatkul = $_POST['nama_mata_kuliah'];
    $kode = $_POST['kode_mata_kuliah'];
    $sks = $_POST['sks'];
    $semester = $_POST['semester'];
    $idDosenPengampu = $_POST['dosen_pengampu'];
    $idJurusan = $_POST['jurusan'];
    
    $req = new MataKuliahEntity();
    $req->nama = $namaMatkul;
    $req->kode = $kode;
    $req->sks = $sks;
    $req->semester = $semester;
    $req->idDosenPengampu = $idDosenPengampu;
    $req->idJurusan = $idJurusan;
    try {
        $mataKuliahService->create($req);
        $msg = "Mata Kuliah berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: MataKuliah.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: MataKuliah.php');
    }
}

if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $mataKuliahService->delete($id);
        $msg = "Mata Kuliah berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: MataKuliah.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: MataKuliah.php');
    }
}


if ($act == 'update') {
    $id = $_POST['id'];
    $namaMatkul = $_POST['nama_mata_kuliah'];
    $kode = $_POST['kode_mata_kuliah'];
    $sks = $_POST['sks'];
    $semester = $_POST['semester'];
    $idDosenPengampu = $_POST['dosen_pengampu'];
    $idJurusan = $_POST['jurusan'];
    
    $req = new MataKuliahEntity();
    $req->id = $id;
    $req->nama = $namaMatkul;
    $req->kode = $kode;
    $req->sks = $sks;
    $req->semester = $semester;
    $req->idDosenPengampu = $idDosenPengampu;
    $req->idJurusan = $idJurusan;
    try {
        $mataKuliahService->update($req);
        $msg = "Mata Kuliah berhasil di ubah";
        setcookie('success', $msg, time() + 5);
        header('Location: MataKuliah.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: MataKuliah.php');
    }
}