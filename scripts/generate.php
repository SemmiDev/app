<?php

function generateEmail($namaDepan, $namaBelakang, $nim, $kind)
{
    $namaDepan = strtolower($namaDepan);
    $namaBelakang = strtolower($namaBelakang);

    if (strpos($namaBelakang, " ") !== false) {
        $namaBelakang = explode(" ", $namaBelakang);
        $namaBelakang = $namaBelakang[0];
    }

    $last4 = substr($nim, -4);

    if ($kind == 'student') {
        return $namaDepan . '.' . $namaBelakang  . $last4 . '@student.unri.ac.id';
    }else if ($kind == 'lecturer') {
        return $namaDepan . '.' . $namaBelakang  . $last4 . '@lecturer.unri.ac.id';
    }else if ($kind == 'admin') {
        return $namaDepan . '.' . $namaBelakang  . $last4 . '@admin.unri.ac.id';
    }
}