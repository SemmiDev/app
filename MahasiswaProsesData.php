<?php

namespace App\MahasiswaProses;

use Modules\Mahasiswa\Entity\MahasiswaEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'create') {
    $nim = $_POST['nim'];
    $namaDepan = $_POST['namaDepan'];
    $namaBelakang = $_POST['namaBelakang'];
    $email = $_POST['email'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $agama = $_POST['agama'];
    $jenjang = $_POST['jenjang'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $noHP = $_POST['noHp'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $totalSks = $_POST['totalSks'];
    $semester = $_POST['semester'];
    $jurusanId = $_POST['jurusan'];
    $dosenId = $_POST['dosen'];

    $req = new MahasiswaEntity();
    $req->nim = $nim;
    $req->namaDepan = $namaDepan;
    $req->namaBelakang = $namaBelakang;
    $req->email = $email;
    $req->jenisKelamin = $jenisKelamin;
    $req->agama = $agama;
    $req->jenjang = $jenjang;
    $req->tanggalLahir = $tanggalLahir;
    $req->noHP = $noHP;
    $req->alamat = $alamat;
    $req->status = $status;
    $req->totalSKS = $totalSks;
    $req->semester = $semester;
    $req->idJurusan = $jurusanId;
    $req->idProdi = null;
    
    if ($dosenId == "") {
        $req->idDosenPA = null;
    }

    try {
        $mahasiswaService->create($req);
        $msg = "Mahasiswa berhasil ditambahkan";
        setcookie('success', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    }
}

if ($act == 'delete') {
    $id = $_GET['id'];

    try {
        $mahasiswaService->delete($id);
        $msg = "Mahasiswa berhasil dihapus";
        setcookie('success', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menghapus data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    }
}

if ($act == 'update-prodi') {
    $id = $_POST['id'];
    $prodi = $_POST['prodi'];

    $mahasiswaService->updateProdi($id, $prodi);
    $msg = "Prodi berhasil diubah";
    setcookie('success', $msg, time() + 5);
    header('Location: Mahasiswa.php');
}

if ($act == 'update') {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $namaDepan = $_POST['namaDepan'];
    $namaBelakang = $_POST['namaBelakang'];
    $email = $_POST['email'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $agama = $_POST['agama'];
    $jenjang = $_POST['jenjang'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $noHP = $_POST['noHp'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $totalSks = $_POST['totalSks'];
    $semester = $_POST['semester'];
    $jurusanId = $_POST['jurusan'];
    $dosenId = $_POST['dosen'];
    $req->idProdi = null;

    try {
        $req = new MahasiswaEntity();
        $req->id = $id;
        $req->nim = $nim;
        $req->namaDepan = $namaDepan;
        $req->namaBelakang = $namaBelakang;
        $req->email = $email;
        $req->jenisKelamin = $jenisKelamin;
        $req->agama = $agama;
        $req->jenjang = $jenjang;
        $req->tanggalLahir = $tanggalLahir;
        $req->noHP = $noHP;
        $req->alamat = $alamat;
        $req->status = $status;
        $req->totalSKS = $totalSks;
        $req->semester = $semester;
        $req->idJurusan = $jurusanId;
        $req->idDosenPA = $dosenId;

        $mahasiswaService->update($req);
        $msg = "Mahasiswa berhasil di update";
        setcookie('success', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    } catch (\Exception $exception) {
        $msg = "Gagal update data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: Mahasiswa.php');
    }
}

