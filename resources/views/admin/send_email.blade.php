<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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
                <h2 class="mt-3 mb-3 text-center">Send Email To ({{$order->email}})</h2>

                <form action="{{url('send_user_email',$order->id)}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="greeting">
                            <h4>Email Greeting</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="greeting" placeholder="Enter Email Greeting" name="greeting" required>
                    </div>
                    <div class="form-group">
                        <label for="firstLine">
                            <h4>Email First Line</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="firstLine" placeholder="Enter First Line" name="firstLine" required>
                    </div>
                    <div class="form-group">
                        <label for="body">
                            <h4>Email Body</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="body" placeholder="Enter Email Body" name="body" required>
                    </div>
                    <div class="form-group">
                        <label for="button">
                            <h4>Email Button Name</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="button" placeholder="Enter Email Button Name" name="button" required>
                    </div>
                    <div class="form-group">
                        <label for="url">
                            <h4>Email URl</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="url" placeholder="Enter Email URl" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="lastLine">
                            <h4>Email Last Line</h4>
                        </label>
                        <input type="text" class="form-control p-3" id="lastLine" placeholder="Enter Email Last Line" name="lastLine" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
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
