
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Inventory Management' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    {{ $slot }}
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow mb-4">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold">Inventory Management</div>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ url('/') }}" class="text-gray-800 hover:text-blue-600">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('inventory.index') }}" class="text-gray-800 hover:text-blue-600">Inventory</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>