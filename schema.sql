DROP DATABASE IF EXISTS app;
CREATE DATABASE IF NOT EXISTS app;
USE app;

CREATE TABLE IF NOT EXISTS dosen (
    id_dosen INT(11) NOT NULL AUTO_INCREMENT,
    nip VARCHAR(10) UNIQUE NOT NULL,
    nama_depan VARCHAR(50) NOT NULL,
    nama_belakang VARCHAR(50),
    email VARCHAR(120) UNIQUE NOT NULL,
    jenis_kelamin VARCHAR(10) NOT NULL,
    no_telp VARCHAR(50) NOT NULL,
    no_hp VARCHAR(50) NOT NULL,
    golongan_pns VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    alamat VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_dosen)
);

INSERT INTO dosen (id_dosen, nip, nama_depan, nama_belakang, email, jenis_kelamin, no_telp, no_hp, golongan_pns, status, alamat) 
VALUES (1, '123456789', 'Dian', 'Surya', 'dian@gmail.com', 'Laki-Laki', '08123456789', '08123456789', 'Golongan 1', 'PNS', 'Jl. Jendral Sudirman No. 1');

INSERT INTO dosen (id_dosen, nip, nama_depan, nama_belakang, email, jenis_kelamin, no_telp, no_hp, golongan_pns, status, alamat) 
VALUES (2, '123456790', 'Sammi', 'Aldhi', 'sammi@gmail.com', 'Laki-Laki', '08133456789', '08123456789', 'Golongan 2', 'PNS', 'Jl. Jendral Sudirman No. 2');

INSERT INTO dosen (id_dosen, nip, nama_depan, nama_belakang, email, jenis_kelamin, no_telp, no_hp, golongan_pns, status, alamat) 
VALUES (3, '123456791', 'Hasyim', 'Asyari', 'hasyim@gmail.com', 'Laki-Laki', '08143456789', '08123456789', 'Golongan 3', 'PNS', 'Jl. Jendral Sudirman No. 3');

INSERT INTO dosen (id_dosen, nip, nama_depan, nama_belakang, email, jenis_kelamin, no_telp, no_hp, golongan_pns, status, alamat) 
VALUES (4, '123456792', 'Adi', 'Hidayat', 'adi@gmail.com', 'Laki-Laki', '08163456789', '08123456789', 'Golongan 4', 'PNS', 'Jl. Jendral Sudirman No. 4');

CREATE TABLE IF NOT EXISTS fakultas (
    id_fakultas INT(11) NOT NULL AUTO_INCREMENT,
    nama_fakultas VARCHAR(50) NOT NULL,
    id_dekan INT(11) DEFAULT NULL,
    id_wakil_dekan_1 INT(11),
    id_wakil_dekan_2 INT(11) DEFAULT NULL,
    id_wakil_dekan_3 INT(11) DEFAULT NULL,
    PRIMARY KEY (id_fakultas),
    FOREIGN KEY (id_dekan) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_wakil_dekan_1) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_wakil_dekan_2) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_wakil_dekan_3) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE
);

-- dummy data for fakultas
INSERT INTO fakultas VALUES (1, 'Fakultas Perikanan dan Ilmu Kelautan', 1, 2, 3, 4);
INSERT INTO fakultas VALUES (2, 'Fakultas Matematika dan Ilmu Pengetahuan Alam', 2, 1, 3, 4);
INSERT INTO fakultas VALUES (3, 'Fakultas Teknik', 4, 3, 2, 1);

CREATE TABLE IF NOT EXISTS jurusan (
    id_jurusan INT(11) NOT NULL AUTO_INCREMENT,
    nama_jurusan VARCHAR(50) NOT NULL,
    kode INT(5) NOT NULL,
    id_kajur INT(11) DEFAULT NULL,
    akreditasi VARCHAR(1) NOT NULL,
    jenjang VARCHAR(10) NOT NULL,
    id_fakultas INT(11) DEFAULT NULL,
    PRIMARY KEY (id_jurusan),
    FOREIGN KEY (id_fakultas) REFERENCES fakultas(id_fakultas) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_kajur) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE
);

-- dummy data for jurusan
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (1, 'Teknologi Hasil Perikanan', 'A','S1',1, 1);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (2, 'Ilmu Kelautan', 'A','S1', 1, 2);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (3, 'Budidaya Perairan', 'A','S1', 1, 3);

INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (4, 'Sistem Informasi', 'A','S1', 2, 4);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (5, 'Manajemen Informatika', 'A','D3', 2, 5);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (6, 'Fisika', 'A','S1', 2, 6);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (7, 'Kimia', 'A','S1', 2, 7);

INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (8, 'Teknik Sipil', 'A','S1', 3, 8);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (9, 'Teknik Elektro', 'A','S1', 3, 9);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas, kode) VALUES (10, 'Teknik Mesin', 'A','S1', 3, 10);

CREATE TABLE prodi (
    id_prodi INT(11) NOT NULL AUTO_INCREMENT,
    nama_prodi VARCHAR(50) NOT NULL,
    id_kaprodi INT(11) DEFAULT NULL,
    akreditasi VARCHAR(1) NOT NULL,
    id_jurusan INT(11) DEFAULT NULL,
    PRIMARY KEY (id_prodi),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_kaprodi) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO prodi (id_prodi, nama_prodi, akreditasi, id_jurusan) VALUES (1, 'Sistem Informasi', 'A', 1);
