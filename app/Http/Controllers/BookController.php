<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function addCategory(Request $request){
        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return response()->json($category);
    }
    public function deleteCategory(Request $request){
        $category = Category::findorfail($request->id);
        $category->delete();
        return response()->json(['message'=>'deleted']);
    }
    public function modifyCategory(Request $request){
        $category = Category::findorfail($request->id);
        $category->title = $request->title;
        $category->save();
        return response()->json($category);
    }


    public function addBook(Request $request){
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->rent_price = $request->rent_price;
        $book->category_id = $request->category_id;
        $book->quantity = $request->quantity;
        $book->save();
        return response()->json($book);
    }

    public function deleteBook(Request $request){
        $book = Book::findorfail($request->id);
        $book->delete();
        return response()->json(['message'=>'sucessfully deleted ']);
    }

    public function modifyBook(Request $request){
        $book = Book::findorfail($request->id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->rent_price = $request->rent_price;
        $book->category_id = $request->category_id;
        $book->quantity = $request->quantity;
        $book->save();
        return response()->json($book);
    }

    public function books(){
        return response()->json(Book::all());
    }
    public function categories(){
        return response()->json(Category::all());
    }
    //

}
