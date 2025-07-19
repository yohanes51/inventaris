<x--app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Stok Keluar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('stok-transaksi.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="barang_id" class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                            <select name="barang_id" id="barang_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}"
                                        data-harga-jual="{{ $barang->harga_jual }}"
                                        data-stok="{{ $barang->stok_sekarang }}"
                                        {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="p-3 bg-yellow-50 text-yellow-800 border border-yellow-300 rounded-md">
                                <p class="text-sm font-medium">Stok tersedia: <span id="stok-tersedia">0</span></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('jumlah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga per Unit (Rp)</label>
                            <div id="harga-display" class="mt-1 py-2 px-3 bg-gray-100 rounded-md font-medium">0</div>
                            <input type="hidden" id="harga" name="harga" value="{{ old('harga') }}">
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Total Harga (Rp)</label>
                            <div id="total-harga" class="mt-1 py-2 px-3 bg-gray-100 rounded-md font-medium">0</div>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('tanggal_transaksi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
                            <textarea id="keterangan" name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('stok-transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali
                            </a>
                            <button type="submit" id="submit-btn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Checkout
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const barangSelect = document.getElementById('barang_id');
            const jumlahInput = document.getElementById('jumlah');
            const hargaInput = document.getElementById('harga');
            const totalHarga = document.getElementById('total-harga');

            function updateStokTersedia() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                const stokDisplay = document.getElementById('stok-tersedia');

                if (selectedOption && selectedOption.value) {
                    const stokSekarang = selectedOption.getAttribute('data-stok');
                    stokDisplay.textContent = stokSekarang;
                } else {
                    stokDisplay.textContent = '0';
                }
            }

            function updateHargaOtomatis() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                if (!selectedOption) return;

                const hargaJual = parseFloat(selectedOption.getAttribute('data-harga-jual')) || 0;

                document.getElementById('harga-display').textContent = new Intl.NumberFormat('id-ID').format(hargaJual);
                hargaInput.value = hargaJual;

                updateTotalHarga();
            }

            function updateTotalHarga() {
                const jumlah = parseInt(jumlahInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const total = jumlah * harga;

                totalHarga.textContent = new Intl.NumberFormat('id-ID').format(total);
            }

            function validateStokKeluar() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    const stokSekarang = parseInt(selectedOption.getAttribute('data-stok')) || 0;
                    const jumlah = parseInt(jumlahInput.value) || 0;

                    if (jumlah > stokSekarang) {
                        alert('Jumlah melebihi stok yang tersedia!');
                        return false;
                    }
                }
                return true;
            }

            barangSelect.addEventListener('change', function () {
                updateStokTersedia();
                updateHargaOtomatis();
            });
            jumlahInput.addEventListener('input', updateTotalHarga);

            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                if (!validateStokKeluar()) {
                    event.preventDefault();
                }
            });

            updateStokTersedia();
            updateHargaOtomatis();
            updateTotalHarga();
        });
    </script>
</x-app-layout>
