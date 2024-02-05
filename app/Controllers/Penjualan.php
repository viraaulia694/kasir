<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Penjualan extends BaseController
{
    protected $penjualan;

    public function __construct()
    {
        $this->penjualan = new PenjualanModel();
    }

    public function index()
    {
        $pelanggan = new PelangganModel();
        $data['pelanggans'] = $pelanggan->findAll();
        return view('v_penjualan', $data);
    }

    public function simpan()
    {
        $aturan = [
            'TglPenjualan' => [
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'TotalHarga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'PelangganID' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
        ];

        if (!$this->validate($aturan)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $data = [
                'TglPenjualan' => $this->request->getVar('TglPenjualan'),
                'TotalHarga' => $this->request->getVar('TotalHarga'),
                'PelangganID' => $this->request->getVar('PelangganID'),
            ];

            // Mode Tambah
            $this->penjualan->insert($data);
            session()->setFlashdata('pesan', 'Tambah data penjualan berhasil');
        }
        return redirect()->to('/penjualan/tampil');
    }

    public function tampil()
    {
        $data['penjualans'] = $this->penjualan->findAll(); // Mengambil semua data member
        return view('v_penjualantampil', $data);
    }

    public function delete($PenjualanID)
    {
        $this->penjualan->delete($PenjualanID); // Menghapus petugas berdasarkan nik
        session()->setFlashdata('pesan', 'Hapus data penjualan berhasil');
        return redirect()->to('/penjualan/tampil');
    }

    public function edit()
    {
        $data = [
            'TglPenjualan' => $this->request->getVar('TglPenjualan'),
            'TotalHarga' => $this->request->getVar('TotalHarga'),
            'PelangganID' => $this->request->getVar('PelangganID'),
        ];

        if ($this->request->getVar('PenjualanID')) {
            // Mode Edit
            $PenjualanID = $this->request->getVar('penju$PenjualanID');
            $this->penjualan->update($PenjualanID, $data);
            session()->setFlashdata('pesan', 'Update data petugas berhasil');
        }
        return redirect()->to('/penjualan/tampil');
    }


    public function pushedit($PenjualanID)
    {
        $data['penjualan'] = $this->penjualan->find($PenjualanID);
        return view('v_penjualanedit', $data);

        return redirect()->to('/penjualantampil');
    }
}
