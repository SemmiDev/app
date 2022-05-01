<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>


<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Tambah Data Jurusan</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                <?php
                    $dataFakultas = $fakultasService->findAll();
                    $dataDosen = $dosenService->findAll();
                ?>

            <form action="JurusanProsesData.php?act=create" method="POST">
                <div class="mb-4">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama Jurusan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama Jurusan" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kajur">
                        Kepala Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kajur" name="id_kajur" required>
                        <option value="">Pilih Kepala Jurusan</option>
                        <?php foreach ($dataDosen as $dosen) : ?>
                            <option value="<?= $dosen->id ?>" <?= $dosen->id == $dataJurusan->idKajur ? 'selected' : '' ?>><?= $dosen->namaDepan . ' ' . $dosen->namaBelakang ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="akreditasi">
                        Akreditasi
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="akreditasi" name="akreditasi" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenjang">
                        Jenjang
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenjang" name="jenjang" required>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fakultas">
                        Fakultas
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fakultas" name="idFakultas" required>
                        <?php foreach ($dataFakultas as $fakultas) : ?>
                            <option value="<?= $fakultas->id ?>"><?= $fakultas->nama ?></option>
                        <?php endforeach; ?>
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