<?php

namespace Modules\Prodi\Service;

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Prodi\Repository\ProdiRepository;
use Modules\Exception\ValidationException;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Mahasiswa\Repository\MahasiswaRepository;
use Modules\Prodi\Entity\ProdiEntity;
use Modules\Prodi\Entity\ProdiEntityDetails;

class ProdiService
{
    private MahasiswaRepository $mahasiswaRepository;
    private ProdiRepository $prodiRepository;
    private DosenRepository $dosenRepository;
    private JurusanRepository $jurusanRepository;
    
    public function __construct(
        ProdiRepository $prodiRepository,
        MahasiswaRepository $mahasiswaRepository,
        DosenRepository $dosenRepository,
        JurusanRepository $jurusanRepository,
    ) {
        $this->prodiRepository = $prodiRepository;
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->dosenRepository = $dosenRepository;
        $this->jurusanRepository = $jurusanRepository;
    }

    public function totalMahasiswaInProdiId(int $id) {
        return $this->mahasiswaRepository->totalMahasiswaInProdiId($id);
    }

    public function listProdiInJurusan($prodiID) {
        return $this->prodiRepository->prodiInJurusan($prodiID);
    }

    public function create(ProdiEntity $req): ProdiEntity
    {
        try {
            Database::beginTransaction();

            $this->prodiRepository->save($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(ProdiEntity $req): ProdiEntity    
    {
        try {
            Database::beginTransaction();

            $this->prodiRepository->update($req);
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
            $jurusan = $this->prodiRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id Prodi tidak ada");
            }

            $this->prodiRepository->delete($id);

            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $listProdi = $this->prodiRepository->findAll();
        $mahasiswaDetails = [];
        foreach ($listProdi as $prodi) {
            $m = new ProdiEntityDetails(
                $prodi,
                $this->dosenRepository->findById($prodi->idKaprodi),
                $this->jurusanRepository->findById($prodi->idJurusan),
            );
            array_push($mahasiswaDetails, $m);
        }
        return $mahasiswaDetails;
    }

    public function findById($id): ?ProdiEntityDetails
    {
        try {
            Database::beginTransaction();
            $prodi = $this->prodiRepository->findById($id);
            if ($prodi == null) {
                throw new ValidationException("id Prodi tidak ada");
            }

            $prodiDetails = new ProdiEntityDetails(
                $prodi,
                $this->dosenRepository->findById($prodi->idKaprodi),
                $this->jurusanRepository->findById($prodi->idJurusan),
            );

            Database::commitTransaction();
            return $prodiDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
