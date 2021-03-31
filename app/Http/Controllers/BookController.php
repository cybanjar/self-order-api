<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    public function index()
    {
        return BookResource::collection(Book::with('ratings')->orderBy('id')->paginate(25));
    }

    public function store(Request $request)
    {
        $book = Book::create([
            'user_id' => auth()->user()->id, // user()->id
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Successfully',
        //     'data' => $book
        // ]);
        return new BookResource($book);
    }

    public function show(Book $book)
    {
        return new BookResource($book); // use route model binding
    }

    public function update(Request $request, Book $book)
    {
        // check if currently auth use is the owner of the book
        if(auth()->user()->id !== $book->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit your own book!'
            ], 403);
        }

        $book->update($request->only(['title', 'description']));
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        if(auth()->user()->id !== $book->user_id) {
            return response()->json([
                'message' => 'You cannot delete!'
            ], 403);
        }

        $book->delete();

        return response()->json([
            'message' => 'Success deleted!'
        ], 200);
    }
}
