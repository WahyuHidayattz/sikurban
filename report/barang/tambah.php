<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'koneksi.php';


if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga'];
    $barcode = $_POST['barcode'];
    $supplier = $_POST['supplier'];

    $query = "INSERT INTO barang (nama_barang, id_supplier, berat, harga, barcode) values ('$nama', '$supplier','$berat','$harga','$barcode')";
    mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi) > 0) {
        $success = true;
        echo '<script type="text/javascript">window.location.href = "index.php?page=kelola_barang";</script>';
    }
}

if (isset($success)) {
    echo "<span class='w-full px-4 py-2 bg-blue-500 text-white rounded-md'>Sukses! Berhasil Input Supplier.</span>";
}

$query = "SELECT * FROM supplier order by id_supplier desc";
$row = mysqli_query($koneksi, $query);
$supplier = [];
while ($d = mysqli_fetch_assoc($row)) {
    $supplier[] = $d;
}

?>

<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Tambah Barang</h1>
        <span>Ini adalah halaman tambah data barang.</span>
    </div>
    <div>
        <a href="?page=kelola_barang" class="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l6 6" />
                <path d="M5 12l6 -6" />
            </svg>
            Kembali
        </a>
    </div>
</div>
<form action="" method="post" class="flex flex-col bg-white p-6 rounded-lg shadow-sm gap-4 m-0">
    <div class="flex flex-col gap-2">
        <label for="nama">Nama Barang</label>
        <input type="text" name="nama" id="nama" class="input">
    </div>
    <div class="flex flex-col gap-2">
        <label for="supplier">Supplier</label>
        <select name="supplier" id="supplier" class="input">
            <?php foreach ($supplier as $d): ?>
                <option value="<?= $d['id_supplier']; ?>"><?= $d['nama_supplier']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="berat">Berat (Kg)</label>
        <input type="number" name="berat" id="berat" class="input">
    </div>
    <div class="flex flex-col gap-2">
        <label for="harga">Harga (Kg)</label>
        <input type="number" name="harga" id="harga" class="input">
    </div>
    <div class="flex flex-col gap-2">
        <label for="barcode">Barcode</label>
        <input type="number" name="barcode" id="barcode" class="input">
    </div>
    <div class="flex flex-row items-center justify-end">
        <button class="button" type="submit" name="submit">Simpan</button>
    </div>
</form>