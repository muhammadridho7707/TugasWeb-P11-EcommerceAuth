<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded shadow"><p class="text-xs text-gray-500">User</p><p class="text-2xl font-bold">{{ $totalUsers }}</p></div>
                <div class="bg-white p-4 rounded shadow"><p class="text-xs text-gray-500">Produk</p><p class="text-2xl font-bold">{{ $totalProducts }}</p></div>
                <div class="bg-white p-4 rounded shadow"><p class="text-xs text-gray-500">Order</p><p class="text-2xl font-bold">{{ $totalOrders }}</p></div>
                <div class="bg-white p-4 rounded shadow"><p class="text-xs text-gray-500">Omzet (paid)</p><p class="text-2xl font-bold">Rp {{ number_format($revenue, 0, ',', '.') }}</p></div>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold mb-2">User per role</h3>
                @foreach ($usersByRole as $role => $total)
                    <p class="text-sm">{{ $role }}: <strong>{{ $total }}</strong></p>
                @endforeach
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold mb-2">5 Order Terbaru</h3>
                @foreach ($latestOrders as $o)
                    <p class="text-sm">{{ $o->order_number }} — {{ $o->user->name }} — {{ $o->status }}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>