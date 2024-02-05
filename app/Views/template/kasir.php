<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>

<?php
// main.php

// Check if the request is an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // AJAX request handling

    // Load menu content using AJAX
    $menuContent = file_get_contents('menu.php');
    echo $menuContent;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier App</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: pink;
            padding: 10px;
            text-align: center;
        }

        .content {
            display: flex;
            padding: 20px;
        }

        .menu-container {
            width: 50%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .transaction-container {
            width: 30%;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .menu-category-card {
            background-color: #f9f9f9;
            text-align: center;
        }

        .menu-card {
            background-color: #f9f9f9;
            overflow: hidden;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-height: 520px;
            overflow-y: auto;
        }

        .menu-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }

        .transaction-card {
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        .filter-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        .filter-button {
            padding: 10px;
            cursor: pointer;
        }

        .quantity-input {
            width: 50px;
        }

        .add-to-cart-button {
            cursor: pointer;
            padding: 5px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 3px;
        }
        
        /* Your existing styles here */
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h1>Nahira's Fashion</h1>
</div>

<!-- Content -->
<div class="content">
    <!-- Card Kategori dan Menu -->
    <div class="menu-container" id="menuContainer">
        <!-- Content will be loaded here using AJAX -->
    </div>

    <!-- Card Menu -->
    <div class="card menu-card" id="menuCard">
        <h2>Fashion</h2>
        <ul class="menu-list">
            <!-- Produk 1 -->
            <li class="menu-item">
                <img src="/foto/cos1.jpg" alt="Cosmetics 1" style="width: 100%">
                <h3>Dior Cushion</h3>
                <p>Harga: Rp 1,100,000</p>
                <label>Jumlah: </label>
                <input type="number" class="quantity-input" id="quantity_cos1" value="0">
                <button class="add-to-cart-button" onclick="addToCart('Dior Cushion', 1100000, 'quantity_cos1')">Tambah ke Keranjang</button>
            </li>

            <!-- Produk 2 -->
            <li class="menu-item">
                <img src="/foto/cos2.jpg" alt="Cosmetics 2" style="width: 100%">
                <h3>Dior Lipstick</h3>
                <p>Harga: Rp 500,000</p>
                <label>Jumlah: </label>
                <input type="number" class="quantity-input" id="quantity_cos2" value="0">
                <button class="add-to-cart-button" onclick="addToCart('Dior Lipstick', 500000, 'quantity_cos2')">Tambah ke Keranjang</button>
            </li>

            <!-- Produk 3 -->
            <li class="menu-item">
                <img src="/foto/clot1.jpg" alt="Clothes 1" style="width: 100%">
                <h3>Dior T-Shirt</h3>
                <p>Harga: Rp 700,000</p>
                <label>Jumlah: </label>
                <input type="number" class="quantity-input" id="quantity_clot1" value="0">
                <button class="add-to-cart-button" onclick="addToCart('Dior T-Shirt', 700000, 'quantity_clot1')">Tambah ke Keranjang</button>
            </li>

            <!-- Produk 4 -->
            <li class="menu-item">
                <img src="/foto/clot2.jpg" alt="Clothes 2" style="width: 100%">
                <h3>Dior Jacket</h3>
                <p>Harga: Rp 2,000,000</p>
                <label>Jumlah: </label>
                <input type="number" class="quantity-input" id="quantity_clot2" value="0">
                <button class="add-to-cart-button" onclick="addToCart('Dior Jacket', 2000000, 'quantity_clot2')">Tambah ke Keranjang</button>
            </li>

            <!-- Produk 5 -->
            <li class="menu-item">
                <img src="/foto/cos3.jpg" alt="Cosmetics 3" style="width: 100%">
                <h3>Dior Parfum</h3>
                <p>Harga: Rp 1,500,000</p>
                <label>Jumlah: </label>
                <input type="number" class="quantity-input" id="quantity_cos3" value="0">
                <button class="add-to-cart-button" onclick="addToCart('Dior Parfum', 1500000, 'quantity_cos3')">Tambah ke Keranjang</button>
            </li>
        </ul>
        <h4>+ Tambah Menu</h4>
    </div>

    <!-- Card Transaksi -->
    <div class="transaction-container">
        <div class="card transaction-card">
            <h2>Transaksi</h2>
            <!-- Daftar transaksi -->
            <ul id="transactionList"></ul>

            <!-- Total harga -->
            <div>
                <strong>Total: Rp <span id="totalAmount">0</span></strong>
            </div>

            <!-- Tombol Bayar dan Reset -->
            <div>
                <button onclick="checkout()">Bayar</button>
                <button onclick="resetCart()">Reset</button>
            </div>
        </div>
    </div>
</div>

<!-- Konten utama untuk halaman detailtransaksi.html -->
<div class="detail-container">
    <h2>Detail Transaksi</h2>

    <!-- Daftar transaksi -->
    <ul class="transaction-list" id="transactionListDetail"></ul>

    <!-- Total harga -->
    <div>
        <strong>Total Harga: Rp <span id="totalAmountDetail">0</span></strong>
    </div>

    <!-- Uang Dibayar -->
    <div>
        <label for="uangDibayar">Uang Dibayar:</label>
        <input type="text" id="uangDibayar" placeholder="Rp" oninput="updateUangDibayar()">
    </div>

    <!-- Kembalian -->
    <div>
        <strong>Kembalian: Rp <span id="changeAmountDetail">0</span></strong>
    </div>

    <!-- Tombol Bayar -->
    <div class="button-container">
        <button id="bayarButton">Bayar</button>
    </div>

    <!-- Tombol Cetak Nota -->
    <div class="button-container">
        <button id="cetakNotaButton">Cetak Nota</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.0/html2pdf.bundle.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const transactionListDetail = document.getElementById('transactionListDetail');
        const totalAmountDetail = document.getElementById('totalAmountDetail');
        const changeAmountDetail = document.getElementById('changeAmountDetail');
        const uangDibayarInput = document.getElementById('uangDibayar');

        // Ambil nilai totalPesanan dari parameter URL
        const urlParams = new URLSearchParams(window.location.search);
        const totalPesanan = parseFloat(urlParams.get('totalPesanan')) || 0; // Inisialisasi totalPesanan

        // Tampilkan nilai totalPesanan di halaman
        totalAmountDetail.textContent = `Rp ${totalPesanan.toLocaleString()}`;

        // Tombol Bayar
        const bayarButton = document.getElementById('bayarButton');
        bayarButton.addEventListener('click', bayar);

        // Tombol Cetak Nota
        const cetakNotaButton = document.getElementById('cetakNotaButton');
        cetakNotaButton.addEventListener('click', generateNota);

        function hitungKembalian() {
            const uangDibayar = parseFloat(uangDibayarInput.value);

            if (isNaN(uangDibayar) || uangDibayar < totalPesanan) {
                alert('Uang yang dibayar tidak valid.');
                return;
            }

            const kembalian = uangDibayar - totalPesanan;

            // Update kembalian dan uang dibayar di halaman detailtransaksi.html
            changeAmountDetail.textContent = `Rp ${kembalian.toLocaleString()}`;
        }

        function generateNota() {
            const totalAmount = parseFloat(totalAmountDetail.textContent.replace('Rp ', '').replace(',', ''));
            const uangDibayar = parseFloat(uangDibayarInput.value);

            if (isNaN(uangDibayar) || uangDibayar < totalAmount) {
                alert('Uang yang dibayar tidak valid.');
                return;
            }

            const kembalian = uangDibayar - totalAmount;

            // Update kembalian dan uang dibayar di halaman detailtransaksi.html
            changeAmountDetail.textContent = `Rp ${kembalian.toLocaleString()}`;

            // Cetak nota menggunakan html2pdf
            const element = document.body;

            // Informasi untuk dicetak pada nota
            const namaToko = "Nahira's Fashion"; // Ganti dengan nama toko Anda
            const tanggal = new Date().toLocaleDateString();

            // Buat string HTML untuk nota
            const notaContent = `
                <h2>${namaToko}</h2>
                <p>Tanggal: ${tanggal}</p>
                <p>Total Harga: Rp ${totalAmount.toLocaleString()}</p>
                <p>Uang Dibayar: Rp ${uangDibayar.toLocaleString()}</p>
                <p>Kembalian: Rp ${kembalian.toLocaleString()}</p>
            `;

            // Gabungkan elemen HTML untuk nota dengan elemen lain di halaman
            const combinedContent = `
                <div class="detail-container">
                    <h2>Detail Transaksi</h2>
                    <ul class="transaction-list" id="transactionListDetail"></ul>
                    <div>
                        <strong>Total Harga: Rp <span id="totalAmountDetail">0</span></strong>
                    </div>
                    <div>
                        <label for="uangDibayar">Uang Dibayar:</label>
                        <input type="text" id="uangDibayar" placeholder="Rp" oninput="updateUangDibayar()">
                    </div>
                    <div>
                        <strong>Kembalian: Rp <span id="changeAmountDetail">0</span></strong>
                    </div>
                    <div class="button-container">
                        <button id="bayarButton">Bayar</button>
                    </div>
                    <div class="button-container">
                        <button id="cetakNotaButton">Cetak Nota</button>
                    </div>
                </div>
            `;

            // Tambahkan elemen HTML nota ke halaman
            element.innerHTML = combinedContent + notaContent;

            // Kembalikan keadaan semula setelah mencetak nota
            bayarButton.addEventListener('click', bayar);
            cetakNotaButton.addEventListener('click', generateNota);
        }

        function bayar() {
            // Panggil fungsi hitungKembalian
            hitungKembalian();
        }

        function updateUangDibayar() {
            const selectedValue = uangDibayarInput.value;

            // Hitung kembalian jika uang dibayar sudah dipilih
            if (selectedValue !== '0') {
                hitungKembalian();
            }
        }
    });
</script>
</body>
</html>
<?= $this->endSection(); ?>