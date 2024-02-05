<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function admin()
    {
        return view('template/admin');
    }

    public function kasir()
    {
        return view('template/kasir');
    }
}
