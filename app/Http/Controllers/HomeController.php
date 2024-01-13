<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('index');
    }
    
    public function login() {
        return view('homepage.login');
    }

    public function check_login() {
        $data = request()->all('email', 'password');
    }

    public function register() {
        return view('homepage.register');
    }

    public function check_register() {
        request()->validate([
        ]);
        $data = request()->all('email', 'password');
    }
}
