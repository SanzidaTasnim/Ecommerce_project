<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(6);
        return view('home.userpage',compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == "1")
        {
            return view('admin.home');
        }
        else
        {
            $product = Product::paginate(6);
            return view('home.userpage',compact('product'));
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $product = Product::find($id);

            $cart = new Cart();

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;
            if($product->discount_price != null)
            {
                $discounted_price = ($product->discount_price / 100) * $product->price;
                $cart->price = ($product->price - $discounted_price) * $request->quantity;
            }
            else{
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $cart = cart::where('user_id','=',$id)->get();
            return view('home.show_cart', compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message',"Cart Deleted Successfully");
    }
    public function cash_delivery()
    {
        $userId = Auth::user()->id;
        $data = cart::where("user_id","=",$userId)->get();

        foreach($data as $item)
        {
            $order = new order();

            $order->name = $item->name;
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->id;

            $order->product_title = $item->product_title;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->image = $item->image;
            $order->user_id = $item->user_id;
            $order->product_id = $item->product_id;

            $order->payment_status = "Cash On delivery";
            $order->delivery_status = "Processing";

            $order->save();

            $cart_id = $item->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We have received your order successfully');
    }
    public function stripe($totalprice)
    {
        return view('home.stripe',compact('totalprice'));
    }
    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);
        $userId = Auth::user()->id;
        $data = cart::where("user_id","=",$userId)->get();

        foreach($data as $item)
        {
            $order = new order();

            $order->name = $item->name;
            $order->email = $item->email;
            $order->phone = $item->phone;
            $order->address = $item->address;
            $order->user_id = $item->id;

            $order->product_title = $item->product_title;
            $order->price = $item->price;
            $order->quantity = $item->quantity;
            $order->image = $item->image;
            $order->user_id = $item->user_id;
            $order->product_id = $item->product_id;

            $order->payment_status = "Paid";
            $order->delivery_status = "Processing";

            $order->save();

            $cart_id = $item->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
