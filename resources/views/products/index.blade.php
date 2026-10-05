<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} RidosaurusApp - E-commerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold">🛒 {{ config('app.name') }}</a>
            <nav class="space-x-4 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="underline">Login</a>
                    <a href="{{ route('register') }}" class="underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('home') }}" class="px-3 py-1 rounded-full text-sm {{ request('category') ? 'bg-white' : 'bg-gray-800 text-white' }}">Semua</a>
            @foreach ($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}"
                   class="px-3 py-1 rounded-full text-sm {{ request('category') === $cat->slug ? 'bg-gray-800 text-white' : 'bg-white' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <span class="text-xs text-gray-500">{{ $product->category->name }}</span>
                    <h3 class="font-semibold mt-1">{{ $product->name }}</h3>
                    <p class="text-indigo-600 font-bold mt-2">{{ $product->formatted_price }}</p>
                    <p class="text-xs mt-auto pt-2 text-gray-500">Stok: {{ $product->stock }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $products->links() }}</div>
    </main>
</body>
</html>