<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Demo Eager Loading</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
            <p>Mengambil 20 produk + nama kategori masing-masing:</p>
            <p>❌ Tanpa eager loading (N+1): <strong>{{ $lazyCount }} query</strong></p>
            <p>✅ Dengan <code>with('category')</code>: <strong>{{ $eagerCount }} query</strong></p>
        </div>
    </div>
</x-app-layout>