<?php

namespace App\Controllers;

use App\Models\ComicsModel;
use Config\App;
use Config\Validation;

class comics extends BaseController
{
    protected $ComicsModel;
    public function __construct()
    {
        $this->ComicsModel = new ComicsModel();
    }

    public function home()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('Comics/home', $data);
    }

    public function index()
    {
        // $comics = $this->ComicModel->findAll();

        $data = [
            'title' => 'Daftar komik',
            'Comics' => $this->ComicsModel->getComics()
        ];

        // cara konek ke db tanpa model

        // $db = \Config\Database::connect();
        // $comics = $db->query("SELECT * from comics");
        // foreach ($comics->getResultArray() as $row) {
        //   d($row);
        //}

        //$ComicModel = new \App\Models\ComicsModel();

        // $ComicModel = new ComicsModel();
        // dd($comics);

        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'detail Comic',
            'Comics' => $this->ComicsModel->getComics($slug)
        ];

        //jika komik tidak ada

        if (empty($data['Comics'])) {
            throw new \codeIgniter\Exceptions\PageNotFoundException('judul comics' . $slug . 'Tidak ditemukan');
        }

        return view('Comics/detail', $data);
    }

    public function create()
    {
        //session();
        $data = [
            'title' => 'Form to Add',
            'validation' => \Config\Services::validation()
        ];
        return view('Comics/create', $data);
    }

    public function save()
    {
        //validasi input data

        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[Comics.judul]',
                'errors' => [
                    'required' => '{field} Comic harus diisi!',
                    'is_unique' => '{field} Komik sudah terdaftar.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul, 2024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/Comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('/Comics/create')->withInput();
        }

        //ambil file gambar

        $fileSampul = $this->request->getFile('sampul');

        //apakah tidak ada gambar yang diupload

        if ($fileSampul->getError() == 4) {
            $namaSampul = 'bandar.jpg';
        } else {

            //generate nama sampul random

            $namaSampul = $fileSampul->getRandomName();

            //pindah file ke img

            $fileSampul->move('img');
        }



        //ambil nama file sampul

        // $namaSampul = $fileSampul->getName();




        $slug =  url_title($this->request->getVar('judul'), '-', true);
        $this->ComicsModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'data berhasil ditambahkan.');

        return redirect()->to('/Comics');
    }

    public function delete($id)
    {
        //cari gambar berdasarkan id

        $Comics = $this->ComicsModel->find($id);


        //cek jika file gambar default

        if ($Comics['sampul'] != 'bandar.jpg') {

            //hapus file

            unlink('img/' . $Comics['sampul']);
        }


        $this->ComicsModel->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus.');
        return redirect()->to('/Comics');
    }


    public function edit($slug)
    {
        $data = [
            'title' => 'Form to Edit',
            'validation' => \Config\Services::validation(),
            'Comics' => $this->ComicsModel->getComics($slug)

        ];


        return view('Comics/edit', $data);
    }
}
