<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPenjualan extends Migration
{
    public function up()
    {
       $this->forge->addField([
            'PenjualanID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true, 
                'unsigned' => true,
            ],
            'TglPenjualan' => [
                'type' => 'DATE',
            ],
            'TotalHarga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'PelangganID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('PenjualanID');
        $this->forge->createTable('tb_penjualan');

    }

    public function down()
    {
       $this->forge->dropTable('tb_penjualan');
    }
}
