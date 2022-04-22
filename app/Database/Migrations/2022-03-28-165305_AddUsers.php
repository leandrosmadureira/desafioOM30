<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
{
    public function up()
    {
        $this->forge->createDatabase('desafioom30', true);
        $this->forge->addField([
            'users_id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nm_user'       => [
                'type'       => 'character varying',
                'constraint' => '150',
                'null' => false,
            ],
            'email'       => [
                'type'       => 'character varying',
                'constraint' => '150',
                'null' => false,
            ],
            'email_verified_at'       => [
                'type'       => 'timestamp',
                'null' => true,
            ],
            'password'       => [
                'type'       => 'character varying',
                'constraint' => '255',
                'null' => false,
            ],
            'photo'       => [
                'type'       => 'character varying',
                'constraint' => '100',
                'null' => true,
            ],
            'sn_active' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('users_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
