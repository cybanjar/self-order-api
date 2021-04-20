<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();

        return response()->json([
            'data' => $banner
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'img' => 'required',
            'promo' => 'required',
            'item_name' => 'required|string',
            'description' => 'required'
        ]);

        if (!$validateData) {
            return response()->json([
                'data' => 'Failed!',
                'error' => $request->errors()
            ]);
        }

        $banner = Banner::create([
            'promo' => $request->promo,
            'item_name' => $request->item_name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Successfully add data',
            'data' => $banner
        ]);
    }

    public function show($id)
    {
        $banner = Banner::find($id);
        return response()->json([
            'data' => $banner
        ]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'message'   => 'Not update!',
            ], 403);
        }

        // $request->validate([
        //     'img' => 'required',
        //     'promo' => 'required',
        //     'item_name' => 'required',
        //     'description' => 'required'
        // ]);

        $data = $request->all();
        $banner->fill($data);
        $banner->save();

        return response()->json([
            'message'   => 'Update data success',
            'data'      => $banner
        ]);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json([
                'message' => "Not found!",
            ]);
        } else {
            $banner->delete();
            return response()->json([
                'message' => 'Success deleted!'
            ]);
        }
    }
}
