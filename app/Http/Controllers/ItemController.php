<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return view('item.index',['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): RedirectResponse
    {
        $data = $request->except('_token');
        $data['price'] = number_format((float)$data['price'], 2, '.', '');
        $item = Item::create($data);

        if ($item) {
            return to_route('items.index')->with('success', __('Item created successfully.'));
        }

        return to_route('items.index')->with('error', __('Item creation failed.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        $data = $request->except('_token');

        if($item->update($data)){
            return to_route('items.index')->with('success', __('Item updated successfully.'));
        }

        return to_route('items.index')->with('error', __('Item update failed.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        if ($item->delete()) {
            return to_route('items.index')->with('success', __('Item deleted successfully.'));
        }

        return to_route('items.index')->with('error', __('Item deletion failed.'));
    }
}
