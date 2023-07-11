<?php

namespace App\Controllers;

use App\Models\UsersModel;

class VerificationController extends BaseController
{

    public function index()
    {
        $user       = new UsersModel();
        $data = [
            'users'  => $user->where('verification', false)->findAll(),
        ];
        return view('admin/verification', $data);
    }

    public function update()
    {
        $user = new UsersModel();
        $data = [
            'verification' => true,
        ];
        $user->set($data);
        $user->where('id_users', $this->request->getVar('id_users'));
        $user->update();

        session()->setFlashdata('pesan', 'Akun berhasil diverifikasi');
        return redirect()->to('verification');
    }
}
