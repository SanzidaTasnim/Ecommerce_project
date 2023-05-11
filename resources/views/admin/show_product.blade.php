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
                <h2 class="mt-3 mb-3 text-center">All Products</h2>

                <table class="table table-light table-striped mt-5">
                    <thead class="text-center">
                        <tr>
                          <th scope="col">Serial No.</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Price</th>
                          <th scope="col">Discount Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Category</th>
                          <th scope="col">Image</th>
                          <th scope="col">Delete</th>
                          <th scope="col">Edit</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php $number = 1 ;?>
                        @foreach($product as $product)
                            <tr>
                                <th scope="row">{{ $number++ }}</th>
                                <td>{{$product->title}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->discount_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->category}}</td>
                                <td>
                                    <img  style="width: 50px; height: 50px;" src="product/{{$product->image}}" alt="Product_picture">
                                </td>
                                <td>
                                    <a onclick="return confirm('Are You Sure?')" href="{{url("delete_product",$product->id)}}" class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url("update_product",$product->id)}}" class="btn btn-success">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>

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
