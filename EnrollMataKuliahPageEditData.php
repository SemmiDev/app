<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Enroll Mata Kuliah</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                <?php
                    $id = $_GET['id'];
                    $dataEnroll = $enrollMataKuliahService->findById($id);
                    $dataMahasiswa = $mahasiswaService->findAll();
                    $dataMataKuliah = $mataKuliahRepository->findAll();
                ?>

            <form action="EnrollMataKuliahProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mahasiswa">
                        Mahasiswa
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mahasiswa" name="id_mahasiswa" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php foreach ($dataMahasiswa as $mahasiswa) : ?>
                            <option value="<?= $mahasiswa->id ?>" <?= $mahasiswa->id == $dataEnroll->idMahasiswa ? 'selected' : '' ?>><?= $mahasiswa->namaDepan . ' ' . $mahasiswa->namaBelakang ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mataKuliah">
                        Mata Kuliah
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mataKuliah" name="id_mata_kuliah" required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($dataMataKuliah as $mataKuliah) : ?>
                            <option value="<?= $mataKuliah->id ?>" <?= $mataKuliah->id == $dataEnroll->idMataKuliah ? 'selected' : '' ?>><?= $mataKuliah->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                        Semester
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <option value="1" <?= $dataEnroll->semester == 1 ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= $dataEnroll->semester == 2 ? 'selected' : '' ?>>2</option>
                        <option value="3" <?= $dataEnroll->semester == 3 ? 'selected' : '' ?>>3</option>
                        <option value="4" <?= $dataEnroll->semester == 4 ? 'selected' : '' ?>>4</option>
                        <option value="5" <?= $dataEnroll->semester == 5 ? 'selected' : '' ?>>5</option>
                        <option value="6" <?= $dataEnroll->semester == 6 ? 'selected' : '' ?>>6</option>
                        <option value="7" <?= $dataEnroll->semester == 7 ? 'selected' : '' ?>>7</option>
                        <option value="8" <?= $dataEnroll->semester == 8 ? 'selected' : '' ?>>8</option>
                        <option value="9" <?= $dataEnroll->semester == 9 ? 'selected' : '' ?>>9</option>
                        <option value="10" <?= $dataEnroll->semester == 10 ? 'selected' : '' ?>>10</option>
                        <option value="11" <?= $dataEnroll->semester == 11 ? 'selected' : '' ?>>11</option>
                        <option value="12" <?= $dataEnroll->semester == 12 ? 'selected' : '' ?>>12</option>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nilai">
                        Nilai
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nilai" name="nilai">
                        <option value="">Pilih Nilai</option>
                        <option value="A" <?= $dataEnroll->nilai == 'A' ? 'selected' : '' ?>>A</option>
                        <option value="A-" <?= $dataEnroll->nilai == 'A-' ? 'selected' : '' ?>>A-</option>
                        <option value="B+" <?= $dataEnroll->nilai == 'B+' ? 'selected' : '' ?>>B+</option>
                        <option value="B" <?= $dataEnroll->nilai == 'B' ? 'selected' : '' ?>>B</option>
                        <option value="B-" <?= $dataEnroll->nilai == 'B-' ? 'selected' : '' ?>>B-</option>
                        <option value="C+" <?= $dataEnroll->nilai == 'C+' ? 'selected' : '' ?>>C+</option>
                        <option value="C" <?= $dataEnroll->nilai == 'C' ? 'selected' : '' ?>>C</option>
                        <option value="C-" <?= $dataEnroll->nilai == 'C-' ? 'selected' : '' ?>>C-</option>
                        <option value="D+" <?= $dataEnroll->nilai == 'D' ? 'selected' : '' ?>>D+</option>
                        <option value="D" <?= $dataEnroll->nilai == 'D' ? 'selected' : '' ?>>D</option>
                        <option value="D-" <?= $dataEnroll->nilai == 'D-' ? 'selected' : '' ?>>D-</option>
                        <option value="E" <?= $dataEnroll->nilai == 'E' ? 'selected' : '' ?>>E</option>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>