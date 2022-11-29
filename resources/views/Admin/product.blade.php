<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
    .div-center{
        text-align: center;
        padding-top: 40px;
    }
    .font_size{
        font-size: 40px;
        padding-bottom: 40px;
    }
    .text_color{
        color:black
    }
    label{
        display: inline-block;
        width: 200px
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
                    <h1 class="font_size">Add Product</h1>
                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <label> Product Title: </label>
                    <input class="text_color" type="text" name="title" placeholder="product title" required="">
                    <br>
                    <br>
                    <label> Product Description: </label>
                    <input class="text_color"  type="text" name="description" placeholder="product Description"  required="">
                    <br>
                    <br>
                    <label> Product Price:</label>
                    <input class="text_color"  type="number" name="price" placeholder="product price"  required="">
                    <br>
                    <br>
                    <label>Discount Price:</label>
                    <input class="text_color"  type="number" name="discount_price" placeholder="discount_price"   >
                    <br>
                    <br>
                    <label> Product Quantity:</label>
                    <input class="text_color"  type="number" min="0" name="quantity" placeholder="product quantity"  required="">
                    <br>
                    <br>
                    <label> Product Catagory:</label>
                     <select class="text_color" name="catagory"  required="">
                            <option value="" selected="">Add A Catagory Here</option>
                            @foreach($catagory as $catagory)
                            <option value=" {{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                     </select>
                    <br>
                    <br>
                    <label> Select Product Image Here: </label>
                     <input   type="file"  name="image"  required="">
                     <br>
                     <br>
                     <input type="submit" value="Add Product" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>        
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>