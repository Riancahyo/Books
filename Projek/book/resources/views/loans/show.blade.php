<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Detail Peminjaman</h1>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-5">
                        <!-- ID Peminjaman -->
                        <div>
                            <label class="block font-semibold mb-1">ID Peminjaman</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->id }}
                            </p>
                        </div>

                        <!-- Nama Peminjam -->
                        <div>
                            <label class="block font-semibold mb-1">Nama Peminjam</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->user->name }}
                            </p>
                        </div>

                        <!-- Buku yang Dipinjam -->
                        <div>
                            <label class="block font-semibold mb-1">Buku</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->book->title }}
                            </p>
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div>
                            <label class="block font-semibold mb-1">Tanggal Pinjam</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}
                            </p>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div>
                            <label class="block font-semibold mb-1">Tanggal Kembali</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y') : 'Belum Kembali' }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-semibold mb-1">Status</label>
                            <p class="w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->status }}
                            </p>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end gap-3 mt-6">
                            <a href="{{ route('loans.edit', $loan->id) }}" 
                               class="px-5 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <a href="{{ route('loans.index') }}" 
                               class="px-5 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                                Kembali
                            </a>

                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')"
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
