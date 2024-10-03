<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'koneksi.php';


if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $bank = $_POST['bank'];
    $rekening = $_POST['rekening'];
    $nomor = $_POST['nomor'];

    $query = "INSERT INTO supplier (nama, alamat, nomor_hp, rekening, nomor_rekening, `status`) values ('$nama','$alamat','$nomor','$bank', '$rekening', 'active')";
    mysqli_query($koneksi, $query);
    if(mysqli_affected_rows($koneksi)>0){
        $success = true;
        echo '<script type="text/javascript">window.location.href = "index.php?page=kelola_supplier";</script>';
    }
}

if(isset($success)){
    echo "<span class='w-full px-4 py-2 bg-blue-500 text-white rounded-md'>Sukses! Berhasil Input Supplier.</span>";
}

?>

<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Tambah Supplier</h1>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa similique maxime in culpa beatae voluptatum delectus dolorem quibusdam, accusamus libero rem repellat? Sed quasi necessitatibus illo veritatis doloribus dignissimos et.</span>
    </div>
    <div>
        <a href="?page=kelola_supplier" class="button">
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
        <label for="nama">Nama Supplier</label>
        <input type="text" name="nama" id="nama" class="input">
    </div>
    <div class="flex flex-col gap-2">
        <label for="alamat">Alamat</label>
        <textarea type="text" name="alamat" id="alamat" class="input" rows="3"></textarea>
    </div>
    <div class="flex flex-col gap-2">
        <label for="nomor">Nomor HP</label>
        <input type="number" name="nomor" id="nomor" class="input">
    </div>
    <div class="flex flex-col gap-2">
        <label for="bank">Bank Rekening</label>
        <select name="bank" id="bank" class="input">
            <option>-- Pilih Bank --</option>
            <option>BCA</option>
            <option>BRI</option>
            <option>BNI</option>
            <option>BJB</option>
            <option>DKI</option>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="rekening">Nomor Rekening</label>
        <input type="number" name="rekening" id="nama" class="input">
    </div>
    <div class="flex flex-row items-center justify-end">
        <button class="button" type="submit" name="submit">Simpan</button>
    </div>
</form>