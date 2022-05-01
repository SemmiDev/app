<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Mata Kuliah</h1>

        <?php
        $id = $_GET['id'];
        $dataMataKuliah = $mataKuliahService->findById($id);
        $dataJurusan = $jurusanService->findAll();
        $dataDosen = $dosenService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="MataKuliahProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_mata_kuliah">
                        Nama Mata Kuliah
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_mata_kuliah" name="nama_mata_kuliah" type="text" placeholder="Masukkan Nama Mata Kuliah" value="<?= $dataMataKuliah->nama ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kode_mata_kuliah">
                        Kode Mata Kuliah
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kode_mata_kuliah" name="kode_mata_kuliah" type="text" placeholder="Masukkan Kode Mata Kuliah" value="<?= $dataMataKuliah->kode ?>" required>
                    <button class="bg-pink-500 hover:bg-pink-700 text-white text-sm font-semibold py-2 px-3 mt-2 rounded focus:outline-none focus:shadow-outline" type="button" onclick="document.getElementById('kode_mata_kuliah').value = generateCode(10)">Generate</button>
                    <script>
                        function generateCode(n = 4) {
                            var text = "";
                            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                            for (var i = 0; i < n; i++)
                                text += possible.charAt(Math.floor(Math.random() * possible.length));
                            return text;
                        }
                    </script>
                
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="sks">
                        SKS
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sks" name="sks" type="number" placeholder="Masukkan SKS" value="<?= $dataMataKuliah->sks ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                        Semester
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <option value="1" <?php if ($dataMataKuliah->semester == 1) echo 'selected' ?>>1</option>
                        <option value="2" <?php if ($dataMataKuliah->semester == 2) echo 'selected' ?>>2</option>
                        <option value="3" <?php if ($dataMataKuliah->semester == 3) echo 'selected' ?>>3</option>
                        <option value="4" <?php if ($dataMataKuliah->semester == 4) echo 'selected' ?>>4</option>
                        <option value="5" <?php if ($dataMataKuliah->semester == 5) echo 'selected' ?>>5</option>
                        <option value="6" <?php if ($dataMataKuliah->semester == 6) echo 'selected' ?>>6</option>
                        <option value="7" <?php if ($dataMataKuliah->semester == 7) echo 'selected' ?>>7</option>
                        <option value="8" <?php if ($dataMataKuliah->semester == 8) echo 'selected' ?>>8</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dosen_pengampu">
                        Dosen Pengampu
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dosen_pengampu" name="dosen_pengampu" required>
                        <option value="">Pilih Dosen Pengampu</option>
                        <?php foreach ($dataDosen as $dosen) { ?>
                            <option value="<?= $dosen->id ?>" <?php if ($dataMataKuliah->idDosenPengampu == $dosen->id) echo 'selected' ?>><?= $dosen->namaDepan . ' ' . $dosen->namaBelakang ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jurusan">
                        Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jurusan" name="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <?php foreach ($dataJurusan as $jurusan) { ?>
                            <option value="<?= $jurusan->id ?>" <?php if ($dataMataKuliah->idJurusan == $jurusan->id) echo 'selected' ?>><?= $jurusan->nama ?></option>
                        <?php } ?>
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