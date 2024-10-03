<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'koneksi.php';
$supplier = [];
$data = mysqli_query($koneksi, "SELECT * FROM supplier order by id desc");
while ($d = mysqli_fetch_assoc($data)) {
    $supplier[] = $d;
}


if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $supplier = $_POST['supplier'];
    $jenis = $_POST['jenis'];
    $kualitas = $_POST['kualitas'];
    $berat = $_POST['berat'];
    $harga = $_POST['harga'];
    $catatan = $_POST['catatan'];
    $tanggal = date('Y-m-d H:i:s');
    $status = 'HIDUP';

    $query = "INSERT INTO hewan (id_supplier, nama, jenis, kualitas, berat, harga, tanggal, catatan, `status`) values ('$supplier','$nama','$jenis','$kualitas','$berat','$harga','$tanggal','$catatan', '$status')";
    mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi) > 0) {
        $success = true;
        echo '<script type="text/javascript">window.location.href = "index.php?page=hewan_masuk";</script>';
    }
}

if (isset($success)) {
    echo "<span class='w-full px-4 py-2 bg-blue-500 text-white rounded-md'>Sukses! Berhasil Input Supplier.</span>";
}

?>

<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Tambah Hewan</h1>
        <span>Input hewan yang akan ditambahkan kedalam sistem / database</span>
    </div>
    <div>
        <a href="?page=hewan_masuk" class="button">
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
<form action="" method="post" class="grid grid-cols-2 bg-white p-6 rounded-lg shadow-sm gap-4 m-0">
    <div class="flex flex-col gap-2">
        <label for="nama">Nama Hewan <span class="text-red-500 text-sm">*</span></label>
        <input type="text" name="nama" id="nama" class="input" required>
    </div>
    <div class="flex flex-col gap-2">
        <label for="supplier">Supplier <span class="text-red-500 text-sm">*</span></label>
        <select name="supplier" id="supplier" class="input">
            <?php foreach ($supplier as $d): ?>
                <option value="<?= $d['id']; ?>"><?= $d['nama']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="jenis">Jenis <span class="text-red-500 text-sm">*</span></label>
        <input type="text" name="jenis" id="jenis" class="input" required>
    </div>
    <div class="flex flex-col gap-2">
        <label for="kualitas">Kualitas <span class="text-red-500 text-sm">*</span></label>
        <select type="number" name="kualitas" id="kualitas" class="input">
            <option>STANDAR</option>
            <option>SUPER</option>
            <option>PREMIUM</option>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="berat">Berat (Kg) <span class="text-red-500 text-sm">*</span></label>
        <input type="number" name="berat" id="berat" class="input" required>
    </div>
    <div class="flex flex-col gap-2">
        <label for="harga">Harga per Kg <span class="text-red-500 text-sm">*</span></label>
        <input type="number" name="harga" id="harga" class="input" required>
    </div>
    <div class="flex flex-col gap-2 col-span-2">
        <label for="catatan">Catatan</label>
        <textarea type="number" name="catatan" id="catatan" class="input" rows="5"></textarea>
    </div>
    <div class="flex flex-row items-center justify-end col-span-2">
        <button class="button" type="submit" name="submit">Simpan</button>
    </div>
</form>