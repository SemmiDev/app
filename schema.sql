DROP DATABASE IF EXISTS app;
CREATE DATABASE IF NOT EXISTS app;
USE app;

CREATE TABLE IF NOT EXISTS fakultas (
    id_fakultas INT(11) NOT NULL AUTO_INCREMENT,
    nama_fakultas VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_fakultas)
);

-- dummy data for fakultas
INSERT INTO fakultas (id_fakultas, nama_fakultas) VALUES (1, 'Fakultas Perikanan dan Ilmu Kelautan');
INSERT INTO fakultas (id_fakultas, nama_fakultas) VALUES (2, 'Fakultas Matematika dan Ilmu Pengetahuan Alam');
INSERT INTO fakultas (id_fakultas, nama_fakultas) VALUES (3, 'Fakultas Teknik');

CREATE TABLE IF NOT EXISTS jurusan (
    id_jurusan INT(11) NOT NULL AUTO_INCREMENT,
    nama_jurusan VARCHAR(50) NOT NULL,
    akreditasi VARCHAR(1) NOT NULL,
    jenjang VARCHAR(10) NOT NULL,
    id_fakultas INT(11) DEFAULT NULL,
    PRIMARY KEY (id_jurusan),
    FOREIGN KEY (id_fakultas) REFERENCES fakultas(id_fakultas) ON DELETE SET NULL ON UPDATE CASCADE
);

-- dummy data for jurusan
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (1, 'Teknologi Hasil Perikanan', 'A','S1',1);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (2, 'Ilmu Kelautan', 'A','S1', 1);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (3, 'Budidaya Perairan', 'A','S1', 1);

INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (4, 'Sistem Informasi', 'A','S1', 2);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (5, 'Manajemen Informatika', 'A','D3', 2);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (6, 'Fisika', 'A','S1', 2);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (7, 'Kimia', 'A','S1', 2);

INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (8, 'Teknik Sipil', 'A','S1', 3);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (9, 'Teknik Elektro', 'A','S1', 3);
INSERT INTO jurusan (id_jurusan, nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (10, 'Teknik Mesin', 'A','S1', 3);

CREATE TABLE roles (
    id_role INT(11) NOT NULL AUTO_INCREMENT,
    role VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_role)
);

CREATE TABLE IF NOT EXISTS users (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_role INT(11) DEFAULT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_role) REFERENCES roles(id_role) ON DELETE SET NULL ON UPDATE CASCADE
);


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
VALUES (1, '123456789', 'Dian', 'Surya', 'dian@gmail.com', 'Laki-Laki', '08123456789', '08123456789', 'PNS', 'PNS', 'Jl. Jendral Sudirman No. 1');

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
    id_dosen_pa INT(11) DEFAULT NULL,
    PRIMARY KEY (id_mahasiswa),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_dosen_pa) REFERENCES dosen(id_dosen) ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO mahasiswa (id_mahasiswa, nim, nama_depan, nama_belakang, email, jenis_kelamin, agama, jenjang, tanggal_lahir, no_hp, status, total_sks, semester, alamat, id_jurusan, id_dosen_pa)
VALUES (1, '123456789', 'Dian', 'Surya', 'SAM@gmail.com', 'Laki-Laki', 'Islam', 'S1', '1999-01-01', '08123456789', 'Mahasiswa', '0', '1', 'Jl. Jendral Sudirman No. 1', 1, 1);

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
    kode_matakuliah VARCHAR(50) UNIQUE NOT NULL,
    sks INT(11) NOT NULL,
    semester INT(2) NOT NULL,
    dosen_pengampu INT(11) NOT NULL,
    id_jurusan INT(11) NOT NULL,
    PRIMARY KEY (id_matakuliah),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (dosen_pengampu) REFERENCES dosen(id_dosen) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CREATE TABLE IF NOT EXISTS dosen_matakuliah (
--     id_dosen_matakuliah INT(11) NOT NULL AUTO_INCREMENT,
--     id_dosen INT(11) NOT NULL,
--     id_matakuliah INT(11) NOT NULL,
--     jam_mulai timestamp NOT NULL,
--     jam_selesai timestamp NOT NULL,
--     PRIMARY KEY (id_dosen_matakuliah),
--     FOREIGN KEY (id_dosen) REFERENCES dosen(id_dosen) ON DELETE CASCADE ON UPDATE CASCADE,
--     FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id_matakuliah) ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- CREATE TABLE IF NOT EXISTS mahasiswa_matakuliah (
--     id_mahasiswa_matakuliah INT(11) NOT NULL AUTO_INCREMENT,
--     id_mahasiswa INT(11) NOT NULL,
--     id_matakuliah INT(11) NOT NULL,
--     semester INT(2) NOT NULL,
--     nilai INT(11) NOT NULL,
--     PRIMARY KEY (id_mahasiswa_matakuliah),
--     FOREIGN KEY (id_mahasiswa) REFERENCES mahasiswa(id_mahasiswa) ON DELETE CASCADE ON UPDATE CASCADE,
--     FOREIGN KEY (id_matakuliah) REFERENCES matakuliah(id_matakuliah) ON DELETE CASCADE ON UPDATE CASCADE
-- );