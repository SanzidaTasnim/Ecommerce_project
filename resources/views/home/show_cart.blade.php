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
         @if(session()->has('message'))
            <div class="alert alert-success">

                <button type="button" class="close" aria-hidden="true" data-dismiss="alert">X</button>
                {{session()->get('message')}}

            </div>
        @endif

         <div>
            @if(count($cart) > 0)
                <table class="table table-light table-striped mt-5">
                    <thead class="text-center">
                        <tr>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        <?php $number = 1 ; $totalPrice = 0 ;?>
                        @foreach($cart as $item)
                            <tr>
                                <th scope="row">{{ $number++ }}</th>
                                <td>{{$item->product_title}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <img  style="width: 50px; height: 50px;" src="product/{{$item->image}}" alt="Product_picture">
                                </td>
                                <td>
                                    <a onclick="return confirm('Are You Sure?')" href="{{url("remove_cart",$item->id)}}" class="btn btn-danger">
                                        Remove
                                    </a>
                                </td>
                            </tr>

                            <?php $totalPrice = $totalPrice + $item->price; ?>
                        @endforeach
                    </tbody>
                </table>

                <table class="table table-dark table-striped mt-5 text-center" style="font-size: 25px;">
                    <tr>
                        <th>Total Price</th>
                        <th>{{$totalPrice}}Tk</th>
                    </tr>
                </table>
                <div class="text-center">
                    <h1 class="table table-secondary table-striped text-center" style="color: green" >Proceed To Checkout</h1>
                    <a href="{{url('/cash_delivery')}}" class="btn btn-primary btn-lg">
                        <i class="fa fa-shopping-cart"></i>
                        Cash On Delivery
                    </a>
                    <a href="{{url('/stripe',$totalPrice)}}" class="btn btn-success btn-lg">
                        <i class="fa fa-shopping-cart"></i>
                        Pay Using Card
                    </a>
                </div>
            @else
                <div class="text-center" style="height: 300px;">
                    <h1 style="margin-top: 253px;color: red;padding-bottom: 15px;">You Currently have no product added in the cart.</h1>
                    <a class="btn btn-primary" href="{{ url('/')}}">Back To Home</a>
                </div>
            @endif
         </div>
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
