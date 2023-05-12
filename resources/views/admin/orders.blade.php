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
                            @foreach($order as $item)
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
                                        </td>
                                    @else
                                        <td>
                                            <button disabled class="btn btn-success">
                                                Delivered
                                            </button>
                                            <a href="{{url('print_pdf',$item->id)}}" class="btn btn-primary mt-1">PDF Download</a>
                                        </td>
                                    @endif
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
