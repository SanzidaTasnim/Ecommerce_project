<!DOCTYPE html>
<html>
   <head>
      @include('home.css')

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->


         <section id="services" class="services section-bg">
            <div class="container-fluid">
               <div class="row row-sm">
                  <div class="col-md-6 _boxzoom">

                    <img class="my_img" src="/product/{{$product->image}}" alt="product_imge">

                  </div>
                  <div class="col-md-6">
                     <div class="_product-detail-content">
                        <p class="_p-name"> {{$product->title}} </p>
                        <div class="_p-price-box">
                           <div class="p-list">
                              @if($product->discount_price != null)
                                <span> M.R.P. : <del> {{$product->price}}tk  </del>   </span>
                                <span class="price">
                                    <?php $dis_price = ($product->discount_price / 100) * $product->price; ?>
                                    <p>{{$product->price - $dis_price }}Tk</p>
                                </span>
                               @else
                               <span class="price">
                                    <p>{{ $product->price }}Tk</p>
                                </span>
                               @endif
                           </div>
                           <div class="_p-add-cart row">
                              <div class="_p-qty col-lg-6">
                                 <span>Add Quantity</span>
                                 <div class="value-button decrease_" id="" value="Decrease Value">-</div>
                                 <input type="number" name="qty" id="number" value="1" />
                                 <div class="value-button increase_" id="" value="Increase Value">+</div>
                              </div>
                              @if($product->quantity > 0)
                                <div class="col-lg-6 text-right">
                                    <button class="btn btn-success">In stock</button>
                                    <p class="text-muted" style="font-weight: bold">Product in Stock: {{$product->quantity}}</p>
                                </div>

                              @else
                                <div class="col-lg-6 text-right">
                                    <button class="btn btn-danger">Out Of stock</button>
                                    <p class="text-muted" style="font-weight: bold">Product unavailable</p>
                                </div>
                              @endif
                           </div>
                           <div class="_p-features">
                              <span> Description About this product:- </span>

                              <span>{{$product->description}}</span>
                              Solid color polyester/linen full blackout thick sunscreen floor curtain
                              Type: General Pleat
                              Applicable Window Type: Flat Window
                              Format: Rope
                              Opening and Closing Method: Left and Right Biparting Open
                              Processing Accessories Cost: Included
                              Installation Type: Built-in
                              Function: High Shading(70%-90%)
                              Material: Polyester / Cotton
                              Style: Classic
                              Pattern: Embroidered
                              Location: Window
                              Technics: Woven
                              Use: Home, Hotel, Hospital, Cafe, Office
                              Feature: Blackout, Insulated, Flame Retardant
                              Place of Origin: India
                              Name: Curtain
                              Usage: Window Decoration
                              Keywords: Ready Made Blackout Curtain
                           </div>

                              <ul class="spe_ul"></ul>
                              <div class="_p-qty-and-cart">
                                 <div class="_p-add-cart row">
                                    <div class="col-md-6">
                                        <button class="btn-theme btn buy-btn" tabindex="0">
                                            <i class="fa fa-shopping-cart"></i> Buy Now
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{url('/add_cart',$product->id)}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" name="quantity" value="1" min="1">
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="submit" value="Add To Cart" style="border-radius: 40px;" >
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>


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
