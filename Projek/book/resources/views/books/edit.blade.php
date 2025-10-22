<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Edit Buku</h1>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- User ID -->
                        <div>
                            <label for="user_id" class="block font-semibold mb-1">User ID</label>
                            <input type="text" name="user_id" id="user_id" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('user_id', $book->user_id) }}" required>
                        </div>

                        <!-- Judul -->
                        <div>
                            <label for="title" class="block font-semibold mb-1">Judul</label>
                            <input type="text" name="title" id="title" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('title', $book->title) }}" required>
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label for="author" class="block font-semibold mb-1">Penulis</label>
                            <input type="text" name="author" id="author" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('author', $book->author) }}" required>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>{{ old('description', $book->description) }}</textarea>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-semibold mb-1">Status</label>
                            <select name="status" id="status" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                                <option value="Tersedia" {{ $book->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Tidak_Tersedia" {{ $book->status == 'Tidak_Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category_id" class="block font-semibold mb-1">Kategori</label>
                            <select name="category_id" id="category_id" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Google Drive Link -->
                        <div>
                            <label for="gdrive_link" class="block font-semibold mb-1">Google Drive Link</label>
                            <input type="url" name="gdrive_link" id="gdrive_link" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   placeholder="https://drive.google.com/..." 
                                   value="{{ old('gdrive_link', $book->gdrive_link) }}">
                        </div>

                        <!-- Gambar Buku -->
                        <div>
                            <label for="image" class="block font-semibold mb-1">Gambar Buku</label>
                            <input type="file" name="image" id="image" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">

                            @if ($book->image)
                                <div class="mt-3">
                                    <p class="font-semibold text-gray-700 mb-2">Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $book->image) }}" 
                                         alt="Current Book Image" 
                                         class="rounded-md border shadow w-40">
                                </div>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('books.index') }}" 
                            class="px-5 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Perbarui Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
