<?php

use App\Models\UsulanModel;

if (!function_exists('cekUsulan')) {
    function cekUsulan($idUser, $idKajian, $status)
    {
        $usulanModel = new UsulanModel();

        if ($status == NULL) {
            $dataExists = $usulanModel->where(['users_id' => $idUser, 'id_kajian' => $idKajian])->countAllResults();
        }

        if ($status !== NULL) {
            $dataExists = $usulanModel->join('kajian', 'kajian.id_kajian = usulan.id_kajian')
                ->where('usulan.id_kajian', $idKajian)
                ->where('users_id', $idUser)
                ->where('status_usulan', $status)
                ->first();
        }

        if ($dataExists > 0) {
            return true;
        } else {
            return false;
        }
    }
}
