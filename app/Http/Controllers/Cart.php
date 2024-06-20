<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class Cart extends Controller
{
    public function index()
    {
        $searchTerm = request()->get('search');
        
        $products = ProductModel::orderBy('product_name', 'asc');

        if($searchTerm) {
            $products = $products->where('product_name', 'like', "%$searchTerm%");
        }
        
        $products = $products->get(); 

        return view('cart.index', compact('products'));   
    }

    public function addToCart(Request $request)
    {
                
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');

    $product = ProductModel::find($productId);

    if (!$product) {
        return back()->with('error', 'Product not found');
    }

    $cart = Session::get('cart', []);

    if (isset($cart[$productId])) {
        $cart[$productId]['product_quantity'] += $quantity;
        $quantity = $cart[$productId]['product_quantity'];
    } else {
        $cart[$productId] = [
            'product_name' => $product->product_name,
            'product_price' => $product->product_price,
            'product_quantity' => $quantity,
            'discount' => $product->discount,
        ];
    }

    Session::put('cart', $cart);
    session()->put('totalPrice', $this->calculateTotalPrice($cart));

    return back()->with('success', 'Product added to cart');
    }

    public function calculateTotalPrice($cart)
    {
        $totalPrice = 0;

        foreach ($cart as $product) {
            $totalPrice += $product['product_price'] * $product['product_quantity'];
        }
    
        return $totalPrice;
    
    }

    public function calculateDiscount(Request $request)
    {
        $cart = session('cart', []);
        $discountPercentage = $request->input('discount');
        $totalPrice = $this->calculateTotalPrice($cart);
    
        $discountAmount = ($totalPrice / 100) * $discountPercentage;
        $newTotalPrice = $totalPrice - $discountAmount;
    
        Session::put('discountAmount', $discountAmount);
        Session::put('discountPercentage', $discountPercentage);
        Session::put('totalPrice', $newTotalPrice); // Update the totalPrice session variable
    
        // Update the cart prices to reflect the discount
        foreach ($cart as &$product) {
            $product['product_price'] = $product['product_price'] - ($product['product_price'] / 100) * $discountPercentage;
        }
        Session::put('cart', $cart);

        session()->forget('discountPercentage');

        return redirect()->back();
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        Session::put('cart', $cart);

        $totalPrice = 0;
        foreach ($cart as $product) {
            $totalPrice += $product['product_price'] * $product['product_quantity'];
        }

        Session::put('totalPrice', $totalPrice);

        session()->forget('discountAmount');

        return back()->with('success', 'Product removed from cart');
    }

    public function pay(Request $request)
    {
        $totalAmount = session('totalPrice', 0);
        $amountTendered = $request->input('tendered_amount');
        $customerName = $request->input('customer_name');
        $paymentMethod = $request->input('payment_method');
    
        if ($amountTendered < $totalAmount) {
            return redirect()->back()->withInput()->withErrors('tendered_amount', 'Tendered amount is not enough to cover the total price.');
        }
    
        $transaction = new TransactionModel();
        $transaction->total_amount = $totalAmount;
        $transaction->discount = session('discountAmount', 0);
        $transaction->tendered_amount = $amountTendered;
        $transaction->change = $amountTendered - $totalAmount;
        $transaction->payment_method = $paymentMethod;
        $transaction->customer_name = $customerName;
        $transaction->save();
    
        // Calculate the change
        $change = $amountTendered - $totalAmount;
    
        // Store the tendered amount and customer name in session
        Session::put('tendered_amount', $amountTendered);
        Session::put('customer_name', $customerName);
        Session::put('change', $change);
    
        // Decrement the quantity of the products in the cart
        foreach (session('cart', []) as $productId => $product) {
            $productModel = ProductModel::find($productId);
            $productModel->product_quantity -= $product['product_quantity'];
            $productModel->save();
        }
    
        // Clear the cart session
        Session::forget('cart');
        Session::forget('totalPrice');
        Session::forget('discountAmount');
        Session::forget('discountPercentage');

        Session::flash('status', 'Payment Successful!');
        return redirect('/pos');//->with('status', 'Payment Successful!');

    }
}
