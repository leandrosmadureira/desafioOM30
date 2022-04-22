<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class UfBr extends Seeder
{
    public function run()
    {
        $data = [
            ['short_name' => 'AC', 'long_name' => 'Acre','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'AL', 'long_name' => 'Alagoas','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'AP', 'long_name' => 'Amapá','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'AM', 'long_name' => 'Amazonas','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'BA', 'long_name' => 'Bahia','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'CE', 'long_name' => 'Ceará','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'DF', 'long_name' => 'Distrito Federal','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'ES', 'long_name' => 'Espírito Santo','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'GO', 'long_name' => 'Goiás','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'MA', 'long_name' => 'Maranhão','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'MT', 'long_name' => 'Mato Grosso','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'MS', 'long_name' => 'Mato Grosso do Sul','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'MG', 'long_name' => 'Minas Gerais','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'PA', 'long_name' => 'Pará','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'PB', 'long_name' => 'Paraíba','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'PR', 'long_name' => 'Paraná','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'PE', 'long_name' => 'Pernambuco','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'PI', 'long_name' => 'Piauí','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'RJ', 'long_name' => 'Rio de Janeiro','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'RN', 'long_name' => 'Rio Grande do Norte','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'RS', 'long_name' => 'Rio Grande do Sul','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'RO', 'long_name' => 'Rondônia','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'RR', 'long_name' => 'Roraima','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'SC', 'long_name' => 'Santa Catarina','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'SP', 'long_name' => 'São Paulo','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'SE', 'long_name' => 'Sergipe','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')],
            ['short_name' => 'TO', 'long_name' => 'Tocantins','created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')]
        ];
        foreach($data as $v){
            $this->db->table('ufs')->insert($v);
        }
        
    }
}
