<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(2);
        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3|unique:items,name",
            "price" => "required|numeric|gte:50",
            "stock" => "required|numeric|gte:3|lte:100"
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(["message" => "Item not found"], 404);
        }
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|min:3|unique:items,name,$id",
            "price" => "required|numeric|gte:50",
            "stock" => "required|numeric|gte:3|lte:100"
        ]);

        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(["message" => "Item not found"], 404);
        }

        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->update();

        return response()->json(["message" => "Item update successful"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(["message" => "Item not found"], 404);
        }
        $item->delete();
        return response()->json(["message" => "Item delete successful"], 204);
    }
}
