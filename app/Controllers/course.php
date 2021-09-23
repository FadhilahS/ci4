<?php

namespace App\Controllers;

use App\Models\CourseModel;
use Config\App;
use Config\Validation;

class course extends BaseController
{
    protected $CourseModel;
    public function __construct()
    {
        $this->CourseModel = new CourseModel();
    }


    public function index()
    {
        // $comics = $this->ComicModel->findAll();

        $data = [
            'title' => 'Daftar Course',
            'Course' => $this->CourseModel->getCourse()
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

        return view('course/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Course',
            'title2' => 'List Assignments',
            'Course' => $this->CourseModel->getCourse($id),
            'Assignment' => $this->CourseModel->getAssignment($id)

        ];

        //jika komik tidak ada

        if (empty($data['Course'])) {
            throw new \codeIgniter\Exceptions\PageNotFoundException('course_name Course' . $id . 'Tidak ditemukan');
        }

        return view('course/detail', $data);
    }

    public function create()
    {
        //session();
        $data = [
            'title' => 'Add Course',
            'validation' => \Config\Services::validation()
        ];
        return view('course/create', $data);
    }

    public function save()
    {
        //validasi input data

        if (!$this->validate([
            'course_name' => [
                'rules' => 'required|is_unique[Course.course_name]',
                'errors' => [
                    'required' => '{field}  harus diisi!',
                    'is_unique' => '{field} Course sudah terdaftar.'
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
            $validation = \Config\Services::validation();
            return redirect()->to('/course/create')->withInput()->with('validation', $validation);
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



        $this->CourseModel->save([
            'course_name' => $this->request->getVar('course_name'),
            'trainer_name' => $this->request->getVar('trainer_name'),
            'description' => $this->request->getVar('description'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'data berhasil ditambahkan.');

        return redirect()->to('/course');
    }

    public function delete($id)
    {
        //cari gambar berdasarkan id


        //cek jika file gambar default

        // if ($Course['sampul'] != 'bandar.jpg') {

        //hapus file

        //  unlink('img/' . $Course['sampul']);
        // }


        $this->CourseModel->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus.');
        return redirect()->to('/course');
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Course',
            'validation' => \Config\Services::validation(),
            'Course' => $this->CourseModel->getCourse($id)

        ];


        return view('course/edit', $data);
    }
    public function update($id)
    {
        // cek judul

        $courseLama = $this->CourseModel->getCourse($this->request->getVar('id'));
        if ($courseLama['course_name'] == $this->request->getVar('course_name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[Course.course_name]';
        }

        if (!$this->validate([
            'course_name' => [
                'rules' => $rule_name,
                'errors' => [
                    'required' => '{field}  harus diisi!',
                    'is_unique' => '{field} Course sudah terdaftar.'
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
            $validation = \Config\Services::validation();
            return redirect()->to('/course/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }

        $this->CourseModel->save([
            'id' => $id,
            'course_name' => $this->request->getVar('course_name'),
            'trainer_name' => $this->request->getVar('trainer_name'),
            'description' => $this->request->getVar('description'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'data berhasil diubah.');

        return redirect()->to('/course');
    }
}
