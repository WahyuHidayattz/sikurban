<?php
include "koneksi.php";

function getBagian($id)
{
    global $koneksi;
    $hewan_potong   = [];
    $berat          = 0;
    $harga          = 0;
    $query = "SELECT * FROM hewan_potong where id_hewan='$id'";
    $data = mysqli_query($koneksi, $query);
    while ($d = mysqli_fetch_assoc($data)) {
        $hewan_potong[] = $d;
        $berat += $d['berat'];
        $harga += $d['berat'] * $d['harga'];
    }
    return [
        'data' => $hewan_potong,
        'berat' => $berat,
        'harga' => $harga
    ];
}

if (isset($_GET['id'])) {
    $id     = $_GET['id'];
    $hewan  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM hewan WHERE id='$id'"));
    $id_supplier = $hewan['id_supplier'];

    $data_potong    = getBagian($id);
    $hewan_potong   = $data_potong['data'];
    $sisa_berat = $hewan['berat'] - $data_potong['berat'];
    $pnl    = $data_potong['harga'] - ($hewan['berat'] * $hewan['harga']);

    $supplier = [];
    $data = mysqli_query($koneksi, "SELECT * FROM supplier order by id desc");
    while ($d = mysqli_fetch_assoc($data)) {
        $supplier[$d['id']] = $d;
    }
    if (isset($_POST['submit'])) {
        $nama_bagian = $_POST['nama_bagian'];
        $berat = $_POST['berat'];
        $harga = $_POST['harga'];
        $tanggal = date('Y-m-d H:i:s');

        if ($berat > $sisa_berat) {
            $error = true;
            $message = "Gagal! Berat bagian hewan tidak boleh lebih dari sisa berat hewan tersebut";
        } else {
            $query = "INSERT INTO hewan_potong (id_hewan, nama_bagian, berat, harga, tanggal) values ('$id','$nama_bagian','$berat','$harga','$tanggal')";
            if (mysqli_query($koneksi, $query)) {
                $data_potong    = getBagian($id);
                $hewan_potong   = $data_potong['data'];
                $sisa_berat = $hewan['berat'] - $data_potong['berat'];
                $pnl    = $data_potong['harga'] - ($hewan['berat'] * $hewan['harga']);

                $query = "UPDATE hewan SET status='SEMBELIH' where id='$id'";
                mysqli_query($koneksi, $query);
            }
        }
    }
    if (isset($_POST['delete'])) {
        $id_bagian = $_POST['id_bagian'];
        $query = "DELETE FROM hewan_potong where id='$id_bagian'";
        if (mysqli_query($koneksi, $query)) {
            $data_potong    = getBagian($id);
            $hewan_potong   = $data_potong['data'];
            $sisa_berat = $hewan['berat'] - $data_potong['berat'];
            $pnl    = $data_potong['harga'] - ($hewan['berat'] * $hewan['harga']);
        }
    }
}
?>

<?php if (isset($error)): ?>
    <span class="px-3 py-2 bg-red-600 text-white text-sm rounded-lg">
        <?= $message; ?>
    </span>
<?php endif; ?>
<div class="flex flex-row items-center w-full">
    <a href="index.php?page=hewan_masuk" class="flex flex-row items-center gap-3 hover:text-black">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l14 0" />
            <path d="M5 12l6 6" />
            <path d="M5 12l6 -6" />
        </svg>
        Kembali
    </a>
</div>
<div class="flex flex-col gap-2 p-4 items-center justify-center max-w-2xl mx-auto w-full">
    <h1 class="text-4xl font-bold text-black"><?= $hewan['nama']; ?></h1>
    <span class="text-sm">by <?= $supplier[$id_supplier]['nama']; ?></span>
    <span class="text-center text-sm">
        <?= $hewan['catatan']; ?>
    </span>
    <div class="flex flex-col gap-4 w-full mt-6">
        <div class="flex flex-row items-center justify-between w-full border-b border-b-gray-400 border-dashed">
            <span>Berat Hewan (Kg)</span>
            <span><?= $hewan['berat']; ?></span>
        </div>
        <div class="flex flex-row items-center justify-between w-full border-b border-b-gray-400 border-dashed">
            <span>Total Harga Hidup</span>
            <span>Rp.<?= number_format($hewan['harga'] * $hewan['berat']); ?></span>
        </div>
        <div class="flex flex-row items-center justify-between w-full border-b border-b-gray-400 border-dashed">
            <span>Total Harga Bagian</span>
            <span>Rp.<?= number_format($data_potong['harga']); ?></span>
        </div>
        <div class="flex flex-row items-center justify-between w-full border-b border-b-gray-400 border-dashed">
            <span>Estimasi PnL</span>
            <span class="<?= $pnl>0 ? 'text-green-600' : 'text-red-600';?>">Rp.<?= number_format($pnl); ?></span>
        </div>
    </div>
    <div class="flex flex-row items-center justify-center mt-4">
        <div x-data="{ modelOpen: false }">
            <button @click="modelOpen =!modelOpen" class="button">
                Tambah Bagian Hewan
            </button>
            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                    <div x-cloak x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 ">Tambah Bagian Kurban</h1>

                            <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                            Bagi beberapa part dari hewan kurban menjadi daging, tulang, dan jeroan
                        </p>

                        <form action="" method="post" class="w-full p-0 m-0 flex flex-col gap-4 mt-6">
                            <div class="flex flex-col gap-1">
                                <label for="nama_bagian">Nama Bagian</label>
                                <input type="text" name="nama_bagian" id="nama_bagian" class="input" required>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="berat">Berat</label>
                                <input type="text" name="berat" id="berat" class="input" placeholder="Max : <?= $sisa_berat; ?>" required>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="harga">Harga Per Kg</label>
                                <input type="text" name="harga" id="harga" class="input" required>
                            </div>
                            <div class="flex flex-row items-center justify-end">
                                <button name="submit" class="button">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col gap-4 bg-white rounded-lg shadow-sm p-6">
    <h2 class="text-lg text-black font-semibold">List Bagian Hewan (DAGING/TULANG/JEROAN)</h2>
    <div class="flex flex-col overflow-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <td>Nama Bagian</td>
                    <td>Berat (Kg)</td>
                    <td>Harga Per Kg</td>
                    <td>Total Harga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hewan_potong as $d): ?>
                    <tr>
                        <td><?= $d['nama_bagian']; ?></td>
                        <td><?= $d['berat']; ?></td>
                        <td><?= number_format($d['harga']); ?></td>
                        <td><?= number_format($d['harga'] * $d['berat']); ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id_bagian" value="<?= $d['id']; ?>">
                                <button name="delete" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>