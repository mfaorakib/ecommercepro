<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> </title>
</head>
<body>
    <div>
        <h1>Order Details</h1>
        <h3>Customer Name: {{$order->name}}</h3>
        <h3>Customer Email: {{$order->email}} </h3>
        <h3>Customer Address:{{$order->address}}</h3>
        <h3> Customer Mobile:{{$order->phone}}</h3>
        <h3> Customer ID:{{$order->user_id}}</h3>
        <h3> Product Tite:{{$order->product_title}}</h3>
        <h3>Product ID:{{$order->prodcut_id}}</h3>
        <h3> Product Quantity:{{$order->quantity}}</h3>
        <h3> Product Price:{{$order->price}}</h3>
        <h3>Product Payment_status:{{$order->payment_status}}</h3>
        <h3>Customer Delivery Update: {{$order->delivery_status}}</h3>
        <img src="product/{{$order->image}}">
      
    </div>
</body>
</html>