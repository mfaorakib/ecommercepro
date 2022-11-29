<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
    .center{
        margin: auto;
        text-align: center;
        margin-top: 40px;
    }
    .font_size{
        text-align: center;
        font-size: 40px;
        padding-top: 20px;
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
               <h2 class="font_size">All Product</h2>
                <table class="table table-striped table-bordered w-50 p-5 center">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Catagory</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    @foreach($product as $product)
                    <tr>
                        <th>{{$product->title}}</th>
                        <th>{{$product->description}}</th>
                        <th>{{$product->quantity}}</th>
                        <th>{{$product->price}}</th>
                        <th>{{$product->discount_price}}</th>
                        <th>{{$product->catagory}}</th>
                        <th>
                            <img src="/product/{{$product->image}}" alt="" srcset="">
                        </th>
                        <th>
                            <a href="{{url('delete_product',$product->id)}}"class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </th>
                        <th>
                            <a href="{{url('update_product',$product->id)}}" class="btn btn-primary">Edit</a>
                        </th>
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