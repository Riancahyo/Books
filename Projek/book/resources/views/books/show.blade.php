<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Detail Buku</h1>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-5">
                        <!-- Gambar Buku -->
                        <div class="flex justify-center mb-6">
                            @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" 
                                     alt="{{ $book->title }}" 
                                     class="rounded-md border shadow w-60">
                            @else
                                <div class="w-60 h-80 flex items-center justify-center bg-gray-100 border rounded">
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                        <!-- ID -->
                        <div>
                            <label class="block font-semibold mb-1">ID</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->id }}
                            </p>
                        </div>

                        <!-- User ID -->
                        <div>
                            <label class="block font-semibold mb-1">User ID</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->user_id }}
                            </p>
                        </div>

                        <!-- Judul -->
                        <div>
                            <label class="block font-semibold mb-1">Judul</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->title }}
                            </p>
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label class="block font-semibold mb-1">Penulis</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->author }}
                            </p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block font-semibold mb-1">Deskripsi</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->description }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-semibold mb-1">Status</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->status }}
                            </p>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="block font-semibold mb-1">Kategori</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $book->category->name ?? 'Tanpa Kategori' }}
                            </p>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end gap-3 mt-6">
                            <a href="{{ route('books.edit', $book->id) }}" 
                               class="px-5 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <a href="{{ route('books.index') }}" 
                               class="px-5 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                                Kembali
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                        class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
