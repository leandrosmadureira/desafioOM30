<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'nm_user' => 'root',
            'email'    => 'soreas.madu@gmail.com',
            'password' => password_hash('123',PASSWORD_DEFAULT),
            'sn_active'=> 'S'
        ];
        $this->db->table('users')->insert($data);
    }
}
