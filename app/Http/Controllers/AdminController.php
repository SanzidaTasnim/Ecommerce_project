<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;
use PDF;
use Notification;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $data = category::all();
            return view('admin.category',compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function add_category(Request $request)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $data = new category();
            $data->category_name = $request->category;
            $data->save();

            return redirect()->back()->with('message','Category Added Successfully');
        }
        else{
            return redirect('login');
        }


    }
    public function delete_category($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $user = category::where('id',$id);
            $user->delete();

            return redirect()->back()->with("message","Category Deleted Successfully");
        }
        else{
            return redirect('login');
        }

    }
    public function view_product()
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $data = category::all();
            return view('admin.product',compact('data'));
        }
        else
        {
            return redirect('login');
        }

    }
    public function add_product(Request $request)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;

            $image = $request->image;
            $imageName = time().".".$image->getClientOriginalExtension();
            $request->image->move('product', $imageName);
            $product->image = $imageName;

            $product->save();

            return redirect()->back()->with('message',"Product Added Successfully");
        }
        else
        {
            return redirect('login');
        }

    }
    public function show_product()
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $product = Product::all();
            return view('admin.show_product',compact('product'));
        }
        else
        {
            return redirect('login');
        }

    }
    public function delete_product($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with("message","Product Deleted Successfully");
        }
        else
        {
            return redirect('login');
        }

    }
    public function update_product($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $product = Product::find($id);
            $category = category::all();
            return view('admin.update_product', compact('product','category'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $product = Product::find($id);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;

            $image = $request->image;
            if($image)
            {
                $imageName = time().".".$image->getClientOriginalExtension();
                $request->image->move('product',$imageName);
                $product->image = $imageName;
            }

            $product->save();

            return redirect()->back()->with('message',"Product Updated Successfully");
        }
        else
        {
            return redirect('login');
        }


    }
    public function orders()
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $order = order::all();
            return view('admin.orders', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function delivered_product($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $order = order::find($id);
            $order->delivery_status = "Delivered";
            $order->payment_status = "Paid";
            $order->save();

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }
    public function print_pdf($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $order = order::find($id);
            $pdf = PDF::loadView('admin.pdf', compact('order'));
            return $pdf->download('order_details.pdf');
        }
        else
        {
            return redirect('login');
        }
    }
    public function send_email($id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $order = order::find($id);
            return view('admin.send_email', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function send_user_email(Request $request,$id)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $order = order::find($id);
            $details = [
            'greeting' => $request->greeting,
            'firstLine' => $request->firstLine,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastLine' => $request->lastLine,
             ];

            Notification::send($order, new SendEmailNotification($details));

            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }
    public function search_product(Request $request)
    {
        if(Auth::id() && Auth::user()->usertype == 1)
        {
            $searchItem = $request->search;
            $order = order::where('name','LIKE',"%$searchItem%")->orWhere('phone','LIKE',"%$searchItem%")->orWhere('product_title','LIKE',"%$searchItem%")->get();
            return view('admin.orders', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }

}
