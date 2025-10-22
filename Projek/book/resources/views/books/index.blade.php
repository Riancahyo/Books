<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>

                    {{-- Alert sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 text-green-800 bg-green-100 border border-green-300 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tombol aksi atas --}}
                    <div class="flex justify-between mb-4">
                        <a href="{{ route('books.create') }}"
                           class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Buku Baru
                        </a>
                        <a href="{{ route('books.trashed') }}"
                           class="flex items-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0H7a2 2 0 00-2 2v2h14V5a2 2 0 00-2-2h-3z"/>
                            </svg>
                            Lihat Arsip
                        </a>
                    </div>

                    {{-- Tabel --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 text-sm text-gray-700">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border text-center">ID</th>
                                    <th class="px-3 py-2 border text-center">User ID</th>
                                    <th class="px-3 py-2 border text-center">Judul</th>
                                    <th class="px-3 py-2 border text-center">Penulis</th>
                                    <th class="px-3 py-2 border text-center">Deskripsi</th>
                                    <th class="px-3 py-2 border text-center">Status</th>
                                    <th class="px-3 py-2 border text-center">Kategori</th>
                                    <th class="px-3 py-2 border text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr class="hover:bg-gray-50 {{ $book->trashed() ? 'bg-yellow-100' : '' }}">
                                        <td class="px-3 py-2 border text-center">{{ $book->id }}</td>
                                        <td class="px-3 py-2 border text-center">{{ $book->user_id }}</td>
                                        <td class="px-3 py-2 border text-center font-medium">{{ $book->title }}</td>
                                        <td class="px-3 py-2 border text-center">{{ $book->author }}</td>
                                        <td class="px-3 py-2 border">{{ $book->description ?? '-' }}</td>
                                        <td class="px-3 py-2 border text-center">
                                            <span class="px-2 py-1 rounded text-xs font-semibold 
                                                {{ $book->status === 'Tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $book->status }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 border text-center">{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                                        <td class="px-3 py-2 border text-center">
                                            <div class="flex justify-center gap-1">
                                                @if ($book->trashed())
                                                    {{-- Restore --}}
                                                    <form action="{{ route('books.restore', $book->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M3 10h10a4 4 0 014 4v6m0 0H9a4 4 0 01-4-4v-1m14 5l-3-3m0 0l-3 3m3-3V4"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    {{-- Hapus Permanen --}}
                                                    <form action="{{ route('books.force-delete', $book->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0H7a2 2 0 00-2 2v2h14V5a2 2 0 00-2-2h-3z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- Detail --}}
                                                    <a href="{{ route('books.show', $book->id) }}"
                                                       class="p-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                    </a>
                                                    {{-- Edit --}}
                                                    <a href="{{ route('books.edit', $book->id) }}"
                                                       class="p-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M11 4H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-4M18.414 2.586a2 2 0 112.828 2.828L12 14l-4 1 1-4 9.414-9.414z"/>
                                                        </svg>
                                                    </a>
                                                    {{-- Hapus --}}
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0H7a2 2 0 00-2 2v2h14V5a2 2 0 00-2-2h-3z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-3 py-2 border text-center">Tidak ada data buku.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginasi --}}
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Tambahkan style untuk pagination aktif --}}
<style>
    .pagination .active .page-link {
        background-color: #2563eb !important; /* biru Tailwind */
        color: white !important;
        border-color: #2563eb !important;
    }
</style>
