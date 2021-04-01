<?php

namespace App\Http\Controllers;

use App\Models\DataItem;
use App\Http\Resources\DataItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataItemController extends Controller
{
    public function index()
    {
        $dataItem = DataItem::all();
        return response()->json([
            'data' => $dataItem
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img'      => 'required',
            'item'     => 'required|string',
            'description' => 'required',
            'price' => 'required|integer',
            'qty' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Add data item Failed!'
            ], 401);
        }
        
        $dataItem = DataItem::create([
            'user_id' => auth()->user()->id, // user()->id
            'img' => $request->img,
            'item' => $request->item,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
        ]);

        return response()->json([
            'message' => 'Successfully',
            'data' => $dataItem
        ]);
        // return new DataItemResource($dataItem);
    }

    public function show(DataItem $dataItem)
    {
        return new DataItemResource($dataItem);
    }

    public function update(Request $request, DataItem $dataItem)
    {
        // check if currently auth use is the owner of the book
        if (auth()->user()->id !== $dataItem->user_id) {
            return response()->json([
                'error' => $this->errors(),
                'message' => 'You can only edit your own data item!'
            ], 403);
        }

        $dataItem->update($request->only(['item', 'description', 'price', 'qty']));

        return response()->json([
            'message' => 'Successfully',
            'data' => $dataItem
        ], 201);
        // return new DataItemResource($dataItem);
    }

    public function destroy(DataItem $dataItem)
    {
        if (auth()->user()->id !== $dataItem->user_id) {
            return response()->json([
                'message' => 'You cannot delete!'
            ], 403);
        }

        $dataItem->delete();

        return response()->json([
            'message' => 'Success deleted!'
        ], 200);
    }
}
