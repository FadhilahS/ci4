<?php

namespace App\Controllers;

use App\Models\AssignmentModel;
use Config\App;
use Config\Validation;

class Assignment extends BaseController
{
    protected $AssignmentModel;
    public function __construct()
    {
        $this->AssignmentModel = new AssignmentModel();
    }

    public function list()
    {
        $data = [
            'title' => 'List Assignments',
            'Assignment' => $this->AssignmentModel->getAssignment()

        ];
        return view('assignment/list', $data);
    }

    public function assign($slug, $assignment_id, $id)
    {
        $data = [
            'title' => 'Assignment Task',
            'Assignment' => $this->AssignmentModel->getAssignment($slug, $assignment_id, $id)
        ];

        //jika komik tidak ada

        if (empty($data['Assignment'])) {
            throw new \codeIgniter\Exceptions\PageNotFoundException('task_name assignment' . $slug . 'Tidak ditemukan');
        }

        return view('assignment/assign', $data);
    }

    public function detail()
    {
        // $data = [
        //   'title' => 'detail Comic',
        // 'Comics' => $this->ComicsModel->getComics($slug)
        //];

        //jika komik tidak ada

        //if (empty($data['Comics'])) {
        //  throw new \codeIgniter\Exceptions\PageNotFoundException('judul comics' . $slug . 'Tidak ditemukan');
        //}

        return view('assignment/detail');
    }

    public function create()
    {
        //session();
        $data = [
            'title' => 'Add Assignment',
            'validation' => \Config\Services::validation()
        ];
        return view('assignment/create', $data);
    }

    public function save()
    {
        //validasi input data

        if (!$this->validate([
            'task_name' => [
                'rules' => 'required|is_unique[Assignment.task_name]',
                'errors' => [
                    'required' => '{field} Assignment harus diisi!',
                    'is_unique' => '{field} Assignment sudah terdaftar.'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/assignment/create')->withInput()->with('validation', $validation);
        }



        $slug =  url_title($this->request->getVar('task_name'), '-', true);
        $this->AssignmentModel->save([
            'task_name' => $this->request->getVar('task_name'),
            'slug' => $slug,
            'description' => $this->request->getVar('description'),
            'id' => $this->request->getVar('id'),
            'point' => $this->request->getVar('point'),
            'due_date' => $this->request->getVar('due_date')
        ]);

        session()->setFlashdata('pesan', 'data berhasil ditambahkan.');

        return redirect()->to('/assignment/list');
    }

    public function delete($id)
    {
        $this->AssignmentModel->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus.');
        return redirect()->to('/assignment/list');
    }


    public function edit($slug, $assignment_id, $id)
    {
        $data = [
            'title' => 'Edit Task',
            'validation' => \Config\Services::validation(),
            'Assignment' => $this->AssignmentModel->getAssignment($slug, $assignment_id, $id)

        ];


        return view('assignment/edit', $data);
    }
    public function update($slug)
    {
        // cek judul

        $taskLama = $this->AssignmentModel->getAssignment($this->request->getVar('slug'));
        if ($taskLama['task_name'] == $this->request->getVar('task_name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[Assignment.task_name]';
        }

        if (!$this->validate([
            'task_name' => [
                'rules' => $rule_name,
                'errors' => [
                    'required' => '{field}  harus diisi!',
                    'is_unique' => '{field} Assign sudah terdaftar.'
                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            // return redirect()->to('/Comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('/assignment/edit' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug =  url_title($this->request->getVar('task_name'), '-', true);
        $this->AssignmentModel->save([
            'slug' => $slug,
            'assignment_id' => $this->request->getVar('assignment_id'),
            'task_name' => $this->request->getVar('task_name'),
            'description' => $this->request->getVar('description'),
            'id' => $this->request->getVar('id'),
            'point' => $this->request->getVar('point'),
            'due_date' => $this->request->getVar('due_date')

        ]);

        session()->setFlashdata('pesan', 'data berhasil diubah.');

        return redirect()->to('/assignment/list');
    }
}
