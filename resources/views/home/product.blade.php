<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>
       <div class="row">

          @foreach($product as $item)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                    <div class="options">
                        <a href="{{url('/product_details',$item->id)}}" class="option1">
                            Product Details
                        </a>
                        <a href="" class="option2">
                        Buy Now
                        </a>
                    </div>
                    </div>
                    <div class="img-box">
                    <img src="product/{{$item->image}}" alt="product_image">
                    </div>
                    <div class="detail-box">
                    <h6>
                        {{$item->title}}
                    </h6>
                    @if($item->discount_price != null)
                        <h6>
                            <p style="font-size: 12px">Discount Price</p>
                            <?php $dis_price = ($item->discount_price / 100) * $item->price; ?>
                            <p style="color: green;">{{$item->price - $dis_price }}Tk</p>
                        </h6>
                        <h6>
                            <p style="font-size: 12px">Price</p>
                            <p style="color: red; text-decoration: line-through;">{{$item->price}}Tk</p>
                        </h6>
                    @else
                        <h6>
                            <p style="font-size: 12px">Price</p>
                            <p style="color: green;">
                                {{$item->price}}Tk
                            </p>
                        </h6>
                    @endif

                    </div>
                </div>
            </div>
          @endforeach
          <br>
          <span style="padding-top:20px;">
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
          </span>
       </div>
    </div>
 </section>
