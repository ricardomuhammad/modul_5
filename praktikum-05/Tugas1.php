<?php
declare(strict_types=1);

// 1. DEKLARASI PARENT CLASS
class Produk {
    public string $nama;
    protected string $kategori;
    private int $harga;

    public function __construct(string $nama, string $kategori, int $harga) {
        $this->nama = $nama;
        $this->kategori = $kategori;
        $this->harga = $harga;
    }
}

// 2. DEKLARASI CHILD CLASS (SUBCLASS)
class ProdukDigital extends Produk {
    public function cetakKategori(): string {
        // Boleh diakses karena properti $kategori bersifat protected
        return "Kategori Produk: " . $this->kategori; 
    }
}

// 3. --- UJI AKSES DARI LUAR CLASS ---
$produk = new Produk("Laptop Asus", "Elektronik", 12000000);

echo "1. Akses Public (Nama): " . $produk->nama . "<br>"; // BERHASIL

try {
    // Mencoba mengakses protected dari luar class (Harusnya Error)
    echo "2. Akses Protected: " . $produk->kategori . "<br>";
} catch (Error $e) {
    echo "2. Akses Protected: GAGAL (" . $e->getMessage() . ")<br>";
}

try {
    // Mencoba mengakses private dari luar class (Harusnya Error)
    echo "3. Akses Private: " . $produk->harga . "<br>";
} catch (Error $e) {
    echo "3. Akses Private: GAGAL (" . $e->getMessage() . ")<br>";
}

// 4. --- UJI SUBCLASS ---
$digital = new ProdukDigital("E-Book PBO", "E-Book", 50000);
echo "4. Akses Protected via Subclass: " . $digital->cetakKategori() . "<br>";
