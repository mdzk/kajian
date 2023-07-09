<?php

namespace App\Controllers;

use App\Models\KajianModel;

class KajianController extends BaseController
{
    public function dahulu()
    {
        $kajian = new KajianModel();
        $data   = [
            'kajian' => $kajian->where('tipe','dahulu')->findAll(),
        ];
        return view('admin/dahulu', $data);
    }
}
