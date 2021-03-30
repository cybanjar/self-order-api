<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::with('ratings')->paginate(10));
    }

    public function store(Request $request)
    {
        $book = Book::create([
            'user_id' => $request->user()->id, // user()->id
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // return response()->json([
        //     'message' => true,
        //     'data' => $book
        // ]);
        return new BookResource($book);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
