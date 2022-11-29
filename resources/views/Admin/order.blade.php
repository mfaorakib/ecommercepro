<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
   
    <style type="text/css">
        .center{
              /* margin: auto; */ */
            /* text-align: center; */
            margin-top: 40px;
        }
        table {
            width: 100%;
        }
        table tr th{
            padding: 5px;
        }
         
    </style>
  </head>
  <body >
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper table-responsive" >
                <h1 class="text-center">All Orders</h1>
                <form action="{{url('search')}}" method="GET" class="text-center p-5">
                    @csrf
                    <input type="text" name="search" placeholder="Search for Something" style="color:black">
                    <input type="submit" value="search" class="btn btn-primary">
                </form>
               
                <table class="table center table-sm table-bordered" style="width:">
                    <tr>
                    <th> Name </th>
                    <th> Email </th>
                    <th>Address </th>
                    <th>Phone </th>
                    <th>Product Title</th>
                    <th>Quantity </th>
                    <th>Price </th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th> Image</th>
                    <th>Delivered</th>
                    <th>Print PDF</th>
                    <th>Send Email</th>
                    </tr>
                    @forelse($order as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td> {{$order->email}}</td>
                        <td> {{$order->address}}</td>
                        <td> {{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td> {{$order->delivery_status}}</td>
                        <td>
                            <img src="/product/{{$order->image}}" alt="">
                        </td>
                        <td>
                            @if($order->delivery_status =='Proccessing')
                           
                            <a class="btn btn-primary"
                             href="{{url('delivered',$order->id)}}" 
                             onclick="return confirm('Are you sure this product is deliverd')">Delivered</a>
                          
                               
                           @else
                           <p style="color:brown">Deliverd</p>
                               
                           @endif
                        </td>
                        <td>
                            <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDf</a>
                        </td>
                        <td>
                            <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                        </td>

                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="16" class="text-center">No Data found</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>       
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>