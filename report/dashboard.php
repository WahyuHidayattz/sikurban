<?php

include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT count(*) as jumlah FROM hewan WHERE `status`<>'DELETED'");
$jumlah_hewan = mysqli_fetch_assoc($query)['jumlah'];

$query = mysqli_query($koneksi, "SELECT count(*) as jumlah FROM hewan WHERE `status`='HIDUP'");
$jumlah_hidup = mysqli_fetch_assoc($query)['jumlah'];

$query = mysqli_query($koneksi, "SELECT count(*) as jumlah FROM hewan WHERE `status`='SEMBELIH'");
$jumlah_sembelih = mysqli_fetch_assoc($query)['jumlah'];

$query = mysqli_query($koneksi, "SELECT count(*) as jumlah FROM supplier WHERE `status`<>'deleted'");
$jumlah_supplier = mysqli_fetch_assoc($query)['jumlah'];

$query = mysqli_query($koneksi, "SELECT count(*) as jumlah FROM users");
$jumlah_user = mysqli_fetch_assoc($query)['jumlah'];


?>

<div class="grid grid-cols-3 gap-6">
    <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-row">
        <div class="flex flex-col gap-1 flex-1">
            <span class="text-4xl font-bold text-black"><?= $jumlah_hewan; ?></span>
            <span>Jumlah Hewan</span>
        </div>
        <div class="p-2 flex items-center justify-center">
            <div class="p-2 rounded-full bg-blue-200 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                    <path d="M12 12l8 -4.5" />
                    <path d="M12 12l0 9" />
                    <path d="M12 12l-8 -4.5" />
                    <path d="M16 5.25l-8 4.5" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-row">
        <div class="flex flex-col gap-1 flex-1">
            <span class="text-4xl font-bold text-black"><?= $jumlah_hidup; ?></span>
            <span>Hewan Hidup</span>
        </div>
        <div class="p-2 flex items-center justify-center">
            <div class="p-2 rounded-full bg-green-200 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cat">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 3v10a8 8 0 1 1 -16 0v-10l3.432 3.432a7.963 7.963 0 0 1 4.568 -1.432c1.769 0 3.403 .574 4.728 1.546l3.272 -3.546z" />
                    <path d="M2 16h5l-4 4" />
                    <path d="M22 16h-5l4 4" />
                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M9 11v.01" />
                    <path d="M15 11v.01" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-row">
        <div class="flex flex-col gap-1 flex-1">
            <span class="text-4xl font-bold text-black"><?= $jumlah_sembelih; ?></span>
            <span>Sudah Disimbelih</span>
        </div>
        <div class="p-2 flex items-center justify-center">
            <div class="p-2 rounded-full bg-red-200 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-meat">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M13.62 8.382l1.966 -1.967a2 2 0 1 1 3.414 -1.415a2 2 0 1 1 -1.413 3.414l-1.82 1.821" />
                    <path d="M5.904 18.596c2.733 2.734 5.9 4 7.07 2.829c1.172 -1.172 -.094 -4.338 -2.828 -7.071c-2.733 -2.734 -5.9 -4 -7.07 -2.829c-1.172 1.172 .094 4.338 2.828 7.071z" />
                    <path d="M7.5 16l1 1" />
                    <path d="M12.975 21.425c3.905 -3.906 4.855 -9.288 2.121 -12.021c-2.733 -2.734 -8.115 -1.784 -12.02 2.121" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-row">
        <div class="flex flex-col gap-1 flex-1">
            <span class="text-4xl font-bold text-black"><?= $jumlah_supplier; ?></span>
            <span>Jumlah Supplier</span>
        </div>
        <div class="p-2 flex items-center justify-center">
            <div class="p-2 rounded-full bg-green-200 text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-row">
        <div class="flex flex-col gap-1 flex-1">
            <span class="text-4xl font-bold text-black"><?= $jumlah_user; ?></span>
            <span>Users</span>
        </div>
        <div class="p-2 flex items-center justify-center">
            <div class="p-2 rounded-full bg-indigo-200 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                </svg>
            </div>
        </div>
    </div>
</div>