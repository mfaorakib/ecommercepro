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
        .center{
        margin: auto;
        text-align: center;
        margin-top: 40px;
    }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('Home.Header')
         <!-- end header section -->
         <!-- slider section -->
         
            <table class="table table-striped table-bordered w-50 p-5 center">
                <tr>
                    <th>Product Title: </th>
                    <th>Quantity: </th>
                    <th>Price: </th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Cancel Order</th>

                </tr>
                @foreach($order as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img src="/product/{{$order->image}}" alt="" srcset="">
                    </td>
                    <td>
                        @if($order->delivery_status=='Processing')
                        <a onclick="return confirm('Are you sure to cancel order')" class="btn btn-danger"
                         href="{{url('cencel_order',$order->id)}}">Cancel Order</a>
                         @else
                         <p>Not Allowed</p>
                         @endif
                    </td>
                </tr>
                @endforeach
            </table>


         <!-- end slider section -->
      </div>
      <!-- why section -->
       
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