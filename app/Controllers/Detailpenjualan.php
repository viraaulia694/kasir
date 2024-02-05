<?php

namespace App\Controllers;

use App\Models\DetailPenjualanModel;
use CodeIgniter\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil data POST dari permintaan AJAX
        $barcode = $this->request->getPost('barcode');

        // Panggil model untuk mencari produk berdasarkan barcode
        $productModel = new ProductModel();
        $product = $productModel->getProductByBarcode($barcode);

        // Kirim response dalam format JSON
        return $this->response->setJSON($product);
    }
}
