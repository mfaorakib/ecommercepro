<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <!-- Mobile Metas -->
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <!-- Site Metas -->
     <meta name="keywords" content="" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
     <title>Famms - Fashion HTML Template</title>
     <!-- bootstrap core css -->
     <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
     <!-- font awesome style -->
     <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
     <!-- Custom styles for this template -->
     <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
     <!-- responsive style -->
     <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">
      
      </style>
   </head>
   <body>
     
      
         <!-- header section strats -->
         @include('Home.Header')
         @if (session()->has('message'))
         <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
              {{session()->get('message') }} 
              @endif
         <!-- end header section -->
         <!-- slider section -->
      <div style="margin:auto; padding:40px ;width:70%">
        <table class="table table-striped table-bordered" style="text-align:center">
        <tr>
            <th>Product Tite</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php $Totalprice=0 ?>
        @foreach($cart as $cart)
        <tr>
            <td>{{$cart->product_title}}</td>
            <td>{{$cart->quantity}}</td>
            <td> {{$cart->price}}</td>
            <td> 
                <img src="/product/{{$cart->image}}" alt="">
            </td>
            <td>
                <a href="{{url('/remove_cart',$cart->id)}}" class="btn btn-danger" onclick="return confirm('you sure to remove this cart?')"> Remove product</a>
            </td>
        </tr>
        <?php $Totalprice=$Totalprice+$cart->price ?>
        @endforeach
      
    </table>
    
      </div>
      <div>
         <h1 style="text-align:center"> Total Price: {{$Totalprice}}</h1>
      </div>
      <div style="text-align:center">
         <h3>Order Procced</h3>
         <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
         <a href="{{url('stripe',$Totalprice)}}" class="btn btn-danger">Pay Using Card</a>
      </div>
     
      <!-- footer start -->
      @include('Home.Footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
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