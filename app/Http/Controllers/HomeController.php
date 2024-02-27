<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\OnlineCart;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        if(Auth::check() && Auth::user()->role == 1) Auth::logout();
        $cats = Category::orderBy('name', 'ASC')->get();
        $buys = Product::orderBy('buy', 'DESC')->limit(5)->get();
        $products = Product::orderBy('id', 'DESC')->limit(8)->get();
        $banners = Banner::orderBy('priority', 'DESC')->get();
        return view('homepage.home', compact('cats', 'products', 'buys', 'banners'));
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

    /* Cart controller */ 

    public function online_cart_view(OnlineCart $cart) {
        return view('homepage.cart', compact('cart')); 
    }

    public function add_onlinecart(Product $product, OnlineCart $cart) {
            $cart->add($product);
            return redirect()->route('onlinecart.view');
    }

    public function delete_onlinecart($id, OnlineCart $cart) {
            $cart->delete($id);
            return redirect()->route('onlinecart.view');
    }

    public function onlinecart_down($id, OnlineCart $cart) {
        $cart->down($id);
        return redirect()->route('onlinecart.view');
    }

    public function onlinecart_up($id, OnlineCart $cart) {
        $cart->up($id);
        return redirect()->route('onlinecart.view');
    }

    public function cart_view(Cart $cart) {
    }
}
