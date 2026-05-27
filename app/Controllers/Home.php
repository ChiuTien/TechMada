<?php

namespace App\Controllers;

use App\Models\Employes;

class Home extends BaseController
{
    private $Employes;

    public function __construct() {
        $this->Employes = new Employes();
    }

    public function index()
    {
        return view('Views/auth/login');
    }

    public function login()
    {
        $email = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');

        $employe = $this->Employes->where('email', $email)
                       ->where('password', $password)
                       ->first();

        if ($employe) {
            return redirect()->to(base_url('')); 
        } else {        
            session()->setFlashdata('error', 'Identifiants invalides.');
        }

        // if ($email === 'admin@techmada.mg' && $password === 'admin123') {
        //     return redirect()->to(base_url('admin/employe'));
        // } else if ($email === 'employe@techmada.mg' && $password === 'emp123') {
        //     return redirect()->to(base_url('employe/dashboard'));
        // } else {
        //     return redirect()->to(base_url('rh/index'));
        // }
    }

    public function dashboard()
    {
        return view('Views/employe/dashboard');
    }

    public function create() 
    {
        return view('Views/employe/create');
    }

    public function storeConge()
    {
        return view('Views/employe/index');
    }

    public function adminEmploye()
    {
        return view('Views/admin/employe');
    }

    public function rh() 
    {
        return view('Views/rh/index');
    }
}
