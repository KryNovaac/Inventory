<x-header>
    <title>Edit Item</title>
</x-header>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Edit Item</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.update', $inventory->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <label for="item_name" class="font-bold">Item Name:</label>
            <input type="text" name="item_name" class="border rounded py-2 px-3" value="{{ $inventory->item_name }}" required>
        </div>
        <div class="flex flex-col">
            <label for="quantity" class="font-bold">Quantity:</label>
            <input type="number" name="quantity" class="border rounded py-2 px-3" value="{{ $inventory->quantity }}" required>
        </div>
        <div class="flex flex-col">
            <label for="price" class="font-bold">Price:</label>
            <input type="text" name="price" class="border rounded py-2 px-3" value="{{ $inventory->price }}" required>
        </div>
        <div class="flex flex-col">
            <label for="description" class="font-bold">Description:</label>
            <textarea name="description" class="border rounded py-2 px-3">{{ $inventory->description }}</textarea>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Update</button>
    </form>
</div>
</body>
</html>
