<?php

require './App.php';
mustLogin();
mustFullAuthorizedInRoles("dosen");
$current = $sessionService->current();
$dataDosen = $dosenRepository->findByEmail($current->email);
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
      <?php include('./Layouts/Navigation.php'); ?>
      <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
            <div class="table-responsive">
                  <table class="table-auto w-full font-semibold border-collapse">
                        <tr>
                              <td class="border p-3">Nama</td>
                              <td class="border p-3"><?php echo $dataDosen->namaDepan . " " . $dataDosen->namaBelakang; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">NIP</td>
                              <td class="border p-3"><?php echo $dataDosen->nip; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Email</td>
                              <td class="border p-3"><?php echo $dataDosen->email; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Jenis Kelamin</td>
                              <td class="border p-3"><?php echo $dataDosen->jenisKelamin; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">No HP</td>
                              <td class="border p-3"><?php echo $dataDosen->noHP; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">No Telp</td>
                              <td class="border p-3"><?php echo $dataDosen->noTelp; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Alamat</td>
                              <td class="border p-3"><?php echo $dataDosen->alamat; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Status</td>
                              <td class="border p-3"><?php echo $dataDosen->status; ?></td>
                        </tr>
                        <tr>
                              <td class="border p-3">Golongan PNS</td>
                              <td class="border p-3"><?php echo $dataDosen->golonganPNS; ?></td>
                        </tr>          
                  </table>
            </div>
      </main>
</div>
<?php include('./Layouts/Footer.php'); ?>