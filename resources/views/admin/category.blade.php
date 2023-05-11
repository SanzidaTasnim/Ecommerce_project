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
                    <h2 class="mt-3 mb-3 text-center">Add Category</h2>

                    {{-- Category Form Starts Here --}}
                    <form action="{{url('add_category')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="category">
                                <h4>Category Name</h4>
                            </label>
                            <input type="text" class="form-control p-3" id="category" placeholder="Enter category" name="category">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>

                <table class="table table-light table-striped mt-5">
                    <thead class="text-center">
                        <tr>
                          <th scope="col">Serial No.</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php $number = 1 ;?>
                        @foreach($data as $item)
                            <tr>
                                <th scope="row">{{ $number++ }}</th>
                                <td>{{$item->category_name}}</td>
                                <td>
                                    <a onclick="return confirm('Are You Sure?')" href="{{url("delete_category",$item->id)}}" class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                </table>
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
