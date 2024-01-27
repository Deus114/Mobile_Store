<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        if(Auth::check() && Auth::user()->role == 1) Auth::logout();
        $cats = Category::orderBy('name', 'ASC')->get();
        $buys = Product::orderBy('buy', 'DESC')->limit(5)->get();
        $products = Product::orderBy('id', 'DESC')->limit(8)->get();
        return view('homepage.home', compact('cats', 'products', 'buys'));
    }

    public function detail(Product $product) {
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('homepage.detail', compact('cats', 'product'));
    }
    
    public function login() {
        return view('homepage.login');
    }

    public function check_login() {
        request()->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required',
        ]);
        $data = request()->all('email', 'password');

        if(auth()->attempt($data)){
            // Check admin
            if(Auth::user()->role == 1){
                return redirect()->route('admin.index');
            }
            else {
                return redirect()->route('home');
            }
        }
        else{
            $erro = 'Mật khẩu không đúng';
            return redirect()->back()->with('erro', $erro);;
        }
            
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register() {
        return view('homepage.register');
    }

    public function check_register() {
        request()->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'repassword'=>'required|same:password',
        ]);
        $data = request()->all('name', 'email');
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        return redirect()->route('login')->with('success','Đăng kí thành công!');
    }
}