INSERT INTO prodi (id_prodi, nama_prodi, akreditasi, id_jurusan) VALUES (2, 'Manajemen Informatika', 'A', 1);

CREATE TABLE roles (
    id_role INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_role)
);

INSERT INTO roles(nama) VALUES ('mahasiswa'),('dosen'),('admin');

CREATE TABLE IF NOT EXISTS users (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_role INT(11) DEFAULT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_role) REFERENCES roles(id_role) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO users VALUES (1,'admin@admin.unri.ac.id', '$2y$10$o9O0.yM5fq3cZar4w8qMyOnOmzUSSp18rxTRC3Gw7aTLaP2G1zI/K',3);

CREATE TABLE IF NOT EXISTS mahasiswa (
    id_mahasiswa INT(11) NOT NULL AUTO_INCREMENT,
    nim VARCHAR(10) UNIQUE NOT NULL,
    nama_depan VARCHAR(50) NOT NULL,
    nama_belakang VARCHAR(50),
    email VARCHAR(120) UNIQUE NOT NULL,
    jenis_kelamin VARCHAR(10) NOT NULL,
    agama VARCHAR(50) NOT NULL,
    jenjang VARCHAR(50) NOT NULL,
    tanggal_lahir VARCHAR(10) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    status VARCHAR(50) NOT NULL,
    total_sks INT(11) NOT NULL,
    semester INT(2) NOT NULL,
    alamat VARCHAR(120) NOT NULL,
    id_jurusan INT(11) DEFAULT NULL,
    id_prodi INT(11) DEFAULT NULL,
    id_dosen_pa INT(11) DEFAULT NULL,
    angkatan VARCHAR(10) NOT NULL,
    jalur_masuk VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_mahasiswa),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_prodi) REFERENCES prodi(id_prodi) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_dosen_pa) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO mahasiswa (id_mahasiswa, nim, nama_depan, nama_belakang, email, jenis_kelamin, agama, jenjang, tanggal_lahir, no_hp, status, total_sks, semester, alamat, id_jurusan, id_prodi, id_dosen_pa, angkatan, jalur_masuk)
VALUES (1, '123456789', 'Dian', 'Surya', 'dian@gmail.com', 'Laki-Laki', 'Islam', 'S1', '1999-01-01', '08123456789', 'Aktif', '0', '1', 'Jl. Jendral Sudirman No. 1', 1, 1, 1, '2020', 'SNMPTN');

INSERT INTO mahasiswa (id_mahasiswa, nim, nama_depan, nama_belakang, email, jenis_kelamin, agama, jenjang, tanggal_lahir, no_hp, status, total_sks, semester, alamat, id_jurusan, id_prodi, id_dosen_pa, angkatan, jalur_masuk)
VALUES (2, '200311394', 'sammi', 'dev', 'sammidev@gmail.com', 'Laki-Laki', 'Islam', 'S1', '1999-01-01', '08123456789', 'Aktif', '0', '1', 'Jl. Jendral Sudirman No. 1', 1, 2, 3, '2021', 'SBMPTN');

CREATE TABLE IF NOT EXISTS ruangan (
    id_ruangan INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    jenis VARCHAR(50) NOT NULL,
    kapasitas INT(11) NOT NULL,
    lantai INT(11) NOT NULL,
    latitude VARCHAR(50) NOT NULL,
    longitude VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_ruangan)
);

CREATE TABLE IF NOT EXISTS matakuliah (
    id_matakuliah INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(50) NOT NULL,
    kode VARCHAR(50) UNIQUE NOT NULL,
    sks INT(11) NOT NULL,
    semester INT(2) NOT NULL,
    id_dosen_pengampu INT(11) DEFAULT NULL,
    id_jurusan INT(11) DEFAULT NULL,
    PRIMARY KEY (id_matakuliah),
    FOREIGN KEY (id_dosen_pengampu) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO matakuliah (id_matakuliah, nama, kode, sks, semester, id_dosen_pengampu, id_jurusan)
VALUES (1, 'Pemrograman Web', 'PWL', '3', '1', 1, 1);

CREATE TABLE IF NOT EXISTS mengajar (
    id_mengajar INT(11) NOT NULL AUTO_INCREMENT,
    id_dosen INT(11) DEFAULT NULL,
    id_matakuliah INT(11) DEFAULT NULL,
    hari      VARCHAR(50) NOT NULL,    
    jam_mulai VARCHAR(10) NOT NULL,
    jam_selesai VARCHAR(10) NOT NULL,
    PRIMARY KEY (id_mengajar),
    FOREIGN KEY (id_dosen) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id_matakuliah) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS enroll_matakuliah (
    id_enroll_matakuliah INT(11) NOT NULL AUTO_INCREMENT,
    id_mahasiswa INT(11) DEFAULT NULL,
    id_matakuliah INT(11) DEFAULT NULL,
    semester INT(2) NOT NULL,
    nilai VARCHAR(1) DEFAULT NULL,
    PRIMARY KEY (id_enroll_matakuliah),
    FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id_mahasiswa) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id_matakuliah) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE sessions(
    id VARCHAR(255) PRIMARY KEY,
    user_id INT(11) NOT NULL
);

ALTER TABLE sessions ADD CONSTRAINT fk_sessions_user FOREIGN KEY (user_id) REFERENCES users(id_user);