<?php

namespace Modules\EnrollMataKuliah\Service;

use Config\Database;
use Modules\EnrollMataKuliah\Entity\EnrollMataKuliahEntity;
use Modules\EnrollMataKuliah\Entity\EnrollMataKuliahEntityDetails;
use Modules\EnrollMataKuliah\Repository\EnrollMataKuliahRepository;
use Modules\Exception\ValidationException;
use Modules\Mahasiswa\Repository\MahasiswaRepository;
use Modules\MataKuliah\Repository\MataKuliahRepository;

class EnrollMataKuliahService
{
    private EnrollMataKuliahRepository $enrollMataKuliahRepository;
    private MahasiswaRepository $mahasiswaRepository;
    private MataKuliahRepository $mataKuliahRepository;

    public function __construct(EnrollMataKuliahRepository $enrollMataKuliahRepository,MahasiswaRepository $mahasiswaRepository,MataKuliahRepository $mataKuliahRepository)
    {
        $this->enrollMataKuliahRepository = $enrollMataKuliahRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->mataKuliahRepository = $mataKuliahRepository;
    }

    public function create(EnrollMataKuliahEntity $req): EnrollMataKuliahEntity
    {
        try {
            Database::beginTransaction();
            $this->enrollMataKuliahRepository->save($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(EnrollMataKuliahEntity $req): EnrollMataKuliahEntity
    {
        try {
            Database::beginTransaction();
            $this->enrollMataKuliahRepository->update($req);
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
            $enroll = $this->enrollMataKuliahRepository->findById($id);
            if ($enroll == null) {
                throw new ValidationException("id Enroll Mata Kuliah tidak ada");
            }

            $this->enrollMataKuliahRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $dataEnroll = $this->enrollMataKuliahRepository->findAll();
        $enrollDetails = [];
        foreach ($dataEnroll as $enroll) {
            $enrollDetails[] = new EnrollMataKuliahEntityDetails(
                $enroll, 
                $this->mahasiswaRepository->findById($enroll->idMahasiswa),
                $this->mataKuliahRepository->findById($enroll->idMataKuliah));
        }
        return $enrollDetails;
    }

    public function findById(int $id): ? EnrollMataKuliahEntityDetails
    {
        try {
            Database::beginTransaction();
            $enroll = $this->enrollMataKuliahRepository->findById($id);
            if ($enroll == null) {
                throw new ValidationException("id Enroll tidak ada");
            }

            $enrollDetails = new EnrollMataKuliahEntityDetails(
                $enroll, 
                $this->mahasiswaRepository->findById($enroll->idMahasiswa),
                $this->mataKuliahRepository->findById($enroll->idMataKuliah));

            Database::commitTransaction();
            return $enrollDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}