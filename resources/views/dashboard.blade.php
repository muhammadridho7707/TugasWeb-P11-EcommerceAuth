<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3">
                <p>Halo, <strong>{{ auth()->user()->name }}</strong>!
                    Role Anda: <span class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700">{{ auth()->user()->role }}</span>
                </p>

                <ul class="list-disc ml-5 space-y-1">
                    <li><a class="text-indigo-600 underline" href="{{ route('orders.index') }}">Order saya</a></li>
                    <li><a class="text-indigo-600 underline" href="{{ route('posts.index') }}">Daftar post</a></li>

                    @if (auth()->user()->isAdmin() || auth()->user()->isEditor())
                        <li><a class="text-indigo-600 underline" href="{{ route('posts.create') }}">Tulis post baru (admin/editor)</a></li>
                    @endif

                    @if (auth()->user()->isAdmin())
                        <li><a class="text-indigo-600 underline" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                        <li><a class="text-indigo-600 underline" href="{{ route('admin.eager-demo') }}">Demo Eager Loading</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>