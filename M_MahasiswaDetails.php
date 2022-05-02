<?php

require_once './App.php';
mustLogin();
mustFullAuthorizedInRoles("mahasiswa");
$current = $sessionService->current();
$dataMahasiswa = $mahasiswaRepository->findByEmail($current->email);
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
      <?php include('./Layouts/Navigation.php'); ?>
      <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
            <div class="table-responsive">
                  <table class="table-auto w-full font-semibold border-collapse">
                        <tr>
                              <td class="border p-3">Nama</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->namaDepan . " " . $dataMahasiswa->namaBelakang; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">NIM</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->nim; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Email</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->email; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Jenis Kelamin</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->jenisKelamin; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Agama</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->agama; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Jenjang</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->jenjang; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Tanggal Lahir</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->tanggalLahir; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">No HP</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->noHP; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Alamat</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->alamat; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Status</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->status; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Total SKS</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->totalSKS; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Semester</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->semester; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Angkatan</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->angkatan; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Jalur Masuk</td>
                              <td class="border p-3"><?php echo $dataMahasiswa->jalurMasuk; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Prodi</td>
                              <?php if (!is_null($dataMahasiswa->idProdi)) { ?>
                                    <td class><?= $prodiService->findById($dataMahasiswa->idProdi)->nama ?></td>
                              <?php } else { ?>
                                    <td class="border pl-2">
                                          <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                          </svg>
                                    </td>
                              <?php } ?>

                        </tr>
                        <tr>
                              <td class="border p-3">Jurusan</td>
                              <?php if (!is_null($dataMahasiswa->idJurusan)) { ?>
                                    <td class="border pl-2"><?= $jurusanService->findById($dataMahasiswa->idJurusan)->nama ?></td>
                              <?php } else { ?>
                                    <td class="border pl-2">
                                          <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                          </svg>
                                    </td>
                              <?php } ?>

                        </tr>
                        <tr>
                              <td class="border p-3">Dosen PA</td>
                              <?php if (!is_null($dataMahasiswa->idDosenPA)) { ?>
                                    <?php $dosenPA = $dosenService->findById($dataMahasiswa->idDosenPA) ?>
                                    <td class="border pl-2"> <?= $dosenPA->namaDepan . ' ' . $dosenPA->namaBelakang ?></td>
                              <?php } else { ?>
                                    <td class="border pl-2">
                                          <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                          </svg>
                                    </td>
                              <?php } ?>

                        </tr>
                  </table>
            </div>

      </main>
</div>
<?php include('./Layouts/Footer.php'); ?>