<?php

namespace Modules\MataKuliah\Service;

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Exception\ValidationException;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\MataKuliah\Entity\MataKuliahEntity;
use Modules\MataKuliah\Entity\MataKuliahEntityDetails;
use Modules\MataKuliah\Repository\MataKuliahRepository;

class MataKuliahService
{
    private MataKuliahRepository $mataKuliahRepository;
    private DosenRepository $dosenRepository;
    private JurusanRepository $jurusanRepository;

    public function __construct(
        MataKuliahRepository $mataKuliahRepository,
        DosenRepository $dosenRepository,
        JurusanRepository $jurusanRepository
    ) {
        $this->mataKuliahRepository = $mataKuliahRepository;
        $this->dosenRepository = $dosenRepository;
        $this->jurusanRepository = $jurusanRepository;
    }

    public function totalMahasiswaInMataKuliahId($id)
    {
        $total = $this->mataKuliahRepository->totalMahasiswaInMataKuliahId($id);
        return $total;
    }

    public function dosenPengajar($matkulId)
    {
        $dosenPengajar = $this->mataKuliahRepository->findDosenPengajar($matkulId);
        $listDosenPengajar = [];
        foreach ($dosenPengajar as $dosen) {
            array_push($listDosenPengajar, $this->dosenRepository->findById($dosen['id_dosen']));
        }
        return $listDosenPengajar;
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

    public function findAll()
    {
        $mataKuliah = $this->mataKuliahRepository->findAll();
        $listMataKuliah = [];
        foreach ($mataKuliah as $matkul) {
            $detail = new MataKuliahEntityDetails(
            $matkul,
            $this->dosenRepository->findById($matkul->idDosenPengampu),
            $this->jurusanRepository->findById($matkul->idJurusan));
            array_push($listMataKuliah, $detail);
        }
        return $listMataKuliah;
    }

    public function findById($id): ?MataKuliahEntity
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
