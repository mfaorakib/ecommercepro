<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')
<style type="text/css">
    label{
        display: inline-block;
        width: 300px;
         
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
                <h1 class="text-center">Send Email to {{$order->email}}</h1>
                <form action="{{url('send_user_email',$order->id)}}" method="POST">
                    @csrf
                <div class="text-center pt-5">
                    <label>Greetings Email: </label>
                    <input style="color:black" type="text" name="greeting">
                </div>
                <div class="text-center pt-2">
                    <label>Email Firstline:</label>
                    <input style="color:black" type="text" name="firstline">
                </div>
                <div class="text-center pt-2">
                    <label>Email Body:</label>
                    <input style="color:black" type="text" name="body">
                </div>
                <div class="text-center pt-2">
                    <label>Email Button Name:</label>
                    <input style="color:black" type="text" name="button">
                </div>
                <div class="text-center pt-2">
                    <label>Email Url:</label>
                    <input style="color:black" type="text" name="url">
                </div>
                <div class="text-center pt-2">
                    <label>Email Lastline:</label>
                    <input style="color:black" type="text" name="lastline">
                </div>
                <div class="text-center pt-2">
                    
                    <input class="btn btn-primary" type="submit">
                </div>
                </form>
            </div>
        </div>       
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>