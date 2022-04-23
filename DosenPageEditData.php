<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Dosen</h1>

        <?php
        require_once './App.php';
        $id = $_GET['id'];
        $dataDosen = $dosenService->findById($id);
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="DosenProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?php echo $dataDosen->id; ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nip">
                        NIP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nip" name="nip" type="text" placeholder="Masukkan NIP" value="<?= $dataDosen->nip ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaDepan">
                        Nama Depan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaDepan" name="namaDepan" type="text" placeholder="Masukkan Nama Depan" value="<?= $dataDosen->namaDepan ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaBelakang">
                        Nama Belakang
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaBelakang" name="namaBelakang" type="text" placeholder="Masukkan Nama Belakang" value="<?= $dataDosen->namaBelakang ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="golongan">
                        Golongan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="golongan" name="golongan" required>
                        <option value="Golongan I A" <?= $dataDosen->golonganPNS == 'Golongan I A' ? 'selected' : '' ?>>Golongan I A</option>
                        <option value="Golongan I B" <?= $dataDosen->golonganPNS == 'Golongan I B' ? 'selected' : '' ?>>Golongan I B</option>
                        <option value="Golongan I C" <?= $dataDosen->golonganPNS == 'Golongan I C' ? 'selected' : '' ?>>Golongan I C</option>
                        <option value="Golongan I D" <?= $dataDosen->golonganPNS == 'Golongan I D' ? 'selected' : '' ?>>Golongan I D</option>
                        <option value="Golongan II A" <?= $dataDosen->golonganPNS == 'Golongan II A' ? 'selected' : '' ?>>Golongan II A</option>
                        <option value="Golongan II B" <?= $dataDosen->golonganPNS == 'Golongan II B' ? 'selected' : '' ?>>Golongan II B</option>
                        <option value="Golongan II C" <?= $dataDosen->golonganPNS == 'Golongan II C' ? 'selected' : '' ?>>Golongan II C</option>
                        <option value="Golongan II D" <?= $dataDosen->golonganPNS == 'Golongan II D' ? 'selected' : '' ?>>Golongan II D</option>
                        <option value="Golongan III A" <?= $dataDosen->golonganPNS == 'Golongan III A' ? 'selected' : '' ?>>Golongan III A</option>
                        <option value="Golongan III B" <?= $dataDosen->golonganPNS == 'Golongan III B' ? 'selected' : '' ?>>Golongan III B</option>
                        <option value="Golongan III C" <?= $dataDosen->golonganPNS == 'Golongan III C' ? 'selected' : '' ?>>Golongan III C</option>
                        <option value="Golongan III D" <?= $dataDosen->golonganPNS == 'Golongan III D' ? 'selected' : '' ?>>Golongan III D</option>
                        <option value="Golongan IV A" <?= $dataDosen->golonganPNS == 'Golongan IV A' ? 'selected' : '' ?>>Golongan IV A</option>
                        <option value="Golongan IV B" <?= $dataDosen->golonganPNS == 'Golongan IV B' ? 'selected' : '' ?>>Golongan IV B</option>
                        <option value="Golongan IV C" <?= $dataDosen->golonganPNS == 'Golongan IV C' ? 'selected' : '' ?>>Golongan IV C</option>
                        <option value="Golongan IV D" <?= $dataDosen->golonganPNS == 'Golongan IV D' ? 'selected' : '' ?>>Golongan IV D</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
                        <option value="Kontrak" <?= $dataDosen->status == 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
                        <option value="Honorer" <?= $dataDosen->status == 'Honorer' ? 'selected' : '' ?>>Honorer</option>
                        <option value="Tetap" <?= $dataDosen->status == 'Tetap' ? 'selected' : '' ?>>Tetap</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Masukkan Email" value="<?= $dataDosen->email ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenisKelamin">
                        Jenis Kelamin
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="Pria" <?= $dataDosen->jenisKelamin == 'Pria' ? 'selected' : '' ?>>Pria</option>
                        <option value="Wanita" <?= $dataDosen->jenisKelamin == 'Wanita' ? 'selected' : '' ?>>Wanita</option>    
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noTelp">
                        No Telp
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noTelp" name="noTelp" type="text" placeholder="Masukkan No Telp" value="<?= $dataDosen->noTelp ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noHP">
                        No HP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noHP" name="noHP" type="text" placeholder="Masukkan No HP" value="<?= $dataDosen->noHP ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                        Alamat
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Masukkan Alamat" value="<?= $dataDosen->alamat ?>" required>
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