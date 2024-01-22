<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->limit(6)->get();
        return view('homepage.home', compact('cats', 'products'));
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
            $email = $data['email'];
            $user = DB::table('users')->where('email', $email)->first();
            // Check admin
            if($user->role == 1){
                return redirect()->route('admin.index');
            }
            else return redirect()->back();
        }
            
        else{
            $erro = 'Mật khẩu không đúng';
            return redirect()->back()->with('erro', $erro);;
        }
            
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
        return redirect()->route('login');
    }
}
