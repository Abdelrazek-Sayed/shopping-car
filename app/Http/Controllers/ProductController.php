<?php

namespace App\Http\Controllers;


use App\Classes\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }


    public function AddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            Alert::toast('Not defined', 'error');
            return back();
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        Alert::toast('Added To Cart Successfully', 'success');
        return back();
    }

    public function showCart()
    {
        if (!Session::has('cart')) {
            Alert::toast('No products in the cart', 'error');
            return redirect()->route('home');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('cart.show_cart', ['cart' => $cart]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ], [
            'qty.min' => 'product Quantity can not be zero you can remove it',
        ]);


        $product_id = $request->product_id;
        $product = Product::findOrFail($product_id);
        if (!$product) {
            Alert::toast('Not defined', 'error');
            return back();
        }



        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product_id, $request->qty);
        session()->put('cart', $cart);

        Alert::toast('product qty  updated ', 'success');
        return back();
    }

    public function destroy(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::findOrFail($product_id);

        if (!$product) {
            Alert::toast('Not defined', 'error');
            return back();
        }
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        Alert::toast('product deleted from the cart', 'success');
        return back();
    }

    public function Checkout()
    {
        if (!Session::has('cart')) {
            return back()->with('error', 'fault');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $amount = $cart->totalPrice;


        return view('cart.checkout', compact('amount'));
    }

    public function Charge(Request $request)
    {
        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => 'Shopping Car 2',
        ]);

        try {
            $charge_id = $charge['id'];
            if ($charge_id) {
                // save order in orders table
                $user  =  Auth::user();
                $user->orders()->create([
                    'cart' => serialize(session()->get('cart')),
                    'name' => auth()->user()->name,
                    'address' => $request->address,
                    'payment_id' => $charge_id,
                ]);
                // clear session
                session()->forget('cart');
                Alert::toast('Payment success', 'success');
                return redirect()->route('home');
            } else {
                Alert::toast('Payment error', 'error');
                return back();
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
