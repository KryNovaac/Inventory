<x-header>
    <title>Inventory List</title>
</x-header>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Inventory List</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mt-4 rounded">{{ session('success') }}</div>
    @endif

    <!-- Search and Sort Form -->
    <form method="GET" action="{{ route('inventory.index') }}" class="mb-4 flex space-x-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search items..." class="border border-gray-300 rounded py-2 px-4 w-1/2">
        
        <select name="sort_by" class="border border-gray-300 rounded py-2 px-4">
            <option value="item_name" {{ request('sort_by') == 'item_name' ? 'selected' : '' }}>Sort by Name</option>
            <option value="quantity" {{ request('sort_by') == 'quantity' ? 'selected' : '' }}>Sort by Quantity</option>
            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Sort by Price</option>
        </select>

        <select name="sort_direction" class="border border-gray-300 rounded py-2 px-4">
            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
    </form>

    @if ($items->isEmpty())
        <div class="bg-yellow-100 text-yellow-700 p-4 mt-4 rounded">
            No items found in the inventory.
        </div>
        <a href="{{ route('inventory.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">
            Add New Item
        </a>
    @else
        <a href="{{ route('inventory.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Add New Item
        </a>

        <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Item Name</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td class="border px-4 py-2">{{ $item->item_name }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">${{ number_format($item->price, 2) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('inventory.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded">Edit</a>
                            <button 
                                class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded delete-button" 
                                data-item-id="{{ $item->id }}" 
                                data-item-name="{{ $item->item_name }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $items->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-bold mb-4">Confirm Deletion</h3>
        <p>Are you sure you want to delete <span id="itemName" class="font-semibold"></span>?</p>
        <div class="mt-4">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" id="confirmDelete" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded mr-2">Delete</button>
                <button type="button" id="cancelDelete" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteModal = document.getElementById('deleteModal');
        const itemNameDisplay = document.getElementById('itemName');
        const deleteForm = document.getElementById('deleteForm');
        const confirmDeleteButton = document.getElementById('confirmDelete');
        const cancelDeleteButton = document.getElementById('cancelDelete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const itemId = this.getAttribute('data-item-id');
                const itemName = this.getAttribute('data-item-name');
                itemNameDisplay.textContent = itemName;
                deleteForm.action = `/inventory/${itemId}`;
                deleteModal.classList.remove('hidden');
            });
        });

        cancelDeleteButton.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
        });

        confirmDeleteButton.addEventListener('click', function () {
            deleteForm.submit();
        });
    });
</script>
