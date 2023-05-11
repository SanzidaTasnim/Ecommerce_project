<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new category();
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('message','Category Added Successfully');

    }
    public function delete_category($id)
    {
        $user = category::where('id',$id);
        $user->delete();

        return redirect()->back()->with("message","Category Deleted Successfully");
    }
    public function view_product()
    {
        $data = category::all();
        return view('admin.product',compact('data'));
    }
    public function add_product(Request $request)
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
    public function show_product()
    {
        $product = Product::all();
        return view('admin.show_product',compact('product'));
    }

}
