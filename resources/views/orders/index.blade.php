<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order Saya</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($orders as $order)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between">
                        <strong>{{ $order->order_number }}</strong>
                        <span class="text-sm px-2 py-1 rounded bg-gray-100">{{ $order->status }}</span>
                    </div>
                    <ul class="mt-3 text-sm space-y-1">
                        @foreach ($order->items as $item)
                            <li>{{ $item->quantity }}x {{ $item->product->name }}
                                — Rp {{ number_format($item->price, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-3 font-semibold">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada order.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>