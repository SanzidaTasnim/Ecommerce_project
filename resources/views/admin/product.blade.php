<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">

                        <button type="button" class="close" aria-hidden="true" data-dismiss="alert">X</button>
                        {{session()->get('message')}}

                    </div>
                @endif

                <div>
                    <h2 class="mt-3 mb-3 text-center">Add Product</h2>

                    {{-- Product Form Starts Here --}}
                    <form action="{{url('add_product')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">
                                <h4>Product Title</h4>
                            </label>
                            <input type="text" class="form-control p-3" id="title" placeholder="Enter Product Title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">
                                <h4>Product Description</h4>
                            </label>
                            <input type="text" class="form-control p-3" bhhid="description" placeholder="Enter Product Description" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="price">
                                <h4>Product Price</h4>
                            </label>
                            <input type="number" class="form-control p-3" id="price" placeholder="Enter Product Price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="discount_price">
                                <h4>Product Discount Price</h4>
                            </label>
                            <input type="number" class="form-control p-3" id="discount_price" placeholder="Enter Product Discount Price" name="discount_price">
                        </div>
                        <div class="form-group">
                            <label for="quantity">
                                <h4>Product Quantity</h4>
                            </label>
                            <input type="number" class="form-control p-3" id="quantity" placeholder="Enter Product Quantity" min="0" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="image">
                                <h4>Product Image</h4>
                            </label>
                            <input type="file" class="form-control form-control-file " id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="category">
                                <h4>Product Category</h4>
                            </label>
                            <select name="category" id="category" class="form-control text-muted" required>
                                <option value="" selected>Add Category Here</option>
                                @foreach ($data as $item )
                                    <option value="{{$item->category_name}}">
                                        {{$item->category_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
  </body>
</html>
