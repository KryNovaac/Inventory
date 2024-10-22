<!-- resources/views/home.blade.php -->
<x-header>
    <title>Home - Inventory Management</title>
</x-header>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Welcome to the Inventory Management System</h1>
    <p class="text-lg mb-6">
        Manage your inventory efficiently with our easy-to-use platform. Use the navigation menu to explore the available features.
    </p>

    <div class="mt-8">
        <a href="{{ route('inventory.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Go to Inventory List
        </a>
    </div>
</div>
