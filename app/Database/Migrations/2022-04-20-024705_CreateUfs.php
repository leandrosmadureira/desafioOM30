<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUfs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ufs_id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'short_name'       => [
                'type'       => 'character varying',
                'constraint' => '2',
                'null' => false,
            ],
            'long_name'       => [
                'type'       => 'character varying',
                'constraint' => '150',
                'null' => false,
            ],
            'created_at'       => [
                'type'       => 'datetime',
                'null' => true,
            ],
            'updated_at'       => [
                'type'       => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('ufs_id', true);
        $this->forge->createTable('ufs');
    }

    public function down()
    {
        $this->forge->dropTable('ufs');
    }
}
