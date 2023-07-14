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
                'role' => 'user',
                'verification' => false,
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
