<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function rekapan()
    {
        $filename = date('y-m-d-H-i-s') . '-rekapan';
        $dompdf = new Dompdf();
        $filter = $this->request->getVar('tipe');
        $usulan = new UsulanModel();
        if ($filter == 'semua') {
            $data = [
                'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
            ];
        }

        if ($filter == 'dahulu') {
            $data = [
                'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->where('tipe', 'dahulu')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
            ];
        }

        if ($filter == 'antara') {
            $data = [
                'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->where('tipe', 'antara')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
            ];
        }

        if ($filter == 'akhir') {
            $data = [
                'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                    ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                    ->where('status_usulan', 'terverifikasi')
                    ->where('tipe', 'akhir')
                    ->orderBy('created_at', 'ASC')
                    ->findAll(),
            ];
        }

        $dompdf->loadHtml(view('/export/pdf_rekapan', $data));
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
        exit();
    }
}
