<?php

namespace App\Controllers;

use App\Models\KajianModel;
use App\Models\UsersModel;
use App\Models\UsulanModel;

class Home extends BaseController
{
    public function index()
    {
        if (get_user('role') == 'user') {
            // return redirect()->to('kajian/dahulu');
            return view('home');
        }

        $kajian = new KajianModel();
        $user = new UsersModel();

        $data = [
            'dahulu' => $kajian->where('tipe', 'dahulu')->countAllResults(),
            'antara' => $kajian->where('tipe', 'antara')->countAllResults(),
            'akhir' => $kajian->where('tipe', 'akhir')->countAllResults(),
            'user' => $user->where('role', 'user')->where('verification', true)->countAllResults(),
        ];

        return view('home', $data);
    }

    public function pendahuluan()
    {
        function bulan($a)
        {
            $usulan = new UsulanModel();
            $bulan = $usulan->where('MONTH(created_at)', $a)
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('YEAR(created_at)', date('Y'))
                ->where('status_usulan', 'terverifikasi')
                ->where('tipe', 'dahulu')
                ->countAllResults();
            return $bulan;
        };
        $month = array(bulan(1), bulan(2), bulan(3), bulan(4), bulan(5), bulan(6), bulan(7), bulan(8), bulan(9), bulan(10), bulan(11), bulan(12));
        return print_r(json_encode(array_values($month)));
    }

    public function antara()
    {
        function bulanAntara($a)
        {
            $usulan = new UsulanModel();
            $bulanAntara = $usulan->where('MONTH(created_at)', $a)
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('YEAR(created_at)', date('Y'))
                ->where('status_usulan', 'terverifikasi')
                ->where('tipe', 'antara')
                ->countAllResults();
            return $bulanAntara;
        };
        $month = array(bulanAntara(1), bulanAntara(2), bulanAntara(3), bulanAntara(4), bulanAntara(5), bulanAntara(6), bulanAntara(7), bulanAntara(8), bulanAntara(9), bulanAntara(10), bulanAntara(11), bulanAntara(12));
        return print_r(json_encode(array_values($month)));
    }

    public function akhir()
    {
        function bulanAkhir($a)
        {
            $usulan = new UsulanModel();
            $bulanAkhir = $usulan->where('MONTH(created_at)', $a)
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('YEAR(created_at)', date('Y'))
                ->where('status_usulan', 'terverifikasi')
                ->where('tipe', 'akhir')
                ->countAllResults();
            return $bulanAkhir;
        };
        $month = array(bulanAkhir(1), bulanAkhir(2), bulanAkhir(3), bulanAkhir(4), bulanAkhir(5), bulanAkhir(6), bulanAkhir(7), bulanAkhir(8), bulanAkhir(9), bulanAkhir(10), bulanAkhir(11), bulanAkhir(12));
        return print_r(json_encode(array_values($month)));
    }
}
