<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\RentRequest;
use App\Models\RentStatus;


class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getRentedBooks(){
        $user = auth()->user();
        $books = RentRequest::where('user_id',$user_id)->where('status_id');
        
    }
    public function updateCart(Request $request){
        $user = auth()->user();
        $cart = Cart::where('user_id',$user->id)->first();
        $cartItem = CartItem::where('book_id',$request->book_id)->where('cart_id',$cart->id)->first();
        $book = Book::find($request->book_id);
        if($request->quantity>$book->quantity){
            $cartItem->quantity=$book->quantity;
        }
        else{
            $cartItem->quantity = $request->quantity;
        }
        $cartItem->save();
        return response()->json($cartItem);
    }
    public function addItem(Request $request){
        $user = auth()->user();
        $cart = Cart::where('user_id',$user->id)->first();
        if(!$cart){
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
        }
        $cartItem = CartItem::where('book_id',$request->book_id)->where('cart_id',$cart->id)->first();
        if($cartItem){
            $cartItem->quantity += $request->quantity;

        }
        else{
              $cartItem = new CartItem();
                $cartItem->cart_id = $cart->id;
                $cartItem->book_id = $request->book_id;
                $cartItem->quantity = $request->quantity;
        }

        $cartItem->save();

        return response()->json($cartItem);
    }

    public function removeItem(Request $request){
        // dd($request);
        $user = auth()->user();
        // dd($user);
        $cart = Cart::where('user_id',$user->id)->first();
        
        $cartItem = CartItem::where('cart_id',$cart->id)->where('book_id',$request->book_id)->first();
        if(!$cartItem){
            return response(['message'=>'product not found'],404);
        }
        
        $cartItem->delete();
        return response()->json(['message'=>'item removed']);
    }

    public function getcart(){
        $user = auth()->user();
        $cart = Cart::where('user_id',$user->id)->first();
        if(!$cart){
            return response(['message'=>'no item found'],404);
        }
        $cartItems = CartItem::where('cart_id',$cart->id)->get();
        if(!$cartItems){
            return response(['message  '=>'no item found'],404);
        }
        return response()->json($cartItems);
    }

    
}