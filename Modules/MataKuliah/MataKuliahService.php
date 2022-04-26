<?php

namespace Modules\MataKuliah\Service;

use Config\Database;
use Modules\Dosen\Entity\DosenEntity;
use Modules\Exception\ValidationException;
use Modules\MataKuliah\Entity\MataKuliahEntity;
use Modules\MataKuliah\Repository\MataKuliahRepository;

class MataKuliahService
{
    private MataKuliahRepository $mataKuliahRepository;

    public function __construct(MataKuliahRepository $mataKuliahRepository)
    {
        $this->mataKuliahRepository = $mataKuliahRepository;
    }

    public function totalMahasiswaInMataKuliahId($id) 
    {
        return 1;
    }

    public function dosenPengajar($id) {
        $a = new DosenEntity();
        $a->namaDepan = "sam";
        $a->namaBelakang = "dev";

        $b = new DosenEntity();
        $b->namaDepan = "sam 2";
        $b->namaBelakang = "dev 2";


        return [$a,$b];
    }

    public function create(MataKuliahEntity $req): MataKuliahEntity
    {
        try {
            Database::beginTransaction();
            $this->mataKuliahRepository->save($req);

            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(MataKuliahEntity $req): MataKuliahEntity
    {
        try {
            Database::beginTransaction();
            $this->mataKuliahRepository->update($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function delete(int $id): void
    {
        try {
            Database::beginTransaction();
            $matkul = $this->mataKuliahRepository->findById($id);
            if ($matkul == null) {
                throw new ValidationException("id Mata Kuliah tidak ada");
            }
            $this->mataKuliahRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        return $this->mataKuliahRepository->findAll();
    }

    public function findById($id): ? MataKuliahEntity
    {
        try {
            Database::beginTransaction();
            $matkul = $this->mataKuliahRepository->findById($id);
            if ($matkul == null) {
                throw new ValidationException("id Mata Kuliah tidak ada");
            }
            Database::commitTransaction();
            return $matkul;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}