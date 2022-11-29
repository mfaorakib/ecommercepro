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
                    <h1 class="font_size">Update Product</h1>
                    <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <label> Product Title: </label>
                    <input class="text_color" type="text" name="title" value="{{$product->title}}" placeholder="product title" required="">
                    <br>
                    <br>
                    <label> Product Description: </label>
                    <input class="text_color"  type="text" name="description" value="{{$product->description}}" placeholder="product Description"  required="">
                    <br>
                    <br>
                    <label> Product Price:</label>
                    <input class="text_color"  type="number" name="price" value="{{$product->price}}" placeholder="product price"  required="">
                    <br>
                    <br>
                    <label>Discount Price:</label>
                    <input class="text_color"  type="number" name="discount_price"value="{{$product->discount_price}}" placeholder="discount_price"   >
                    <br>
                    <br>
                    <label> Product Quantity:</label>
                    <input class="text_color"  type="number" min="0" name="quantity" value="{{$product->quantity}}" placeholder="product quantity"  required="">
                    <br>
                    <br>
                    <label> Product Catagory:</label>
                     <select class="text_color" name="catagory"  required="">
                            <option value="{{$product->catagory}}" selected=""> {{$product->catagory}} </option>
                              @foreach($catagory as $catagory)
                            <option value=" {{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                            @endforeach  
                     </select>
                    <br>
                    <br>
                    <label> Current Product Image Here: </label>
                     <img style="margin: auto" height="100" width="100" name="image" src="/product/{{$product->image}}"  required="">
                     <br>
                     <br>
                    <label> Select Product Image Here: </label> 
                     <input   type="file"  name="image" >
                     <br>
                     <br>
                     <input type="submit" value="Update Product" class="btn btn-primary">
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