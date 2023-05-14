<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->

         <h2 class="mt-5 mb-3 text-center">All Orders</h2>

         <table class="table table-light table-striped mt-2 container">
             <thead class="text-center">
                 <tr>
                   <th scope="col">Serial No.</th>
                   <th scope="col">Product Title</th>
                   <th scope="col">Price</th>
                   <th scope="col">Quantity</th>
                   <th scope="col">Delivery Status</th>
                   <th scope="col">Payment Status</th>
                   <th scope="col">Image</th>
                   <th scope="col">Action</th>
                 </tr>
               </thead>
               <tbody class="text-center">
                 <?php $number = 1 ;?>
                 @foreach($order as $item)
                     <tr>
                         <th scope="row">{{ $number++ }}</th>
                         <td>{{$item->product_title}}</td>
                         <td>{{$item->price}}</td>
                         <td>{{$item->quantity}}</td>
                         <td>{{$item->delivery_status}}</td>
                         <td>{{$item->payment_status}}</td>
                         <td>
                             <img  style="width: 50px; height: 50px;" src="product/{{$item->image}}" alt="Product_picture">
                         </td>
                         <td>
                            @if($item->delivery_status == "Processing")
                                <a onclick="return confirm('Are You Sure,You Want to cancel the product?')" href="{{url('cancel_order', $item->id)}}" class="btn btn-danger">
                                    Cancel Order
                                </a>
                             @else
                                <button onclick="return confirm('Are You Sure?')" href="" disabled class="btn btn-danger">
                                    Cancel Order
                                </button>
                             @endif
                         </td>
                     </tr>
                 @endforeach
               </tbody>
         </table>

         @include('home.footer')

        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
