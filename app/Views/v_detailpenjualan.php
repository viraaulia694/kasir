<!-- app/Views/transaction_page.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Halaman Transaksi</title>
    <!-- Tambahkan bagian head lainnya sesuai kebutuhan -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="form-group row">
        <div class="col">
            <input class="form-control" id="barcode_search" name="barcode_search" type="text" placeholder="Cari Barcode atau Nama">
        </div>
    </div>

    <input type="hidden" class="reset" id="product_id" name="product_id">
    <input type="hidden" class="reset" id="val_selling_price" name="selling_price">
    <input type="hidden" class="reset" id="val_product_name" name="product_name">
    <input type="hidden" class="reset" id="val_product_qty" name="stock_product_qty">

    <input type="hidden" class="reset" id="jenis_promo" name="jenis_promo">
    <input type="hidden" class="reset" id="potongan" name="potongan">
    <input type="hidden" class="reset" id="harga_potongan" name="harga_potongan">
    <input type="hidden" class="reset" name="total" id="val_total" value="0">
    <input type="hidden" class="reset" id="kembali" readonly="" name="kembali">

    <!-- Script AJAX untuk berinteraksi dengan CodeIgniter 4 -->
    <script>
        $(document).ready(function() {
            // Event listener untuk input barcode_search
            $('#barcode_search').on('input', function() {
                // Ambil nilai barcode_search
                var barcode = $(this).val();

                // Lakukan AJAX request ke controller CodeIgniter
                $.ajax({
                    url: '/transaction/searchProductByBarcode', // Ganti dengan URL sesuai kebutuhan
                    method: 'POST',
                    data: { barcode: barcode },
                    dataType: 'json',
                    success: function(response) {
                        // Handle response dari server, misalnya mengisi nilai input hidden
                        $('#product_id').val(response.product_id);
                        $('#val_selling_price').val(response.selling_price);
                        $('#val_product_name').val(response.product_name);
                        $('#val_product_qty').val(response.stock_product_qty);
                        // ... (isikan input hidden lainnya)

                        // Lainnya sesuaikan dengan kebutuhan
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
