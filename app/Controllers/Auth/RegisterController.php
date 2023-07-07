<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class RegisterController extends BaseController
{
    public function index()
    {
        echo view('auth/register');
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
            'username' => [
                'label' => 'Username',
                'rules' => "required|is_unique[users.username]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Username sudah digunakan, cari yang lain!'
                ]
            ],
            'nik' => [
                'label' => 'NIK',
                'rules' => "required|is_unique[users.nik]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'NIK sudah digunakan, cari yang lain!'
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
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'nik' => $this->request->getVar('nik'),
                'status' => $this->request->getVar('status'),
                'role' => 'user',
                'picture' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Selamat anda berhasil registrasi');
            return redirect()->to('login');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('register');
        }
    }
}