<x-app-layout>
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">{{__('Create New Purchase')}}</h1>

        <form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
            @csrf
            <div id="itemList" class="space-y-4 mb-6">
                <!-- Item rows will be added here dynamically -->
            </div>

            <div class="mb-4">
                <button type="button" id="addItem" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    {{__('Add Item')}}
                </button>
            </div>

            <div class="mb-4">
                <label for="total_price" class="block text-sm font-medium text-gray-700">{{__('Total Price')}}</label>
                <input type="number" id="total_price" name="total_price" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <button type="submit" id="submitButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" disabled>
                    {{__('Create Purchase')}}
                </button>
            </div>
        </form>
    </div>
        </div>
    </div>

    @push('footer')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const itemList = document.getElementById('itemList');
                const addItemButton = document.getElementById('addItem');
                const totalPriceInput = document.getElementById('total_price');
                const submitButton = document.getElementById('submitButton');
                const items = @json($items);
                let rowCount = 0;

                function updateTotalPrice() {
                    let total = 0;
                    document.querySelectorAll('[name^="subtotal_price"]').forEach(input => {
                        total += parseFloat(input.value) || 0;
                    });
                    totalPriceInput.value = total.toFixed(2);
                }

                function updateDeleteButtons() {
                    const deleteButtons = document.querySelectorAll('.deleteRow');
                    deleteButtons.forEach(button => {
                        button.disabled = rowCount <= 1;
                        button.classList.toggle('opacity-50', rowCount <= 1);
                        button.classList.toggle('cursor-not-allowed', rowCount <= 1);
                    });
                }

                function updateSubmitButton() {
                    submitButton.disabled = rowCount === 0;
                    submitButton.classList.toggle('opacity-50', rowCount === 0);
                    submitButton.classList.toggle('cursor-not-allowed', rowCount === 0);
                }

                function createItemRow() {
                    const row = document.createElement('div');
                    row.className = 'flex items-center space-x-4';
                    row.innerHTML = `
                <select name="item_id[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">Select an item</option>
                    ${items.map(item => `<option value="${item.id}" data-price="${item.price}">${item.name} - $${item.price}</option>`).join('')}
                </select>
                <input type="number" name="quantity[]" min="1" value="1" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <input type="number" name="subtotal_price[]" readonly class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button type="button" class="deleteRow bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
            `;

                    const select = row.querySelector('select');
                    const quantityInput = row.querySelector('input[name^="quantity"]');
                    const subtotalInput = row.querySelector('input[name^="subtotal_price"]');

                    select.addEventListener('change', updateSubtotal);
                    quantityInput.addEventListener('input', updateSubtotal);

                    function updateSubtotal() {
                        const selectedOption = select.options[select.selectedIndex];
                        const price = parseFloat(selectedOption.dataset.price) || 0;
                        const quantity = parseInt(quantityInput.value) || 0;
                        subtotalInput.value = (price * quantity).toFixed(2);
                        updateTotalPrice();
                    }

                    row.querySelector('.deleteRow').addEventListener('click', function() {
                        row.remove();
                        rowCount--;
                        updateTotalPrice();
                        updateDeleteButtons();
                        updateSubmitButton();
                    });

                    itemList.appendChild(row);
                    rowCount++;
                    updateSubtotal();
                    updateDeleteButtons();
                    updateSubmitButton();
                }

                addItemButton.addEventListener('click', createItemRow);

                createItemRow();
            });
        </script>
    @endpush
</x-app-layout>
