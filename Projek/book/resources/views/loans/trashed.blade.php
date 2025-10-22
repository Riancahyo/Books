<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4 font-bold text-lg">Arsip Peminjaman</h1>

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('loans.index') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-4 inline-block">
                        < Kembali ke Daftar Peminjaman
                    </a>

                    <div class="w-full overflow-x-auto">
                        <table class="w-full border border-gray-200 shadow-sm rounded-lg">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-center border">ID</th>
                                    <th class="px-4 py-2 text-center border">User</th>
                                    <th class="px-4 py-2 text-center border">Buku</th>
                                    <th class="px-4 py-2 text-center border">Tanggal Pinjam</th>
                                    <th class="px-4 py-2 text-center border">Tanggal Kembali</th>
                                    <th class="px-4 py-2 text-center border">Status</th>
                                    <th class="px-4 py-2 text-center border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loans as $loan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-center border">{{ $loan->id }}</td>
                                        <td class="px-4 py-2 text-center border">{{ $loan->user->name ?? 'Guest' }}</td>
                                        <td class="px-4 py-2 text-center border">{{ $loan->book->title }}</td>
                                        <td class="px-4 py-2 text-center border">{{ $loan->loan_date }}</td>
                                        <td class="px-4 py-2 text-center border">{{ $loan->due_date }}</td>
                                        <td class="px-4 py-2 text-center border">
                                            <span class="px-2 py-1 text-xs rounded 
                                                {{ $loan->status === 'returned' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($loan->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-center border flex justify-center gap-2">
                                            <!-- Restore -->
                                            <form action="{{ route('loans.restore', $loan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                                         fill="none" 
                                                         viewBox="0 0 24 24" 
                                                         stroke-width="1.5" 
                                                         stroke="currentColor" 
                                                         class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                                              d="M16.023 9.348h4.992m0 0V4.356m0 4.992l-5.477-5.478A8.25 8.25 0 003.75 12c0 4.556 3.694 8.25 8.25 8.25a8.25 8.25 0 007.335-4.372" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Force Delete -->
                                            <form action="{{ route('loans.forceDelete', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus permanen peminjaman ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="p-1 bg-red-600 text-white rounded hover:bg-red-700 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                                         class="h-4 w-4" 
                                                         fill="none" 
                                                         viewBox="0 0 24 24" 
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0H7a2 2 0 00-2 2v2h14V5a2 2 0 00-2-2h-3z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                            Tidak ada peminjaman yang dihapus.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginasi -->
                    <div class="mt-4">
                        {{ $loans->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
