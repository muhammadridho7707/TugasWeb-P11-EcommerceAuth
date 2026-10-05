<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded text-sm">+ Post Baru</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            @foreach ($posts as $post)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $post->title }}</h3>
                            <p class="text-xs text-gray-500">
                                oleh {{ $post->author->name }} · {{ $post->created_at->diffForHumans() }}
                                @unless ($post->is_published) · <span class="text-red-600">Draft</span> @endunless
                            </p>
                        </div>

                        <div class="flex gap-2">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="text-sm text-indigo-600 underline">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('Hapus post ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-sm text-red-600 underline">Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <p class="mt-3 text-gray-700">{{ Str::limit($post->body, 200) }}</p>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>