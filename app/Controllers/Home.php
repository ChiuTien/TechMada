<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('Views/auth/login');
    }

    public function login()
    {
        $email = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        if ($email === 'admin@techmada.mg' && $password === 'admin123') {
            return redirect()->to(base_url('admin/employe'));
        } else if ($email === 'employe@techmada.mg' && $password === 'emp123') {
            return redirect()->to(base_url('employe/dashboard'));
        }

        session()->setFlashdata('error', 'Identifiants invalides.');

        return redirect()->to(base_url('/'));
    }

    public function dashboard()
    {
        return view('Views/employe/dashboard');
    }

    public function adminEmploye()
    {
        return view('Views/admin/employe');
    }
}
