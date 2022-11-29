<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
     .div-center
     {
        text-align: center;
        padding-top: 40px;
     }
     .h2-font{
        font-size: 40px;
        padding-bottom: 40px
     }
     .input-color{
        color: black
     }
     .center{
      text-align: center;
      width: 50%;
      margin: auto;
      margin-top: 30px;
      border: 3px solid goldenrod
     }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
            <div class="alert alert-success">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                 {{session()->get('message') }} 
                 
        </div>
                @endif
                <div class="div-center">
                    <h2 class="h2-font">
                        Add Catagory
                    </h2>
                    <form action={{url('/add_catagory')}} method="POST">
                        @csrf
                        <input type="text" class="input-color"  name="catagory" placeholder="Enter Catagory Name">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Catagory">
                    </form>
                </div>
                <table class="center">
                  <tr>
                  <td>Catagory Name</td>
                  <td>Action</td>
                </tr>
                @foreach($data as $data)
                <tr>
                  <td>{{$data->catagory_name}}</td>
                  <td>
                    <a onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger" href="{{url('delete_catagory',$data->id)}}" >Delete</a> 
                  </td>
                </tr>
                @endforeach
                </table>
                
            </div>    
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>