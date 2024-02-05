<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        //membuat field pada tabel users
        $this->forge->addField([
            'username' => [
                'type'  => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'  => 'TEXT',
            ],
            'nama' => [
                'type'  => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
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
        $this->forge->addKey('username', TRUE); //primary key username
        $this->forge->createTable('users', TRUE); //nama tabel users
    }

    public function down()
    {
        // menghapus tabel users
        $this->forge->dropTable('users');
    }
}
