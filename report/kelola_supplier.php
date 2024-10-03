<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Kelola Supplier</h1>
        <span>Ini adalah halaman supplier, kamu bisa menambahkan dan melihat list supplier yang terdaftar dan tersimpan di database.</span>
    </div>
    <div>
        <a href="?page=tambah_supplier" class="button">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" /></svg>
            Tambah Supplier
        </a>
    </div>
</div>
<div class="flex flex-col bg-white p-6 rounded-lg shadow-sm">
    <?php
    include 'koneksi.php';
    $data =  [];
    $query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE `status`='active' order by id desc");
    while($d = mysqli_fetch_assoc($query)){
        $data [] = $d;
    }
    ?>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Supplier</td>
                    <td>Alamat</td>
                    <td>Nomor HP</td>
                    <td>Rekening</td>
                    <td>No Rekening</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;?>
                <?php foreach($data as $d):?>
                    <?php $no++;?>
                    <tr>
                        <td><?= $no;?></td>
                        <td><?= $d['nama'];?></td>
                        <td><?= $d['alamat'];?></td>
                        <td><?= $d['nomor_hp'];?></td>
                        <td><?= $d['rekening'];?></td>
                        <td><?= $d['nomor_rekening'];?></td>
                        <td>
                            <div class="flex">
                                <a href="index.php?page=edit_supplier&id=<?= $d['id'];?>" class="p-2 rounded-md bg-blue-500 text-white hover:bg-blue-400">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>