<?php
declare(strict_types=1);

class Mahasiswa {
    private string $nim;
    private string $nama;
    private string $fakultas;
    private string $prodi;
    private string $asalSekolah;
    private int $semester;
    private string $hobi;
    private string $agama;

    private array $atributTambahan = [];

    private const DAFTAR_AGAMA = [
        'Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'
    ];

    public function __construct(
        string $nim,
        string $nama,
        string $fakultas = 'Belum diisi',
        string $prodi = '',
        string $asalSekolah = '',
        int $semester = 1,
        string $hobi = '',
        string $agama = ''
    ) {
        $nim = trim($nim);
        $nama = trim($nama);

        if ($nim === '') {
            throw new InvalidArgumentException('NIM wajib diisi.');
        }
        if ($nama === '') {
            throw new InvalidArgumentException('Nama wajib diisi.');
        }
        $this->validasiSemester($semester);
        $this->validasiAgama($agama);

        $this->nim = $nim;
        $this->nama = $nama;
        $this->fakultas = trim($fakultas) !== '' ? trim($fakultas) : 'Belum diisi';
        $this->prodi = trim($prodi);
        $this->asalSekolah = trim($asalSekolah);
        $this->semester = $semester;
        $this->hobi = trim($hobi);
        $this->agama = $agama;
    }

    // Getter: menyediakan akses baca tanpa membuka properti secara langsung.
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getFakultas(): string { return $this->fakultas; }
    public function getProdi(): string { return $this->prodi; }
    public function getAsalSekolah(): string { return $this->asalSekolah; }
    public function getSemester(): int { return $this->semester; }
    public function getHobi(): string { return $this->hobi; }
    public function getAgama(): string { return $this->agama; }

    // Setter hanya tersedia untuk atribut yang boleh diperbarui.
    // NIM sengaja tidak memiliki setter agar identitas objek tidak berubah langsung.
    public function setNama(string $nama): void {
        $nama = trim($nama);
        if ($nama === '') throw new InvalidArgumentException('Nama wajib diisi.');
        $this->nama = $nama;
    }

    public function setFakultas(string $fakultas): void {
        $this->fakultas = trim($fakultas) !== '' ? trim($fakultas) : 'Belum diisi';
    }

    public function setProdi(string $prodi): void { $this->prodi = trim($prodi); }
    public function setAsalSekolah(string $asalSekolah): void { $this->asalSekolah = trim($asalSekolah); }

    public function setSemester(int $semester): void {
        $this->validasiSemester($semester);
        $this->semester = $semester;
    }

    public function setHobi(string $hobi): void { $this->hobi = trim($hobi); }

    public function setAgama(string $agama): void {
        $this->validasiAgama($agama);
        $this->agama = $agama;
    }

    private function validasiSemester(int $semester): void {
        if ($semester < 1 || $semester > 14) {
            throw new InvalidArgumentException('Semester harus 1–14.');
        }
    }

    private function validasiAgama(string $agama): void {
        if (!in_array($agama, self::DAFTAR_AGAMA, true)) {
            throw new InvalidArgumentException('Pilihan agama tidak valid.');
        }
    }

    public function ringkasan(): string {
        return $this->nim . ' - ' . $this->nama;
    }

    // Overloading property tetap disediakan untuk atribut dinamis praktikum.
    public function __set(string $nama, mixed $nilai): void {
        $this->atributTambahan[$nama] = $nilai;
    }
    public function __get(string $nama): mixed {
        return $this->atributTambahan[$nama] ?? null;
    }
    public function __isset(string $nama): bool {
        return isset($this->atributTambahan[$nama]);
    }
    public function __unset(string $nama): void {
        unset($this->atributTambahan[$nama]);
    }

    public function __call(string $nama, array $argumen): mixed {
        if ($nama === 'profilSingkat' && count($argumen) === 0) {
            return $this->ringkasan();
        }
        throw new BadMethodCallException('Method tidak tersedia: ' . $nama);
    }

    public function __destruct() {
        if (defined('DEMO_LIFECYCLE') && DEMO_LIFECYCLE) {
            error_log('Destructor Mahasiswa: ' . $this->nim);
        }
    }
}
