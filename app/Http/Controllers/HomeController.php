<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\OnlineCart;
use App\Models\UserCart;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index() {
        if(Auth::check() && Auth::user()->role == 1) Auth::logout();
        $cats = Category::orderBy('name', 'ASC')->get();
        $buys = Product::orderBy('buy', 'DESC')->limit(5)->get();
        $products = Product::orderBy('watch', 'DESC')->limit(8)->get();
        $banners = Banner::orderBy('priority', 'DESC')->get();
        return view('homepage.home', compact('cats', 'products', 'buys', 'banners'));
    }

    public function detail(Product $product) {
        Product::where('id', $product->id)->increment('watch', 1);
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

    // Online cart

    public function online_cart_view(OnlineCart $cart) {
        return view('homepage.cart', compact('cart')); 
    }

    public function add_onlinecart(Product $product, OnlineCart $cart) {
            $cart->add($product);
            return redirect()->route('onlinecart.view')->with('ok', 'Thêm sản phẩm thành công!');
    }

    public function delete_onlinecart($id, OnlineCart $cart) {
            $cart->delete($id);
            return redirect()->route('onlinecart.view')->with('ok', 'Xóa sản phẩm thành công!');
    }

    public function onlinecart_down($id, OnlineCart $cart) {
        $cart->down($id);
        return redirect()->route('onlinecart.view');
    }

    public function onlinecart_up($id, OnlineCart $cart) {
        $cart->up($id);
        return redirect()->route('onlinecart.view');
    }

    public function onlinecart_buy(){
        return view('homepage.online_buy'); 
    }

    public function onlinecart_order(Request $req, OnlineCart $cart){
        request()->validate([
            'name'=>'required|min:2',
            'email'=>'required|email',
            'phone'=>'required|numeric|min:100000000',
            'address'=>'required|min:5'
        ]);
        if(Order::max('id') == null) $code = "MS".Str::padLeft('1', 8, '0');
        else {
            $id = Order::max('id') + 1;
            $code = "MS".Str::padLeft($id, 8, '0');
        }
        $data = request()->only('content', 'name', 'phone', 'email', 'address', 'payment', 'totalQuantity', 'totalPrice');
        $data['code'] = $code;
        if(Order::create($data)){
            foreach($cart->items as $item){
                Product::where('id', $item->id)->increment('buy', $item->quantity);
            }
            $cart->clear();
            return redirect()->route('onlinecart.view')->with('ok','Đặt hàng thành công vui lòng chờ đơn hàng được xác nhận!');
        }
        
        else return view('homepage.online_buy'); 
    }

    // User Cart
    public function user_cart_history(){
        $order = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('homepage.user_history', compact('order')); 
    }

    public function user_cart_buy(){
        return view('homepage.user_buy'); 
    }

    public function user_cart_order(Request $req){
        request()->validate([
            'name'=>'required|min:2',
            'email'=>'required|email',
            'phone'=>'required|numeric|min:100000000',
            'address'=>'required|min:5'
        ]);
        if(Order::max('id') == null) $code = "MS".Str::padLeft('1', 8, '0');
        else {
            $id = Order::max('id') + 1;
            $code = "MS".Str::padLeft($id, 8, '0');
        }
        $data = request()->only('content', 'name', 'phone', 'email', 'address', 'payment', 'totalQuantity', 'totalPrice', 'user_id');
        $data['code'] = $code;
        if(Order::create($data)){
            $buy = UserCart::where('user_id', Auth::user()->id)->get();
            foreach($buy as $item){
                Product::where('id', $item->product_id)->increment('buy', $item->quantity);
            }
            UserCart::where('user_id', Auth::user()->id)->delete();
            return redirect()->route('usercart.view')->with('ok','Đặt hàng thành công vui lòng chờ đơn hàng được xác nhận!');
        }
        
        else return view('homepage.user_buy'); 
    }

    public function user_cart_view() {
        return view('homepage.usercart'); 
    }

    public function add_usercart(Product $product) {
        $item = UserCart::where('user_id', Auth::user()->id)
                ->where('product_id', $product->id)
                ->first();
        if(!isset($item)) {
            $quantity = 1;
            $data = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $quantity,
                'user_id' => Auth::user()->id,
                'product_id' => $product->id
            ];
            if(UserCart::create($data))
                return redirect()->route('usercart.view')->with('ok', 'Thêm sản phẩm thành công!');
        }
        else {
            UserCart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id
            ]) -> increment('quantity', 1);
            return redirect()->route('usercart.view')->with('ok', 'Thêm sản phẩm thành công!');
        }
    }

    public function delete_usercart($id) {
        UserCart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ]) -> delete();
        return redirect()->route('usercart.view')->with('ok', 'Xóa sản phẩm thành công!');
    }

    public function usercart_down($id) {
        $item = UserCart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();
        if($item->quantity > 1){
            UserCart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]) -> increment('quantity', -1);
        }
        else {
            UserCart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]) -> delete();
        }
        return redirect()->route('usercart.view');
    }

    public function usercart_up($id) {
        UserCart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ])->increment('quantity', 1);
        return redirect()->route('usercart.view');
    }

    // User profile
    public function profile_view(){
        return view('homepage.profile');
    }

    public function profile_edit(){
        return view('homepage.profile_edit');
    }

    public function profile_update(Request $req){
        if(request()->filled('password') || request()->filled('newpassword')){
            request()->validate([
            'name'=>'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->email, 'email'),
            ],
            'password'=>'required',
            'newpassword'=>'required',
            ]);
            $data = request()->all('email', 'password');

            if(auth()->attempt($data)){
                User::where('id', Auth::user()->id)->update([
                    'name' => $req->input('name'),
                    'email' => $req->input('email'),
                    'password' => bcrypt($req->input('newpassword')),
                    'phone' => $req->input('phone'),
                    'address' => $req->input('address'),
                ]);
            }
            else{
                $erro = 'Mật khẩu cũ không đúng';
                return redirect()->back()->with('erro', $erro);;
            }
        }
        else {
            request()->validate([
                'name'=>'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore(Auth::user()->email, 'email'),
                ],
            ]);
            User::where('id', Auth::user()->id)->update([
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'phone' => $req->input('phone'),
                'address' => $req->input('address'),
            ]);
        }
        
        return redirect()->route('profile.view');
    }

    public function product_by_category($category_id){
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::where('category_id', $category_id)->orderBy('id', 'DESC')->get();
        $cat =  Category::where('id', $category_id)->first();
        return view('homepage.product_by_category', compact('products', 'cats', 'cat'));
    }

    public function product_all(){
        $cats = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('homepage.product_all', compact('products','cats'));
    }

    public function product_by_category_price($category_id, $price){
        if($price == 1) $products = Product::where('category_id', $category_id)->orderBy('price', 'DESC')->get();
        else $products = Product::where('category_id', $category_id)->orderBy('price', 'ASC')->get();
        $cats = Category::orderBy('name', 'ASC')->get();
        $cat =  Category::where('id', $category_id)->first();
        return view('homepage.product_by_category', compact('products', 'cats', 'cat'));
    }

    public function product_all_price($price){
        if($price == 1) $products = Product::orderBy('price', 'DESC')->get();
        else $products = Product::orderBy('price', 'ASC')->get();
        $cats = Category::orderBy('name', 'ASC')->get();
        return view('homepage.product_all', compact('products','cats'));
    }
}
