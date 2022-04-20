<?php

use Config\Database;

require_once __DIR__ . '/Config/Database.php';
require_once __DIR__ . '/Modules/Exception/ValidationException.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasEntity.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasRepository.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasService.php';

use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Fakultas\Service\FakultasService;

$fakultasRepository = new FakultasRepository(Database::getConnection());
$fakultasService = new FakultasService($fakultasRepository);