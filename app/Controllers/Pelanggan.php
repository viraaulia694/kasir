<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pelanggan extends BaseController
{
    protected $pelanggan;

    function __construct()
    {
        $this->pelanggan = new PelangganModel();
    }

    public function index()
    {
        return view('v_pelanggan');
    }

    public function ambilSemua()
    {
        $data = $this->pelanggan->findAll(); //mengambil semua data dari tabel

        return json_encode($data); //merubah $data menjadi json
    }

    public function simpan()
    {
        $this->pelanggan->insert([
            'NamaPelanggan'=> $this->request->getVar('namaPelanggan'), //getVar('namaProduk') diambil bukan nama tabel tp yg warna biru yg sebelah kanan di v
            'Alamat'=> $this->request->getVar('alamat'), 
            'Tlp'=> $this->request->getVar('tlp')
        ]);

        return 'sukses';
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = $this->pelanggan->find($id);

        return json_encode($data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');

        $this->pelanggan->update($id,[
            'NamaPelanggan'=> $this->request->getVar('namaPelanggan'), //getVar('namaProduk') diambil bukan nama tabel tp yg warna biru yg sebelah kanan di v
            'Alamat'=> $this->request->getVar('alamat'), 
            'Tlp'=> $this->request->getVar('tlp')
        ]);
    }

    public function delete()
    {
        $id = $this->request->getVar('id');
        $this->pelanggan->delete($id);

    }
}