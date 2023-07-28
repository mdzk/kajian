<?php

namespace App\Controllers;

use App\Models\KajianModel;
use App\Models\UsulanModel;

class UsulanController extends BaseController
{
    public function index()
    {
        $usulan = new UsulanModel();
        if (get_user('role') == 'user') {
            $data = [
                'usulan' => $usulan->where(['users_id' => session('id_users')])
                    ->where(['status_usulan !=' => 'terverifikasi'])
                    ->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->findAll(),
            ];
        }

        if (get_user('role') == 'pimpinan') {
            $data = [
                'usulan' => $usulan->where(['status_usulan' => 'proses'])
                    ->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->findAll(),
            ];
        }

        if (get_user('role') == 'admin') {
            $data = [
                'usulan' => $usulan->where(['status_usulan' => 'pending'])
                    ->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->findAll(),
            ];
        }
        return view('usulan', $data);
    }

    public function store()
    {
        if ($this->validate([
            'prihal' => [
                'label' => 'Prihal Pengajuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'instansi' => [
                'label' => 'Nama Instansi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'file_ktp' => [
                'label' => 'File KTP',
                'rules' => 'uploaded[file_ktp]|max_size[file_ktp,10240]|mime_in[file_ktp,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi !',
                    'max_size' => 'Ukuran {field} max 10 Mb',
                    'mime_in' => 'Format {field} wajib png, jpg, dan jpeg',
                ]
            ],
            'file_permohonan' => [
                'label' => 'File Permohonan',
                'rules' => 'uploaded[file_permohonan]|max_size[file_permohonan,10240]|mime_in[file_permohonan,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi !',
                    'max_size' => 'Ukuran {field} max 10 Mb',
                    'mime_in' => 'Format {field} wajib pdf',
                ]
            ],
        ])) {
            $usulan = new UsulanModel();

            $file_ktp = $this->request->getFile('file_ktp');
            $file_permohonan = $this->request->getFile('file_permohonan');
            $file_ktpName = $file_ktp->getRandomName();
            $file_permohonanName = $file_permohonan->getRandomName();

            $usulan->save([
                'prihal_usulan' => $this->request->getVar('prihal'),
                'instansi' => $this->request->getVar('instansi'),
                'id_kajian' => $this->request->getVar('id_kajian'),
                'status_usulan' => 'pending',
                'users_id' => session('id_users'),
                'file_ktp' => $file_ktpName,
                'file_permohonan' => $file_permohonanName,
            ]);

            $file_ktp->move('bukti', $file_ktpName);
            $file_permohonan->move('bukti', $file_permohonanName);

            session()->setFlashdata('pesan', 'Pengajuan berhasil');
            return redirect()->back()->withInput();
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        if (get_user('role') !== 'user') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        if ($usulan->find($id) == NULL) {
            return redirect()->to('usulan');
        }
        $usulanData = $usulan->where('users_id', session('id_users'))->whereIn('status_usulan', ['revisi', 'revisiadmin', 'tolak', 'pending'])->find($id);
        if ($usulanData === null) {
            return redirect()->to('usulan');
        }

        $data = [
            'usulan'  => $usulan->join('kajian', 'kajian.id_kajian = usulan.id_kajian')->find($id),
        ];
        return view('usulan-edit', $data);
    }

    public function update()
    {
        if ($this->validate([
            'prihal' => [
                'label' => 'Prihal Pengajuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'instansi' => [
                'label' => 'Nama Instansi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $usulan = new UsulanModel();

            $id = $this->request->getVar('id_usulan');
            if (get_user('role') !== 'user') {
                return redirect()->to('usulan');
            }
            if ($usulan->find($id) == NULL) {
                return redirect()->to('usulan');
            }
            $usulanData = $usulan->where('users_id', session('id_users'))->whereIn('status_usulan', ['revisi', 'revisiadmin', 'tolak', 'pending'])->find($id);
            if ($usulanData === null) {
                return redirect()->to('usulan');
            }

            $file_ktp = $this->request->getFile('file_ktp');
            $file_permohonan = $this->request->getFile('file_permohonan');

            if ($file_ktp->isValid() && !$file_ktp->hasMoved()) {
                $file_ktpName = $file_ktp->getRandomName();

                if (file_exists('bukti/' . $usulanData['file_ktp'])) {
                    unlink('bukti/' . $usulanData['file_ktp']);
                }

                $file_ktp->move('bukti', $file_ktpName);
            } else {
                $file_ktpName = $usulanData['file_ktp'];
            }

            if ($file_permohonan->isValid() && !$file_permohonan->hasMoved()) {
                $file_permohonanName = $file_permohonan->getRandomName();

                if (file_exists('bukti/' . $usulanData['file_permohonan'])) {
                    unlink('bukti/' . $usulanData['file_permohonan']);
                }

                $file_permohonan->move('bukti', $file_permohonanName);
            } else {
                $file_permohonanName = $usulanData['file_permohonan'];
            }

            $data = [
                'status_usulan' => $usulanData['status_usulan'] == 'revisiadmin' ? 'pending' : 'proses',
                'keterangan' => NULL,
                'prihal_usulan' => $this->request->getVar('prihal'),
                'instansi' => $this->request->getVar('instansi'),
                'file_ktp' => $file_ktpName,
                'file_permohonan' => $file_permohonanName,
            ];

            $usulan->set($data);
            $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
            $usulan->update();

            session()->setFlashdata('pesan', 'Pengajuan revisi berhasil');
            return redirect()->to('usulan');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }
    public function delete()
    {
        $id = $this->request->getVar('id_usulan');
        if (get_user('role') !== 'user') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        if ($usulan->find($id) == NULL) {
            return redirect()->to('usulan');
        }
        $usulanData = $usulan->where('users_id', session('id_users'))->find($id);
        if ($usulanData === null) {
            return redirect()->to('usulan');
        }

        unlink('bukti/' . $usulanData['file_permohonan']);
        unlink('bukti/' . $usulanData['file_ktp']);

        $usulan->delete($this->request->getVar('id_usulan'));
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('usulan');
    }

    // file authorized
    public function redirect($property)
    {
        if (get_user('role') == 'user') {
            $usulan = new UsulanModel();
            $data   = $usulan->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('usulan.id_kajian', $property)
                ->where('users_id', session('id_users'))
                ->where('status_usulan', 'terverifikasi')
                ->first();
            if ($data == NULL) {
                return redirect()->back();
            }
            return redirect()->to(base_url('file/' . $data['file']));
        } else {
            $kajian = new KajianModel();
            $data   = $kajian->find($property);
            return redirect()->to(base_url('file/' . $data['file']));
        }
    }

    // status change
    public function process()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        $data = [
            'status_usulan' => 'proses',
        ];
        $usulan->set($data);
        $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
        $usulan->update();

        session()->setFlashdata('pesan', 'Data berhasil diverifikasi');
        return redirect()->to('usulan');
    }

    public function verification()
    {
        if (get_user('role') !== 'pimpinan') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        $data = [
            'status_usulan' => 'terverifikasi',
        ];
        $usulan->set($data);
        $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
        $usulan->update();

        session()->setFlashdata('pesan', 'Data berhasil diverifikasi');
        return redirect()->to('usulan');
    }

    public function revisionAdmin()
    {
        if (get_user('role') !== 'admin') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        $data = [
            'status_usulan' => 'revisiadmin',
            'keterangan' => $this->request->getVar('keterangan'),
        ];
        $usulan->set($data);
        $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
        $usulan->update();

        session()->setFlashdata('pesan', 'Data berhasil direvisi');
        return redirect()->to('usulan');
    }

    public function revision()
    {
        if (get_user('role') !== 'pimpinan') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        $data = [
            'status_usulan' => 'revisi',
            'keterangan' => $this->request->getVar('keterangan'),
        ];
        $usulan->set($data);
        $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
        $usulan->update();

        session()->setFlashdata('pesan', 'Data berhasil direvisi');
        return redirect()->to('usulan');
    }

    public function decline()
    {
        if (get_user('role') !== 'pimpinan') {
            return redirect()->to('usulan');
        }
        $usulan = new UsulanModel();
        $data = [
            'status_usulan' => 'tolak',
            'keterangan' => $this->request->getVar('keterangan'),
        ];
        $usulan->set($data);
        $usulan->where('id_usulan', $this->request->getVar('id_usulan'));
        $usulan->update();

        session()->setFlashdata('pesan', 'Data berhasil ditolak');
        return redirect()->to('usulan');
    }

    public function show($id)
    {
        $usulan = new UsulanModel();
        $data = $usulan->find($id);
        if ($data == NULL) {
            return redirect()->to('usulan');
        }

        if (get_user('role') == 'user' && !$usulan->where('users_id', get_user('id_users'))->find($id)) {
            return redirect()->to('usulan');
        }

        $data = [
            'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->find($id),
        ];
        return view('usulan-show', $data);
    }
}
