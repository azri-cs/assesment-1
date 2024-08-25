<x-app-layout>
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold mb-6">{{__('Purchase Details')}}</h1>

                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <p class="text-gray-700 text-sm font-bold mb-2">Created By:</p>
                        <p class="text-gray-700">{{ $purchase->owner->name }}</p>
                        <p class="text-gray-700">{{ $purchase->owner->email }}</p>
                        <p class="text-gray-700">{{ $purchase->owner->phone_number }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700 text-sm font-bold mb-2">Status:</p>
                        <p class="text-gray-700">{{ ucfirst($purchase->status) }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700 text-sm font-bold mb-2">Created At:</p>
                        <p class="text-gray-700">{{ $purchase->created_at->format('F j, Y, g:i a') }}</p>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4">{{__('Purchased Items')}}</h2>

                <div class="overflow-x-auto">
                    <table class="w-full bg-white shadow-md rounded mb-4">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">{{__('Item Name')}}</th>
                            <th class="py-3 px-6 text-right">{{__('Price')}}</th>
                            <th class="py-3 px-6 text-right">{{__('Quantity')}}</th>
                            <th class="py-3 px-6 text-right">{{__('Subtotal')}}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach($purchase->items as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $item->item_name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-right">
                                    ${{ number_format($item->item_price, 2) }}
                                </td>
                                <td class="py-3 px-6 text-right">
                                    {{ $item->quantity }}
                                </td>
                                <td class="py-3 px-6 text-right">
                                    ${{ number_format($item->subtotal_price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-gray-50 font-bold">
                            <td class="py-3 px-6 text-right" colspan="3">{{__('Total')}}:</td>
                            <td class="py-3 px-6 text-right">${{ number_format($purchase->total_price, 2) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('purchases.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{__('Back to Purchases')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
