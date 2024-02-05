<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('vw_login');
    }
    public function process()
    {
        $users = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getvar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        if($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                session()->set([
                    'username' => $dataUser->username,
                    'nama' => $dataUser->nama,
                    'logged_in' => TRUE
                ]); 
                return redirect()->to(base_url('produk'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
            } else {
                session()->setFlashdata('error','Username & Password salah');
                return redirect()->back();
            }
        }
    }
