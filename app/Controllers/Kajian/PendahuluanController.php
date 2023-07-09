<?php

namespace App\Controllers\Kajian;

use App\Controllers\BaseController;

use App\Models\KajianModel;

class PendahuluanController extends BaseController
{
    public function index()
    {
        $kajian = new KajianModel();
        $data   = [
            'kajian' => $kajian->where('tipe', 'dahulu')->findAll(),
        ];
        return view('admin/dahulu', $data);
    }

    public function add()
    {
        return view('admin/dahulu-add');
    }

    public function store()
    {
        if ($this->validate([
            'kajian' => [
                'label' => 'Kajian',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'bidang' => [
                'label' => 'Bidang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'prihal' => [
                'label' => 'Prihal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|mime_in[file,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'mime_in' => 'Format {field} wajib pdf',
                ]
            ]
        ])) {
            $kajian = new KajianModel();

            $file = $this->request->getFile('file');
            $fileName = $file->getRandomName();
            $file->move('file', $fileName);

            $kajian->save([
                'nama_kajian' => $this->request->getVar('kajian'),
                'bidang' => $this->request->getVar('bidang'),
                'prihal' => $this->request->getVar('prihal'),
                'tipe' => 'dahulu',
                'file' => $fileName
            ]);

            session()->setFlashdata('pesan', 'Kajian berhasil ditambahkan');
            return redirect()->to('kajian/dahulu');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }
}
