<?php

namespace App\Controllers;

use App\Models\KajianModel;
use App\Models\UsersModel;
use App\Models\UsulanModel;

class Home extends BaseController
{
    public function index()
    {

        $kajian = new KajianModel();
        $user = new UsersModel();
        $usulan = new UsulanModel();

        if (get_user('role') == 'admin') {
            $data = [
                'kajian'  => $kajian->countAllResults(),
                'usulan'  => $usulan->where('status_usulan', 'pending')->countAllResults(),
                'rekapan' => $usulan->where('status_usulan', 'terverifikasi')->countAllResults(),
                'user'    => $user->where('role', 'user')->where('verification', true)->countAllResults(),
            ];
        }

        if (get_user('role') == 'pimpinan') {
            $data = [
                'kajian'  => $kajian->countAllResults(),
                'usulan'  => $usulan->where('status_usulan', 'proses')->countAllResults(),
            ];
        }

        if (get_user('role') == 'user') {
            $data = [
                'kajian'  => $kajian->countAllResults(),
                'usulan'  => $usulan->where(['users_id' => session('id_users')])
                    ->where(['status_usulan !=' => 'terverifikasi'])
                    ->countAllResults(),
            ];
        }

        return view('home', $data);
    }

    public function kajian()
    {
        function bulan($a)
        {
            $usulan = new UsulanModel();
            $bulan = $usulan->where('MONTH(created_at)', $a)
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('YEAR(created_at)', date('Y'))
                ->where('status_usulan', 'terverifikasi')
                ->countAllResults();
            return $bulan;
        };
        $month = array(bulan(1), bulan(2), bulan(3), bulan(4), bulan(5), bulan(6), bulan(7), bulan(8), bulan(9), bulan(10), bulan(11), bulan(12));
        return print_r(json_encode(array_values($month)));
    }
}
