<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\models\Product;
use App\models\Cart;
use App\models\Order;
use App\models\Comment;
use App\models\Reply;
use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function redirect()
    {
        $userteype = Auth::user()->userteype;
        if ($userteype == '1') {
            $totalproduct = product::all()->count();
            $totalorder = order::all()->count();
            $totalcustomer = user::all()->count();
            $order = order::all();
            $totalsell = 0;
            foreach ($order as $order) {
                $totalsell = $totalsell + $order->price;
            }

            $totaldelivered = order::where(
                'delivery_status',
                '=',
                'delivered'
            )->count();
            $totalprocessing = order::where(
                'delivery_status',
                '=',
                'Proccessing'
            )->count();

            return view(
                'admin.home',
                compact(
                    'totalproduct',
                    'totalorder',
                    'totalcustomer',
                    'totalsell',
                    'totaldelivered',
                    'totalprocessing'
                )
            );
        } else {
            $product = Product::paginate(10);
            $comment = Comment::orderby('id', 'desc')->get();
            $reply = Reply::all();
            return view(
                'home.userpage',
                compact('product', 'comment', 'reply')
            );
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    public function add_to_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid=$user->id;
            $product = Product::find($id);
            $product_exist_id=cart::where('prodcut_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
           
             if($product_exist_id){
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price *  $cart->quantity;
                } else {
                    $cart->price = $product->price *  $cart->quantity;
                }
               
               
                $cart ->save();
                
                return redirect()->back()->with('message','Product added successfully');
            }
            else{
                $cart = new cart();
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                $cart->quantity = $request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
    
                $cart->image = $product->image;
                $cart->prodcut_id = $product->id;
                $cart->save();
                return redirect()->back()->with('message','Product added successfully');

            }
           

            // dd($product);
        } else {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();
        foreach ($data as $data) {
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->prodcut_id = $data->prodcut_id;
            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'Proccessing';

            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()
            ->back()
            ->with(
                'message',
                ' We received your order . we will contact with you soon'
            );
    }
    public function stripe($Totalprice)
    {
        return view('home.stripe', compact('Totalprice'));
    }
    public function stripePost(Request $request, $Totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            'amount' => $Totalprice * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Thanks for payment',
        ]);
        $user = Auth::user();
        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();
        foreach ($data as $data) {
            $order = new order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->prodcut_id = $data->prodcut_id;
            $order->payment_status = 'paid';
            $order->delivery_status = 'Proccessing';

            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }
    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $order = order::where('user_id', '=', $userid)->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }
    public function cencel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You Canceld The Order';
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $comment = new comment();
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new reply();
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function product_search(Request $request)
    {
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")
            ->orWhere('catagory', 'LIKE', "$search_text")
            ->paginate(10);
        return view('home.userpage', compact('product', 'comment', 'reply'));
    }
    public function product()
    {
        $product = Product::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        return view(
            'home.all_products',
            compact('product', 'comment', 'reply')
        );
    }
    public function search_product(Request $request)
    {
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")
            ->orWhere('catagory', 'LIKE', "$search_text")
            ->paginate(10);
        return view(
            'home.all_products',
            compact('product', 'comment', 'reply')
        );
    }
}
