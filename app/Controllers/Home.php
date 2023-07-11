<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        if (get_user('role') == 'user') {
            return redirect()->to('kajian/dahulu');
        }

        return view('home');
    }
}
