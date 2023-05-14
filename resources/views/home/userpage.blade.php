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
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>

      <!-- why section -->
      @include('home.why')
      <!-- end why section -->

      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->

      <!-- product section -->
      @include('home.product')
      <!-- end product section -->

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->

      <!-- client section -->
      @include('home.client')
      <!-- end client section -->

      <!-- Comment Section Starts-->
        <div class="container text-center">
            <h2 class="text-primary">Comments</h2>

            <form action="{{url('add_comment')}}" method="post">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                </div>
                <input type="submit" value="Comment" class="btn btn-primary">
            </form>
        </div>
        <div class="container">
            <h4>All Comments</h4>
            @foreach($comment as $item)
                <div>
                    <b>{{$item->name}}</b>
                    <p>{{$item->comment}}</p>
                    <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$item->id}}">Reply</a>
                </div>
                @foreach($reply as $rep)
                    @if($item->id == $rep->comment_id)
                        <div class="p-3">
                            <b>{{$rep->name}}</b>
                            <p>{{$rep->reply}}</p>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        {{-- Reply textbox --}}
        <div class="container replyDiv" style="display: none;">
            <form action="{{url('add_reply')}}" method="post">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Something Here" name="reply" style="width: 500px; margin-bottom: 5px;"></textarea>
                <button class="btn btn-primary" type="submit">Reply</button>
                <button class="btn btn-primary" onClick="reply_close(this)">Close</button>
            </form>
        </div>
      <!-- Comment Section Ends-->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>

      <!-- jQuery -->

      <script type="text/javascript">
        function reply(caller)
        {
            document.getElementById('commentId').value = $(caller).attr('data-commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }

        function reply_close(caller)
        {
            $('.replyDiv').hide();
        }
      </script>
      <script>
            document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
            });

            window.addEventListener("beforeunload", function (e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });
    </script>
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
