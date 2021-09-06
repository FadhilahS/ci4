<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Fadhilah S',
                'alamat'    => 'Jl jatijajar 1',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'orang 2',
                'alamat'    => 'Jl abc',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nama' => 'Fadhilah S',
                'alamat'    => 'Jl cba',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];


        // Simple Queries
        // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:,:created_at:,:updated_at:)", $data);

        // Using Query Builder
        // $this->db->table('Orang')->insert($data);
        $this->db->table('Orang')->insertBatch($data);
    }
}
