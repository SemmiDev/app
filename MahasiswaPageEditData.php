<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Mahasiswa</h1>

        <?php 
        require_once './App.php';
            $id = $_GET['id'];
            $dataMahasiswa = $mahasiswaService->findById($id);
            $dataJurusan = $jurusanService->findAll();
            $dataDosen = $dosenService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="MahasiswaProsesData.php?act=update" method="POST">
                <div class="mb-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nim">
                        NIM
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nim" name="nim" type="text" placeholder="Masukkan NIM" value="<?= $dataMahasiswa->nim ?>" disabled>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaDepan">
                        Nama Depan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaDepan" name="namaDepan" type="text" placeholder="Masukkan Nama Depan" value="<?= $dataMahasiswa->namaDepan ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaBelakang">
                        Nama Belakang
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaBelakang" name="namaBelakang" type="text" placeholder="Masukkan Nama Belakang" value="<?= $dataMahasiswa->namaBelakang ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Masukkan Email" value="<?= $dataMahasiswa->email ?>" disabled>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="angkatan">
                        Angkatan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="angkatan" name="angkatan" type="number" placeholder="Angkatan" value="<?= $dataMahasiswa->angkatan ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jalur_masuk">
                        Jalur Masuk
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jalur_masuk" name="jalur_masuk" required>
                        <option value="<?= $dataMahasiswa->jalurMasuk ?>"><?= $dataMahasiswa->jalurMasuk ?></option>
                        <option value="SBMPTN">SBMPTN</option>
                        <option value="SNMPTN">SNMPTN</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="PBUD">PBUD</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenisKelamin">
                        Jenis Kelamin
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="Pria" <?php if($dataMahasiswa->jenisKelamin == 'Pria') echo 'selected'; ?>>Pria</option>
                        <option value="Wanita" <?php if($dataMahasiswa->jenisKelamin == 'Wanita') echo 'selected'; ?>>Wanita</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="agama">
                        Agama
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="agama" name="agama" required>
                        <option value="Islam" <?php if($dataMahasiswa->agama == 'Islam') echo 'selected'; ?>>Islam</option>
                        <option value="Kristen" <?php if($dataMahasiswa->agama == 'Kristen') echo 'selected'; ?>>Kristen</option>
                        <option value="Katolik" <?php if($dataMahasiswa->agama == 'Katolik') echo 'selected'; ?>>Katolik</option>
                        <option value="Hindu" <?php if($dataMahasiswa->agama == 'Hindu') echo 'selected'; ?>>Hindu</option>
                        <option value="Budha" <?php if($dataMahasiswa->agama == 'Budha') echo 'selected'; ?>>Budha</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenjang">
                        Jenjang
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenjang" name="jenjang" required>
                        <option value="S1" <?php if($dataMahasiswa->jenjang == 'S1') echo 'selected'; ?>>S1</option>
                        <option value="S2" <?php if($dataMahasiswa->jenjang == 'S2') echo 'selected'; ?>>S2</option>
                        <option value="S3" <?php if($dataMahasiswa->jenjang == 'S3') echo 'selected'; ?>>S3</option>
                        <option value="D2" <?php if($dataMahasiswa->jenjang == 'D2') echo 'selected'; ?>>D2</option>
                        <option value="D3" <?php if($dataMahasiswa->jenjang == 'D3') echo 'selected'; ?>>D3</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggalLahir">
                        Tanggal Lahir
                    </label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tanggalLahir" name="tanggalLahir" value="<?= $dataMahasiswa->tanggalLahir ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noHp">
                        No HP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noHp" name="noHp" type="text" placeholder="Masukkan No HP" value="<?= $dataMahasiswa->noHP ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                        Alamat
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Masukkan Alamat" required>
                    <?= trim($dataMahasiswa->alamat) ?>
                    </textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
                        <option value="Aktif" <?php if($dataMahasiswa->status == 'Aktif') echo 'selected'; ?>>Aktif</option>
                        <option value="Tidak Aktif" <?php if($dataMahasiswa->status == 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                        <option value="Cuti Akademik" <?php if($dataMahasiswa->status == 'Cuti Akademik') echo 'selected'; ?>>Cuti Akademik</option>
                        <option value="Skorsing" <?php if($dataMahasiswa->status == 'Skorsing') echo 'selected'; ?>>Skorsing</option>
                        <option value="Drop Out" <?php if($dataMahasiswa->status == 'Drop Out') echo 'selected'; ?>>Drop Out</option>
                        <option value="Passing Out" <?php if($dataMahasiswa->status == 'Passing Out') echo 'selected'; ?>>Passing Out</option>
                        <option value="Non Aktif" <?php if($dataMahasiswa->status == 'Non Aktif') echo 'selected'; ?>>Non Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="totalSks">
                        Total SKS
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="totalSks" name="totalSks" type="number" placeholder="Masukkan Total SKS" value="<?= $dataMahasiswa->totalSKS ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                        Semester
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="semester" name="semester" type="number" placeholder="Masukkan Semester" value="<?= $dataMahasiswa->semester ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jurusan">
                        Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jurusan" name="jurusan" required>
                    <?php foreach ($dataJurusan as $j) : ?>
                        <option value="<?= $j->id; ?>" <?php if ($j->id == $dataMahasiswa->jurusan->id) echo 'selected'; ?>><?= $j->nama; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dosen">
                        Dosen PA
                    </label> 
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dosen" name="dosen">
                    <?php foreach ($dataDosen as $d) : ?>
                        <option value="<?= $d->id ?>" <?php if ($d->id == $dataMahasiswa->dosen->id) echo 'selected'; ?>><?= $d->namaDepan . ' ' . $d->namaBelakang ?></option>
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