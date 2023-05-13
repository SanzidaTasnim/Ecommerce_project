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
                <div>
                    <h2 class="mt-3 mb-3 text-center">All Orders</h2>

                    <div>
                        <form action="{{url('search_product')}}">
                            @csrf
                            <div class="form-group m-auto" style="width: 400px; display: flex;" >
                              <input type="text" name="search" class="form-control" id="search" placeholder="Search for product">

                              <button type="submit" class="btn btn-success ml-2">Search</button>
                            </div>
                          </form>
                    </div>

                    <table class="table table-light table-striped mt-5">
                        <thead class="text-center">
                            <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Addess</th>

                              <th>Title</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Payment Status</th>
                              <th>Delivery Status</th>
                              <th>Image</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            @forelse($order as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>

                                    <td>{{$item->product_title}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->payment_status}}</td>
                                    <td>{{$item->delivery_status}}</td>
                                    <td>
                                        <img  style="width: 50px; height: 50px;" src="product/{{$item->image}}" alt="order_picture">
                                    </td>
                                    @if($item->delivery_status == "Processing")
                                        <td>
                                            <a onclick="return confirm('Product is delivered,Are You Sure?')" href="{{url("delivered_product",$item->id)}}" class="btn btn-success">
                                                Delivered
                                            </a><br>
                                            <a href="{{url('print_pdf', $item->id)}}" class="btn btn-primary mt-1">PDF Download</a>
                                            <a href="{{url('send_email', $item->id)}}" class="btn btn-info mt-1">Email</a>
                                        </td>
                                    @else
                                        <td>
                                            <button disabled class="btn btn-success">
                                                Delivered
                                            </button>
                                            <a href="{{url('print_pdf',$item->id)}}" class="btn btn-primary mt-1">PDF Download</a>
                                            <a href="{{url('send_email', $item->id)}}" class="btn btn-info mt-1">Email</a>
                                        </td>
                                    @endif

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16">
                                        <h2 style="margin-top:20px;">There is no Product related to the search item.</h2>
                                    </td>
                                </tr>
                            @endforelse
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
