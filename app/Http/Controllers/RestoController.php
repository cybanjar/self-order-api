<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestoController extends Controller
{
    public function index()
    {
        $resto = Resto::all();
        
        return response()->json([
            'data' => $resto
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_name' => 'required|min:3',
            'qty' => 'required|integer'
        ]);

        if(!$validateData) {
            return response()->json([
                'data' => 'Gagal ditambahkan!',
                'error' => $request->errors()
            ]);
        }

        $resto = Resto::create([
            'user_name' => $request->user_name,
            'item_name' => $request->item_name,
            'img' => $request->img,
            'icons' => $request->icons, 
            'description' => $request->description, 
            'total' => $request->total,
            'qty' => $request->qty,
            'note' => $request->note,
            'popular' => $request->popular,
            'table' => $request->table,
            'tax' => $request->tax,
            'service' => $request->service,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Successfully add data',
            'data' => $resto
        ]);
    }

    public function show($id)
    {
        $resto = Resto::find($id);
        return response()->json([
            'data' => $resto
        ]);
    }

    public function update(Request $request, $id)
    {
        $resto = Resto::find($id);
        
        if(!$resto) {
            return response()->json([
                'message'   => 'Not update!',
            ], 403);
        }

        $request->validate([
            'user_name' => 'required|min:3',
            'qty' => 'required|integer'
        ]);

        $data = $request->all();
        $resto->fill($data);
        $resto->save();

        return response()->json([
            'message'   => 'Update data success',
            'data'      => $resto
        ]);
    }

    public function destroy($id)
    {
        $resto = Resto::find($id);
        if (!$resto) {
            return response()->json([
                'message' => "Not found!",
            ]);
        } else {
            $resto->delete();
            return response()->json([
                'message' => 'Success deleted!'
            ]);

        }

    }
}
