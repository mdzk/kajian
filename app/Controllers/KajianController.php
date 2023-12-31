<?php

namespace App\Controllers;

use App\Models\KajianModel;
use App\Models\UsulanModel;

class KajianController extends BaseController
{
    public function index()
    {
        $kajian = new KajianModel();
        $data   = [
            'kajian' => $kajian->findAll(),
        ];
        return view('admin/kajian', $data);
    }

    public function add()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('kajian');
        }
        return view('admin/kajian-add');
    }

    public function store()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('kajian');
        }
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
            'tanggal' => [
                'label' => 'Tanggal',
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
            if ($kajian->where('nama_kajian', $this->request->getVar('kajian'))->first() > 0) {
                session()->setFlashdata('errors', ['kajian' => 'Nama kajian sudah terdaftar, ganti nama kajian lain!']);
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('file');
            $fileName = $file->getRandomName();
            $file->move('file', $fileName);

            $kajian->save([
                'nama_kajian' => $this->request->getVar('kajian'),
                'bidang' => $this->request->getVar('bidang'),
                'prihal' => $this->request->getVar('prihal'),
                'tanggal' => $this->request->getVar('tanggal'),
                'file' => $fileName
            ]);

            session()->setFlashdata('pesan', 'Kajian berhasil ditambahkan');
            return redirect()->to('kajian');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function delete()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('kajian');
        }
        $kajian = new KajianModel();
        if ($kajian->find($this->request->getVar('id_kajian')) == NULL) {
            return redirect()->to('kajian');
        }
        $data = $kajian->find($this->request->getVar('id_kajian'));
        unlink('file/' . $data['file']);
        $kajian->delete($this->request->getVar('id_kajian'));
        session()->setFlashdata('pesan', 'Kajian berhasil dihapus');
        return redirect()->to('kajian');
    }

    public function edit($id)
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('kajian');
        }
        $kajian = new KajianModel();
        if ($kajian->find($id) == NULL) {
            return redirect()->to('kajian');
        }
        $data = [
            'kajian'  => $kajian->find($id),
        ];
        return view('admin/kajian-edit', $data);
    }

    public function update()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('kajian');
        }
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
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $kajian = new KajianModel();
            $cekKajianSekarang  = $kajian->find($this->request->getVar('id_kajian'));
            $cekKajian  = $kajian->where('nama_kajian', $this->request->getVar('kajian'))->first();

            if ($cekKajianSekarang['nama_kajian'] !== $this->request->getVar('kajian')) {
                if ($cekKajian !== NULL) {
                    Session()->setFlashdata('errors', ['kajian' => 'Nama kajian sudah terdaftar, ganti nama kajian lain!']);
                    return redirect()->back()->withInput();
                }
            }

            $file = $this->request->getFile('file');
            if ($file->getError() == 4) {
                $data = [
                    'nama_kajian' => $this->request->getVar('kajian'),
                    'bidang' => $this->request->getVar('bidang'),
                    'prihal' => $this->request->getVar('prihal'),
                    'tanggal' => $this->request->getVar('tanggal'),
                ];
            } else {
                if ($this->validate([
                    'file' => [
                        'label' => 'File',
                        'rules' => 'uploaded[file]|mime_in[file,application/pdf]',
                        'errors' => [
                            'uploaded' => '{field} Wajib diisi!',
                            'mime_in' => 'Format {field} wajib pdf',
                        ]
                    ]
                ])) {
                    $fileName = $file->getRandomName();
                    $data = [
                        'nama_kajian' => $this->request->getVar('kajian'),
                        'bidang' => $this->request->getVar('bidang'),
                        'prihal' => $this->request->getVar('prihal'),
                        'tanggal' => $this->request->getVar('tanggal'),
                        'file' => $fileName,
                    ];

                    $thisData = $kajian->find($this->request->getVar('id_kajian'));
                    unlink('file/' . $thisData['file']);
                    $file->move('file', $fileName);
                } else {
                    Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
                    return redirect()->back()->withInput();
                }
            }

            $kajian->set($data);
            $kajian->where('id_kajian', $this->request->getVar('id_kajian'));
            $kajian->update();

            session()->setFlashdata('pesan', 'Kajian berhasil diubah');
            return redirect()->to('kajian');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        if (get_user('role') == 'user') {
            $usulan = new UsulanModel();
            $data   = $usulan->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('usulan.id_kajian', $id)
                ->where('users_id', session('id_users'))
                ->where('status_usulan', 'terverifikasi')
                ->first();
            if ($data == NULL) {
                return redirect()->to('kajian');
            }
        }

        $kajian = new KajianModel();
        $data = $kajian->find($id);
        if ($data == NULL) {
            return redirect()->to('kajian');
        }
        $data = [
            'kajian'  => $kajian->find($id),
        ];
        return view('admin/kajian-show', $data);
    }
}
