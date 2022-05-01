<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Jurusan</h1>

        <?php
        $id = $_GET['id'];
        $dataJurusan = $jurusanService->findById($id);
        $dataFakultas = $fakultasService->findAll();
        $dataDosen = $dosenService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="JurusanProsesData.php?act=update" method="POST">
                <div class="mb-4">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama Jurusan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama Fakultas" value="<?= $dataJurusan->nama ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kajur">
                        Kepala Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kajur" name="kajur" required>
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
                        <option value="A" <?php if ($dataJurusan->akreditasi == 'A') echo 'selected'; ?>>A</option>
                        <option value="B" <?php if ($dataJurusan->akreditasi == 'B') echo 'selected'; ?>>B</option>
                        <option value="C" <?php if ($dataJurusan->akreditasi == 'C') echo 'selected'; ?>>C</option>
                        <option value="D" <?php if ($dataJurusan->akreditasi == 'D') echo 'selected'; ?>>D</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenjang">
                        Jenjang
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenjang" name="jenjang" required>
                        <option value="S1" <?php if ($dataJurusan->jenjang == 'S1') echo 'selected'; ?>>S1</option>
                        <option value="S2" <?php if ($dataJurusan->jenjang == 'S2') echo 'selected'; ?>>S2</option>
                        <option value="S3" <?php if ($dataJurusan->jenjang == 'S3') echo 'selected'; ?>>S3</option>
                        <option value="D2" <?php if ($dataJurusan->jenjang == 'D2') echo 'selected'; ?>>D2</option>
                        <option value="D3" <?php if ($dataJurusan->jenjang == 'D3') echo 'selected'; ?>>D3</option>
                        <option value="D4" <?php if ($dataJurusan->jenjang == 'D4') echo 'selected'; ?>>D4</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fakultas">
                        Fakultas
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fakultas" name="idFakultas">
                        <?php foreach ($dataFakultas as $fakultas) : ?>
                            <option value="<?= $fakultas->id; ?>" <?php if ($dataJurusan->fakultas->id == $fakultas->id) echo 'selected'; ?>><?= $fakultas->nama; ?></option>
                        <?php endforeach; ?>
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