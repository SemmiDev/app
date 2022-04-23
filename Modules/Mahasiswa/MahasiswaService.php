<?php

namespace Modules\Mahasiswa\Service;

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Exception\ValidationException;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Mahasiswa\Entity\MahasiswaEntity;
use Modules\Mahasiswa\Entity\MahasiswaEntityDetails;
use Modules\Mahasiswa\Repository\MahasiswaRepository;

class MahasiswaService
{
    private MahasiswaRepository $mahasiswaRepository;
    private JurusanRepository $jurusanRepository;
    private DosenRepository $dosenRepository;

    public function __construct(
        MahasiswaRepository $mahasiswaRepository,
        JurusanRepository $jurusanRepository,
        DosenRepository $dosenRepository
    ) {
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->jurusanRepository = $jurusanRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function totalMahasiswaInJurusanId(int $id) {
        return $this->mahasiswaRepository->totalMahasiswaInJurusanId($id);
    }

    public function create(MahasiswaEntity $req): MahasiswaEntityDetails
    {
        try {
            Database::beginTransaction();

            $this->mahasiswaRepository->save($req);
            $mhsDetails = new MahasiswaEntityDetails(
                $req,
                $this->jurusanRepository->findById($req->idJurusan),
                $this->dosenRepository->findById($req->idDosenPA)
            );
        
            Database::commitTransaction();
            return $mhsDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(MahasiswaEntity $req): MahasiswaEntityDetails    
    {
        try {
            Database::beginTransaction();

            $this->mahasiswaRepository->update($req);
            $mhs = new MahasiswaEntityDetails(
                $req,
                $this->jurusanRepository->findById($req->idJurusan),
                $this->dosenRepository->findById($req->idDosenPA)
            );
            $mhs->id = $req->id;

            Database::commitTransaction();
            return $mhs;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function delete(int $id): void
    {
        try {
            Database::beginTransaction();
            $jurusan = $this->mahasiswaRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id mahasiswa tidak ada");
            }

            $this->mahasiswaRepository->delete($id);

            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $listMahasiswa = $this->mahasiswaRepository->findAll();
        $mahasiswaDetails = [];
        foreach ($listMahasiswa as $mhs) {
            $m = new MahasiswaEntityDetails(
                $mhs,
                $this->jurusanRepository->findById($mhs->idJurusan),
                $this->dosenRepository->findById($mhs->idDosenPA)
            );
            $m->id = $mhs->id;
            array_push($mahasiswaDetails, $m);
        }
        return $mahasiswaDetails;
    }

    public function findById(int $id): ?MahasiswaEntityDetails
    {
        try {
            Database::beginTransaction();
            $mhs = $this->mahasiswaRepository->findById($id);
            if ($mhs == null) {
                throw new ValidationException("id mahasiswa tidak ada");
            }

            $mhsDetails = new MahasiswaEntityDetails(
                $mhs,
                $this->jurusanRepository->findById($mhs->idJurusan),
                $this->dosenRepository->findById($mhs->idDosenPA)
            );

            Database::commitTransaction();
            return $mhsDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
