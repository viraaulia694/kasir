<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .detail-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .transaction-list {
            list-style: none;
            padding: 0;
        }

        .transaction-list li {
            margin-bottom: 10px;
        }

        .transaction-list li:last-child {
            margin-bottom: 0;
        }

        #totalAmountDetail {
            font-size: 18px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #changeAmountDetail {
            font-size: 18px;
            color: #333;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.0/html2pdf.bundle.js"></script>
</head>
</head>
<body>
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
