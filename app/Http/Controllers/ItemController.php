<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function index()
    {
        return ItemResource::collection(Item::paginate());
    }

    public function store(Request $request)
    {
        $item = Item::create($request->only('title', 'description', 'image', 'quantity'));
        return response(new ItemResource($item), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return new ItemResource(Item::find($id));
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $item->update($request->only('title', 'description', 'image', 'quantity'));

        return response(new ItemResource($item), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        return Item::destroy($id);

        return \response(null, Response::HTTP_NO_CONTENT);
    }
}
