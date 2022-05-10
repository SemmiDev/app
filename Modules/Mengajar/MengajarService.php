<?php

namespace Modules\Mengajar\Service;

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Exception\ValidationException;
use Modules\MataKuliah\Repository\MataKuliahRepository;
use Modules\Mengajar\Entity\MengajarEntity;
use Modules\Mengajar\Entity\MengajarEntityDetails;
use Modules\Mengajar\Repository\MengajarRepository;

class MengajarService
{
    private MengajarRepository $mengajarRepository;
    private DosenRepository $dosenRepository;
    private MataKuliahRepository $mataKuliahRepository;

    public function __construct(
        MengajarRepository $mengajarRepository,
        DosenRepository $dosenRepository,
        MataKuliahRepository $mataKuliahRepository)
    {
        $this->mengajarRepository = $mengajarRepository;
        $this->dosenRepository = $dosenRepository;
        $this->mataKuliahRepository = $mataKuliahRepository;
    }

    public function create(MengajarEntity $req): MengajarEntity
    {
        try {
            Database::beginTransaction();
            $this->mengajarRepository->save($req);

            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(MengajarEntity $req): MengajarEntity
    {
        try {
            Database::beginTransaction();
            $this->mengajarRepository->update($req);
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
            $mengajar = $this->mengajarRepository->findById($id);
            if ($mengajar == null) {
                throw new ValidationException("id Mengajar tidak ada");
            }
            $this->mengajarRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $dataMengajar =  $this->mengajarRepository->findAll();
        $dataMengajarDetails = [];
        foreach ($dataMengajar as $mengajar) {
            $dataMengajarDetails[] = new MengajarEntityDetails($mengajar, 
            $this->dosenRepository->findById($mengajar->idDosen),
            $this->mataKuliahRepository->findById($mengajar->idMataKuliah));
        }
        return $dataMengajarDetails;
    }

    public function findById($id): ? MengajarEntityDetails
    {
        try {
            Database::beginTransaction();
            $mengajar = $this->mengajarRepository->findById($id);
            if ($mengajar == null) {
                throw new ValidationException("id Mengajar tidak ada");
            }

            $dataMengajarDetails = new MengajarEntityDetails($mengajar, 
            $this->dosenRepository->findById($mengajar->idDosen),
            $this->mataKuliahRepository->findById($mengajar->idMataKuliah));

            Database::commitTransaction();
            return $dataMengajarDetails;    
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}