<?php

namespace App\Controllers;

class pages extends BaseController
{
    public function index()
    {
        $data = [
            "title" => "Home | CI",
            "tes" => ['satu', 'dua', 'tiga']
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            "title" => "about"
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'jln. Jatijajar no. 03',
                    'kota' => 'Depok'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'jln. mawar no. 09',
                    'kota' => 'Depok'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
