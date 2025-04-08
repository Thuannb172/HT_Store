<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm mới nhất, mỗi lần lấy 10 sản phẩm
        $products = Product::latest()->take(10)->get();

        // Trả dữ liệu ra view
        return view('home', compact('products'));
    }
    public function orderConfirm()
    {
        $products = Product::latest()->take(10)->get();
        return view('order.confirm', compact('products'));
    }

    public function cart()
    {
        $products = Product::latest()->take(10)->get();
        return view('cart', compact('products'));
    }

    public function orderSuccess()
    {
        $products = Product::latest()->take(10)->get();
        return view('order.success', compact('products'));
    }
    public function show($id)
    {
        // Lấy sản phẩm từ database
        $product = Product::findOrFail($id);  // Lấy một sản phẩm theo id

        // Nếu bạn muốn hiển thị nhiều sản phẩm, ví dụ sản phẩm mới nhất:
        $products = Product::latest()->take(10)->get(); // Lấy 10 sản phẩm mới nhất

        // Trả về view cùng với dữ liệu
        return view('product', compact('product', 'products'));
    }

    public function showCart()
    {
        // Lấy sản phẩm trong giỏ hàng
        $cart = session()->get('cart', []);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Lấy các sản phẩm mới nhất hoặc bất kỳ sản phẩm nào bạn muốn hiển thị
        $products = Product::latest()->take(10)->get();

        // Truyền các dữ liệu vào view
        return view('cart', compact('products', 'cart', 'total'));
    }



    public function addToCart(Request $request, $id)
    {
        // Lấy thông tin sản phẩm từ database
        $product = Product::find($id);

        // Kiểm tra nếu sản phẩm tồn tại
        if ($product) {
            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);

            // Số lượng người dùng nhập
            $quantity = $request->quantity;

            // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
            if (isset($cart[$id])) {
                // Nếu có rồi, chỉ tăng số lượng lên
                $cart[$id]['quantity'] += $quantity;
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price_sale ?: $product->price_nomal, // Kiểm tra xem có giá sale không
                    'quantity' => $quantity,
                    'image' => $product->image,
                ];
            }

            // Cập nhật giỏ hàng vào session
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }


    // app/Http/Controllers/CartController.php
    public function removeCart($id)
    {
        $cart = session()->get('cart', []);
        $id = (string)$id; // Ép kiểu thành string để tránh lỗi với key 0

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm để xóa');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng hay không
        if (isset($cart[$id])) {
            // Cập nhật số lượng của sản phẩm
            $cart[$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);  // Lưu giỏ hàng lại vào session
        }

        return redirect()->route('cart');  // Quay lại trang giỏ hàng
    }

    public function placeOrder(Request $request)
    {
        $cart = session('cart', []);
        $orderDetail = [];

        foreach ($cart as $productId => $item) {
            $orderDetail[] = [
                'product_name' => $item['name'],
                'product_image' => $item['image'], // Đảm bảo có ảnh
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        }

        $order = Order::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'ward' => $request->input('ward'),
            'address' => $request->input('address'),
            'note' => $request->input('note'),
            'order_detail' => $orderDetail,
            'status' => 0,
        ]);

        session()->forget('cart');
        return redirect()->route('order.success');
    }

    public function showLoginForm()
    {
        $products = Product::all(); // Lấy danh sách sản phẩm từ database
        return view('auth.login', compact('products'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.product.list')
                : redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Đã đăng xuất.');
    }
}
