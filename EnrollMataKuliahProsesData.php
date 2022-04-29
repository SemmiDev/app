<?php

namespace App\EnrollMataKuliahProses;

use Modules\EnrollMataKuliah\Entity\EnrollMataKuliahEntity;

require_once './App.php';

$act = $_GET['act'];

if ($act == 'create') {
    $idMhs = $_POST['id_mahasiswa'];
    $idMatkul = $_POST['id_mata_kuliah'];
    $semester = $_POST['semester'];
    $nilai = $_POST['nilai'];

    try {
        $req = new EnrollMataKuliahEntity();
        $req->idMahasiswa = $idMhs;
        $req->idMataKuliah = $idMatkul;
        $req->semester = $semester;
        $req->nilai = $nilai;

        $enrollMataKuliahService->create($req);
        $msg = "Mata Kuliah berhasil di enroll";
        setcookie('success', $msg, time() + 5);
        header('Location: EnrollMataKuliah.php');
    } catch (\Exception $exception) {
        $msg = "Gagal menambahkan data $exception";
        setcookie('error', $msg, time() + 5);
        header('Location: EnrollMataKuliah.php');
    }
}