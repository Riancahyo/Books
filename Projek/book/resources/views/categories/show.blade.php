<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Detail Kategori</h1>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-5">
                        <!-- ID -->
                        <div>
                            <label class="block font-semibold mb-1">ID Kategori</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->id }}
                            </p>
                        </div>

                        <!-- Nama -->
                        <div>
                            <label class="block font-semibold mb-1">Nama Kategori</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->name }}
                            </p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block font-semibold mb-1">Deskripsi</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50 min-h-[100px]">
                                {{ $category->description }}
                            </p>
                        </div>

                        <!-- Dibuat -->
                        <div>
                            <label class="block font-semibold mb-1">Dibuat Pada</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->created_at ? $category->created_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <!-- Diperbarui -->
                        <div>
                            <label class="block font-semibold mb-1">Diperbarui Pada</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->updated_at ? $category->updated_at->format('d-m-Y H:i') : '-' }}
                            </p>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end gap-3 mt-6">
                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="px-5 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <a href="{{ route('categories.index') }}" 
                               class="px-5 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                                Kembali
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
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
