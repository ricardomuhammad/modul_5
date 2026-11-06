
<?php

class Buku {
    private string $kodeBuku;
    private string $judul;
    private int $stok;

    // Constructor
    public function __construct(string $kodeBuku, string $judul, int $stok) {
        if (trim($kodeBuku) === '') {
            throw new InvalidArgumentException("Kode buku wajib diisi.");
        }

        if (trim($judul) === '') {
            throw new InvalidArgumentException("Judul buku wajib diisi.");
        }

        if ($stok < 0) {
            throw new InvalidArgumentException("Stok tidak boleh negatif.");
        }

        $this->kodeBuku = $kodeBuku;
        $this->judul = $judul;
        $this->stok = $stok;
    }

    // Getter
    public function getKodeBuku(): string {
        return $this->kodeBuku;
    }

    public function getJudul(): string {
        return $this->judul;
    }

    public function getStok(): int {
        return $this->stok;
    }

    // Setter judul
    public function setJudul(string $judul): void {
        if (trim($judul) === '') {
            throw new InvalidArgumentException("Judul buku wajib diisi.");
        }

        $this->judul = $judul;
    }

    // Menambah stok
    public function tambahStok(int $jumlah): void {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException("Jumlah penambahan harus positif.");
        }

        $this->stok += $jumlah;
    }

    // Mengurangi stok
    public function kurangiStok(int $jumlah): void {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException("Jumlah pengurangan harus positif.");
        }

        if ($jumlah > $this->stok) {
            throw new InvalidArgumentException("Stok buku tidak mencukupi.");
        }

        $this->stok -= $jumlah;
    }
}

// =================================
// PENGUJIAN PROGRAM
// =================================

echo "<h3>Pengujian Class Buku</h3>";

// Pengujian 1: Input valid
echo "<b>Pengujian 1: Input valid</b><br>";

$buku = new Buku("BK001", "Pemrograman PHP", 10);

echo "Kode Buku: " . $buku->getKodeBuku() . "<br>";
echo "Judul: " . $buku->getJudul() . "<br>";
echo "Stok: " . $buku->getStok() . "<br><br>";

// Pengujian 2: Mengubah judul dan stok
echo "<b>Pengujian 2: Perubahan data valid</b><br>";

$buku->setJudul("Belajar PHP OOP");
$buku->tambahStok(5);
$buku->kurangiStok(3);

echo "Judul baru: " . $buku->getJudul() . "<br>";
echo "Stok akhir: " . $buku->getStok() . "<br><br>";

// Pengujian 3: Judul kosong
echo "<b>Pengujian 3: Judul kosong</b><br>";

try {
    $buku->setJudul("");
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

// Pengujian 4: Stok negatif
echo "<br><b>Pengujian 4: Stok negatif</b><br>";

try {
    $buku2 = new Buku("BK002", "Belajar Java", -5);
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

// Pengujian 5: Stok tidak mencukupi
echo "<br><b>Pengujian 5: Stok tidak mencukupi</b><br>";

try {
    $buku->kurangiStok(100);
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

?>
