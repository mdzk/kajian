<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{

    public function index()
    {

        $user       = new UsersModel();
        $data = [
            'user'  => $user->find(session()->get('id_users')),
            'users'  => $user->findAll(),
        ];
        return view('admin/users', $data);
    }

    public function delete()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        if ($data['picture'] !== 'default.jpg') {
            unlink('picture/' . $data['picture']);
        }
        $user->delete($this->request->getVar('id_users'));
        session()->setFlashdata('pesan', 'Akun berhasil dihapus');
        return redirect()->to('users');
    }

    public function update()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $data = [
                'name' => $this->request->getVar('name'),
            ];
            $user->set($data);
            $user->where('id_users', $this->request->getVar('id_users'));
            $user->update();

            session()->setFlashdata('pesan', 'Akun berhasil diedit');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }

    public function store()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'nik' => [
                'label' => 'NIK',
                'rules' => "required|is_unique[users.nik]|min_length[16]|max_length[16]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => '{field} sudah digunakan, cari yang lain!',
                    'min_length' => 'Minimal {field} 16 Angka',
                    'max_length' => 'Maksimal {field} 16 Angka',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "required|is_unique[users.email]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Email sudah digunakan, cari yang lain!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'password2' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' =>
                    '{field} Wajib diisi !',
                    'matches' => '{field} harus sama dengan Password!',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $user->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'nik' => $this->request->getVar('nik'),
                'status' => $this->request->getVar('status'),
                'role' => $this->request->getVar('role'),
                'verification' => true,
                'picture' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Akun baru berhasil dibuat');
            return redirect()->to('users');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('users');
        }
    }
}
