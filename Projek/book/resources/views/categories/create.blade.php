<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Buat Kategori Baru</h1>

                    <!-- Error -->
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success -->
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Nama Kategori -->
                        <div>
                            <label for="name" class="block font-semibold mb-1">Nama Kategori</label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   required>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('categories.index') }}"
                               class="px-5 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
