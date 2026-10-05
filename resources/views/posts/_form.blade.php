@csrf
<div>
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $post->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="body" value="Isi" />
    <textarea id="body" name="body" rows="8" required
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('body', $post->body ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>

<label class="mt-4 inline-flex items-center">
    <input type="checkbox" name="is_published" value="1" class="rounded"
           @checked(old('is_published', $post->is_published ?? false))>
    <span class="ms-2 text-sm">Publikasikan</span>
</label>

<div class="mt-6">
    <x-primary-button>Simpan</x-primary-button>
    <a href="{{ route('posts.index') }}" class="ms-3 text-sm underline">Batal</a>
</div>