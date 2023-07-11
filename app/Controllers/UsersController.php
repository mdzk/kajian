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
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $data = [
                'role' => $this->request->getVar('role'),
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
}
