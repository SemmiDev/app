<?php

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Dosen\Service\DosenService;

require_once __DIR__ . '/Config/Database.php';

require_once __DIR__ . '/Modules/Exception/ValidationException.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasEntity.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasRepository.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasService.php';

require_once __DIR__ . '/Modules/Jurusan/JurusanEntity.php';
require_once __DIR__ . '/Modules/Jurusan/JurusanRepository.php';
require_once __DIR__ . '/Modules/Jurusan/JurusanService.php';

require_once __DIR__ . '/Modules/Dosen/DosenEntity.php';
require_once __DIR__ . '/Modules/Dosen/DosenRepository.php';
require_once __DIR__ . '/Modules/Dosen/DosenService.php';

use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Fakultas\Service\FakultasService;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Jurusan\Service\JurusanService;

$fakultasRepository = new FakultasRepository(Database::getConnection());
$jurusanRepository = new JurusanRepository(Database::getConnection());
$dosenRepository = new DosenRepository(Database::getConnection());

$fakultasService = new FakultasService($fakultasRepository, $jurusanRepository);
$jurusanService = new JurusanService($jurusanRepository, $fakultasRepository);
$dosenService = new DosenService($dosenRepository);