<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Buat Peminjaman Baru</h1>

                    <!-- Error -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('loans.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Nama Peminjam -->
                        <div>
                            <label for="user_id" class="block font-semibold mb-1">Nama Peminjam</label>
                            <select name="user_id" id="user_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                    required>
                                <option value="">Pilih Peminjam</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Buku yang Dipinjam -->
                        <div>
                            <label for="book_id" class="block font-semibold mb-1">Buku yang Dipinjam</label>
                            <select name="book_id" id="book_id"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                    required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Peminjaman -->
                        <div>
                            <label for="loan_date" class="block font-semibold mb-1">Tanggal Peminjaman</label>
                            <input type="date" name="loan_date" id="loan_date"
                                   value="{{ old('loan_date') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   required>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div>
                            <label for="due_date" class="block font-semibold mb-1">Tanggal Pengembalian</label>
                            <input type="date" name="due_date" id="due_date"
                                   value="{{ old('due_date') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                   required>
                        </div>

                        <!-- Status Peminjaman -->
                        <div>
                            <label for="status" class="block font-semibold mb-1">Status Peminjaman</label>
                            <select name="status" id="status"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                    required>
                                <option value="Dipinjam" {{ old('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ old('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="Terlambat" {{ old('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ auth()->user()->hasRole('admin') ? route('loans.index') : route('user.loans') }}"
                               class="px-5 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Simpan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
