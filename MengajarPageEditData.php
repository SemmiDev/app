<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>


<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Mengajar</h1>

        <?php
        $id = $_GET['id'];
        $dataMengajar = $mengajarService->findById($id);
        $dataDosen = $dosenService->findAll();
        $dataMataKuliah = $mataKuliahService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="MengajarProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="idDosen">
                        Dosen
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="idDosen" name="idDosen">
                        <?php foreach ($dataDosen as $dosen) : ?>
                            <option value="<?= $dosen->id; ?>" <?= $dosen->id == $dataMengajar->idDosen ? 'selected' : ''; ?>>
                                <?= $dosen->namaDepan . ' ' . $dosen->namaBelakang; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="idMataKuliah">
                        Mata Kuliah
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="idMataKuliah" name="idMataKuliah">
                        <?php foreach ($dataMataKuliah as $mataKuliah) : ?>
                            <option value="<?= $mataKuliah->id; ?>" <?= $mataKuliah->id == $dataMengajar->idMataKuliah ? 'selected' : ''; ?>>
                                <?= $mataKuliah->nama; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="hari">
                        Hari
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hari" name="hari">
                        <option value="Senin" <?= $dataMengajar->hari == 'Senin' ? 'selected' : ''; ?>>Senin</option>
                        <option value="Selasa" <?= $dataMengajar->hari == 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
                        <option value="Rabu" <?= $dataMengajar->hari == 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
                        <option value="Kamis" <?= $dataMengajar->hari == 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
                        <option value="Jumat" <?= $dataMengajar->hari == 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jamMulai">
                        Jam Mulai
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jamMulai" name="jamMulai" type="time" placeholder="Masukkan Jam Mulai" value="<?= $dataMengajar->jamMulai ?>">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jamSelesai">
                        Jam Selesai
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jamSelesai" name="jamSelesai" type="time" placeholder="Masukkan Jam Selesai" value="<?= $dataMengajar->jamSelesai ?>">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Edit
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>