<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Tambah Data Enroll Mata Kuliah</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                <?php
                    require_once './App.php';
                    $dataMahasiswa = $mahasiswaService->findAll();
                    $dataMataKuliah = $mataKuliahRepository->findAll();
                ?>

            <form action="EnrollMataKuliahProsesData.php?act=create" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mahasiswa">
                        Mahasiswa
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mahasiswa" name="id_mahasiswa" required>
                        <option value="">Pilih Mahasiswa</option>
                        <?php foreach ($dataMahasiswa as $mahasiswa) : ?>
                            <option value="<?= $mahasiswa->id ?>"><?= $mahasiswa->nim . ' = ' . $mahasiswa->namaDepan . ' ' . $mahasiswa->namaBelakang?></option>
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
                            <option value="<?= $mataKuliah->id ?>"><?= $mataKuliah->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                        Semester
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <?php for ($i = 1; $i <= 12; $i++) : ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nilai">
                        Nilai
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nilai" name="nilai">
                        <option value="">Pilih Nilai</option>
                        <option value="E">E</option>
                        <option value="E-">E-</option>
                        <option value="E+">E+</option>
                        <option value="D">D</option>
                        <option value="D-">D-</option>
                        <option value="D+">D+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="C+">C+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="B+">B+</option>
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>