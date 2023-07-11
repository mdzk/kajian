<?php

namespace App\Controllers;

use App\Models\UsulanModel;

class RekapanController extends BaseController
{
    public function index()
    {
        $usulan = new UsulanModel();

        $data = [
            'usulan' => $usulan->join('users', 'users.id_users = usulan.users_id')
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('status_usulan', 'terverifikasi')
                ->orderBy('created_at', 'ASC')
                ->findAll(),
        ];
        return view('rekapan', $data);
    }

    public function show($id)
    {
        $usulan = new UsulanModel();
        $data = $usulan->find($id);
        if ($data == NULL) {
            return redirect()->to('rekapan');
        }
        $data = [
            'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->find($id),
        ];
        return view('rekapan-show', $data);
    }
}
