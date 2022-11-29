<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use Illuminate\Support\Facades\Auth;
use App\Models\product;
use App\Models\order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    //
    public function view_catagory(){
        if(Auth::id()){
            $data = catagory::all();
            return view('admin.catagory',compact('data'));
        }
        else{
            return redirect('login');
        }
    }
    public function add_catagory( Request $request){
        if(Auth::id()){
            $data = new catagory;
        $data-> catagory_name=$request->catagory;
        $data->save();
        return redirect()->back()->with('message', 'successfuly add catagory');  
        }
        else{
            return redirect('login');
        }
        
       

    }
    public function delete_catagory($id){
        if(Auth::id()){
            $data=catagory::find($id);
            $data->delete();
            return redirect()->back()->with('message','successfully delete catagory');
        }
       
        else{
            return redirect('login');
        }
       
    }
    public function view_product(){
        if(Auth::id()){
            $catagory = catagory::all();
            return view('admin.product',compact('catagory'));
        }
        else{
            return redirect('login');
        }
       
    }
    public function add_product(Request $request){
        if(Auth::id()){
            $product=new product;
            $product->title=$request->title;
            $product->description=$request->description; 
            $product->quantity=$request->quantity; 
            $product->price=$request->price; 
            $product->discount_price=$request->discount_price; 
            $product->catagory=$request->catagory; 
            $image=$request->image; 
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image = $imagename;
            $product->save();
            return redirect()->back()->with('message','product added successfully');
        }
        else{
            return redirect('login');
        }
      

    }
    public function show_product(){
        if(Auth::id()){
            $product=product::all();
            return view('admin.show_product',compact('product'));
        }
        else{
              return redirect('login');
        }
       
    }
    public function delete_product($id){
            if(Auth::id()){
                $product = product::find($id);
                $product ->delete();
                return redirect()->back()->with('message','successfully delete product');
            }
            else{
                return redirect('login');
          }
    }
    public function update_product($id){
        if(Auth::id()){
            $product =product::find($id);
            $catagory=catagory::all();
            return view('admin.update_product',compact('product','catagory'));
        }
        else{
            return redirect('login');
      }
       
    }
    public function update_product_confirm(Request $request, $id){
        
        $product = product::find($id);
        $product->title=$request->title;
        $product->description=$request->description; 
        $product->quantity=$request->quantity; 
        $product->price=$request->price; 
        $product->discount_price=$request->discount_price; 
        $product->catagory=$request->catagory; 
        $image=$request->image; 
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image = $imagename;
        }
        
        $product->save();
        return redirect()->back()->with('message','Update product successfully');
    }
    public function order(){
        $order=order::all();
        return view('admin.order',compact('order'));
    }
    public function delivered($id){
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="paid";
        $order->save();

        return redirect()->back();


    }
    public function print_pdf($id){
        $order = order::find($id);
        $pdf = PDf::loadview('admin.pdf',compact('order'));
        return $pdf->download("Order_details.pdf");
    }
    public function send_email($id){
        $order=order::find($id);

        return view('admin.email_info',compact('order'));
    }
    public function send_user_email(Request $request, $id){
        $order=order::find($id);

        $details = [
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,
        ];
         Notification::send($order , new SendEmailNotification($details));
         return redirect()->back();
    }
    public function searchdata(Request $request){
              $searchtext = $request->search;
              $order =order::where('name','LIkE',"%$searchtext%")
              ->orwhere('phone','LIkE',"%$searchtext%")->orwhere('product_title','LIkE',"%$searchtext%") ->get();
               return view('admin.order',compact('order'));
    }
}
