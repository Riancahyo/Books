<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center text-2xl font-bold mb-6">Edit Peminjaman Buku</h1>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- User ID -->
                        <div>
                            <label for="user_id" class="block font-semibold mb-1">User ID</label>
                            <input type="number" name="user_id" id="user_id" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('user_id', $loan->user_id) }}" required>
                        </div>

                        <!-- Book ID -->
                        <div>
                            <label for="book_id" class="block font-semibold mb-1">Buku</label>
                            <input type="number" name="book_id" id="book_id" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('book_id', $loan->book_id) }}" required>
                        </div>

                        <!-- Loan Date -->
                        <div>
                            <label for="loan_date" class="block font-semibold mb-1">Tanggal Pinjam</label>
                            <input type="date" name="loan_date" id="loan_date" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('loan_date', $loan->loan_date instanceof \DateTime ? $loan->loan_date->format('Y-m-d') : $loan->loan_date) }}" 
                                   required>
                        </div>

                        <!-- Due Date -->
                        <div>
                            <label for="due_date" class="block font-semibold mb-1">Tenggat Waktu</label>
                            <input type="date" name="due_date" id="due_date" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                                   value="{{ old('due_date', $loan->due_date instanceof \DateTime ? $loan->due_date->format('Y-m-d') : $loan->due_date) }}" 
                                   required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-semibold mb-1">Status</label>
                            <select name="status" id="status" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                                <option value="Dipinjam" {{ old('status', $loan->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ old('status', $loan->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="Terlambat" {{ old('status', $loan->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('loans.index') }}" 
                               class="px-5 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                                Perbarui Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
