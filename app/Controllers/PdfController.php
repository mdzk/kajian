<?php

namespace App\Controllers;

use App\Models\UsulanModel;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function rekapanSemua()
    {
        $filename = date('y-m-d-H-i-s') . '-rekapan';
        $dompdf = new Dompdf();
        $filter = $this->request->getVar('tipe');
        $usulan = new UsulanModel();
        $data = [
            'data'  => $usulan->join('users', 'users.id_users = usulan.users_id')
                ->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('status_usulan', 'terverifikasi')
                ->orderBy('created_at', 'ASC')
                ->findAll(),
        ];

        $dompdf->loadHtml(view('/export/pdf_rekapan', $data));
        $dompdf->setPaper(array(0, 0, 609.4488, 935.433), 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
        exit();
    }
}
