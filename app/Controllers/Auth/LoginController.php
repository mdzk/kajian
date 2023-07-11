<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class LoginController extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('auth/login');
    }

    public function auth()
    {
        $session  = session();
        $model    = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();

        if ($data) {
            if ($data['verification'] == false) {
                $session->setFlashdata('errors', 'Tidak dapat login, pengguna belum diverifikasi');
                return redirect()->to('/login');
            }
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_users'  => $data['id_users'],
                    'name'      => $data['name'],
                    'role'      => $data['role'],
                    'email'  => $data['email'],
                    'verification' => $data['verification'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('errors', 'Password Salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('errors', 'Email Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
