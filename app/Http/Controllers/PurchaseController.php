<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();

        return view('purchase.index', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();

        return view('purchase.shopping', ['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {
        $data = $request->except('_token');

        $purchase = Purchase::create([
            'created_by' => auth()->user()->id,
            'total_price' => $data['total_price'],
        ]);

        if ($purchase){
            $purchaseDetails = [];
            foreach ($data['item_id'] as $index => $itemId) {
                $item = Item::findOrFail($itemId);
                $purchaseDetails[] = [
                    'purchase_id' => $purchase->id,
                    'item_id' => $itemId,
                    'item_name' => $item->name,
                    'item_price' => $item->price,
                    'quantity' => $data['quantity'][$index],
                    'subtotal_price' => $data['subtotal_price'][$index],
                ];
            }

            $purchase_details = PurchaseDetail::insert($purchaseDetails);

            if ($purchase_details){
                return to_route('purchases.index')->with('success', __('Purchase created successfully.'));
            }

            return to_route('purchases.index')->with('error', __('Purchase details creation failed.'));
        }

        return to_route('purchases.index')->with('error', __('Purchase creation failed.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.view', ['purchase' => $purchase->load('items', 'owner')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        if ($purchase->items()->delete()){
            if ($purchase->delete()) {
                return to_route('purchases.index')->with('success', __('Purchase deleted successfully.'));
            }

            return to_route('purchases.index')->with('error', __('Purchase deletion failed.'));
        }
        return to_route('purchases.index')->with('error', __('Purchase details deletion failed.'));
    }
}
