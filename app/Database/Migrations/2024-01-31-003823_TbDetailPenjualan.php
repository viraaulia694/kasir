<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDetailPenjualan extends Migration
{
    public function up()
    {
          // Membuat tabel produk
          $this->forge->addField([
            'DetailID' => [
                'type'  => 'INT',
                'constraint' => '11',
                //gunakan kedua syntax dibawah ini untuk field yg akan digunakan pk atau fk
                'auto_increment' => true, 
                'unsigned' => true,
            ],
            'PenjualanID' => [
                'type'  => 'INT',
                'constraint' => '11',
            ],
            'ProdukID' => [
                'type'  => 'INT',
                'constraint' => '11',
            ],
            'JumlahProduk' => [
                'type'  => 'INT',
                'constraint' => '11',
            ],
            'Subtotal' => [
                'type'  => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [   // panah dua array asosiatif
                'type' => 'DATETIME',
                'null'=>true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null'=>true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null'=>true,
            ],
        ]);
    $this->forge->addKey('DetailID', TRUE); //panah satu class/fungsi
    $this->forge->createTable('tb_detailpenjualan', TRUE);
    }

    public function down()
    {
        // Menghapus tabel outlet
        $this->forge->dropTable('tb_detailpenjualan');
    }
}
