<?php

namespace App\Controllers;

use App\Models\UsulanModel;

class RekapanController extends BaseController
{
    public function index()
    {
        helper('form');
        $usulan = new UsulanModel();

        $usulanTerlama = $usulan->where('status_usulan', 'terverifikasi')->where('created_at <=', date('Y-m-d'))->orderBy('created_at', "ASC")->first();
        $usulanTerbaru = $usulan->where('status_usulan', 'terverifikasi')->where('created_at <=', date('Y-m-d'))->orderBy('created_at', "DESC")->first();

        if (!empty($usulanTerlama)) {
            $data = [
                'usulan' => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
                'usulan_terbaru' => date('Y', strtotime($usulanTerbaru['created_at'])),
                'usulan_lama' => date('Y', strtotime($usulanTerlama['created_at'])),
            ];
        } else {
            $data = [
                'usulan' => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
                'usulan_terbaru' => date('Y'),
                'usulan_lama' => date('Y'),
            ];
        }
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
