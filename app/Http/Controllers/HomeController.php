<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(6);
        $comment = Comment::all();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if($usertype == "1")
        {
            $product = order::all()->count();
            $order = order::all()->count();
            $user = user::all()->count();
            $all_order = order::all();
            $totalPrice = 0;
            foreach($all_order as $item)
            {
                $totalPrice = $item->price + $totalPrice;
            }
            $total_delivery = order::where("delivery_status","=","Delivered")->get()->count();
            $total_processing = order::where("delivery_status","=","Processing")->get()->count();
            $success_payment = order::where("payment_status","=","Paid")->get()->count();
            $due_payment = order::where("payment_status","=","Cash On delivery")->get()->count();

            return view('admin.home', compact('product', 'order', 'user' , 'totalPrice', 'total_delivery', 'total_processing', 'success_payment', 'due_payment'));
        }
        else
        {
            $product = Product::paginate(6);
            $comment = Comment::all();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment', 'reply'));
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
            $userId = $user->id;
            $product = Product::find($id);
            $product_exist_id = cart::where('product_id','=',$id)->where('user_id','=',$userId)->get('id')->first();

            if($product_exist_id)
            {
                $cart = cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity =$quantity + $request->quantity;
                if($product->discount_price != null)
                {
                    $discounted_price = ($product->discount_price / 100) * $product->price;
                    $cart->price = ($product->price - $discounted_price) * $cart->quantity;
                }
                else{
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                return redirect()->back()->with('message',"Product added to cart successfully");
            }
            else
            {
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
                return redirect()->back()->with('message',"Product added to cart successfully");
            }
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

    public function show_order()
    {

        if(Auth::id())
        {
            $user= Auth::user();
            $userId = $user->id;
            $order = order::where('user_id','=', $userId)->get();
            return view('home.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = "Cancelled";
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment = new comment();
            $comment->name = Auth::user()->name;
            $comment->comment = $request->comment;
            $comment->user_id = Auth::user()->id;

            $comment->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }
    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply = new reply();
            $reply->name = Auth::user()->name;
            $reply->id = Auth::user()->id;
            $reply->reply = $request->reply;
            $reply->comment_id = $request->commentId;

            $reply->save();
            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }
    public function search_product(Request $request)
    {
        $searchInput = $request->search;
        $comment = comment::all();
        $reply = reply::all();
        $product = product::where('title','LIKE',"%$searchInput%")->orWhere('category','LIKE',"%$searchInput%")->paginate(10);

        return view('home.userpage', compact('product','comment','reply'));
    }
    public function product_search(Request $request)
    {
        $searchInput = $request->search;
        $product = product::where('title','LIKE',"%$searchInput%")->orWhere('category','LIKE',"%$searchInput%")->paginate(10);

        return view('home.all_product', compact('product'));
    }
    public function product_page()
    {
        $product = product::paginate(10);
        return view('home.all_product',compact('product'));
    }
}
