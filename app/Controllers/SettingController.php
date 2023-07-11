<?php

namespace App\Controllers;

use App\Models\UsersModel;

class SettingController extends BaseController
{

    public function index()
    {
        $user       = new UsersModel();
        $data = [
            'user'  => $user->find(get_user('id_users')),
        ];
        return view('admin/setting', $data);
    }

    public function update()
    {
        $user = new UsersModel();
        $data = $user->find($this->request->getVar('id_users'));
        $id = $data['id_users'];
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
                'rules' => "required|is_unique[users.username, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Username sudah digunakan, cari yang lain!'
                ]
            ],
            'nik' => [
                'label' => 'NIK',
                'rules' => "required|is_unique[users.nik, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'NIK sudah digunakan, cari yang lain!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "required|is_unique[users.email, id_users, $id]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'email sudah digunakan, cari yang lain!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'file' => [
                'label' => 'Foto',
                'rules' => 'max_size[file,10240]|mime_in[file,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 10 Mb',
                    'mime_in' => 'Format {field} wajib png, jpg, dan jpeg',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('file');
            if ($foto->getError() == 4) {
                $user->replace([
                    'id_users' => $this->request->getVar('id_users'),
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'username' => $this->request->getVar('username') ? $this->request->getVar('username') : $data['username'],
                    'nik' => $this->request->getVar('nik') ? $this->request->getVar('nik') : $data['nik'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'status' => $this->request->getVar('status') ? $this->request->getVar('status') : $data['status'],
                    'role' => $data['role'],
                    'verification' => $data['verification'],
                    'picture' => $data['picture'],
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ]);
            } else {
                $nama_file = $foto->getRandomName();
                $user->replace([
                    'id_users' => $this->request->getVar('id_users'),
                    'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $data['name'],
                    'username' => $this->request->getVar('username') ? $this->request->getVar('username') : $data['username'],
                    'nik' => $this->request->getVar('nik') ? $this->request->getVar('nik') : $data['nik'],
                    'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $data['email'],
                    'status' => $this->request->getVar('status') ? $this->request->getVar('status') : $data['status'],
                    'role' => $data['role'],
                    'verification' => $data['verification'],
                    'picture' => $nama_file,
                    'password' => empty($this->request->getVar('password')) ? $data['password'] : password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ]);
                if ($data['picture'] !== 'default.jpg') {
                    unlink('picture/' . $data['picture']);
                }
                $foto->move('picture', $nama_file);
            }

            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->to('setting');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('setting');
        }
    }
}
