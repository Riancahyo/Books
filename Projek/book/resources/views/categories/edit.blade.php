<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Edit Kategori</h1>

                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Edit --}}
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kategori -->
                        <div>
                            <label for="name" class="block font-semibold mb-1">Nama Kategori</label>
                            <input type="text" name="name" id="name"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   value="{{ old('name', $category->name) }}" required>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                      required>{{ old('description', $category->description) }}</textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('categories.index') }}" 
                               class="px-5 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Perbarui Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
