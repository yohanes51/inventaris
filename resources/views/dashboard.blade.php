<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Table Barang --}}
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Barang</h3>
                    <div class="overflow-x-auto rounded-md">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700 text-left">
                                <tr>
                                    <th class="py-3 px-4">No</th>
                                    <th class="py-3 px-4">Nama Barang</th>
                                    <th class="py-3 px-4">Kategori</th>
                                    <th class="py-3 px-4 text-right">Stok</th>
                                    <th class="py-3 px-4 text-right">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($barangs as $index => $barang)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $barang->nama_barang }}</td>
                                        <td class="py-3 px-4">{{ $barang->kategori->nama_kategori }}</td>
                                        <td class="py-3 px-4 text-right">
                                            <span class="{{ $barang->stok_sekarang <= $barang->stok_minimum ? 'text-red-600 font-bold' : 'text-gray-800' }}">
                                                {{ number_format($barang->stok_sekarang) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">Rp {{ number_format($barang->harga_jual) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada data barang</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Transaksi Terbaru + Checkout Button --}}
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
                        <h3 class="text-xl font-semibold text-gray-800">Transaksi Terbaru</h3>
                        <a href="{{ route('stok-transaksi.create', ['tipe' => 'keluar']) }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold text-sm rounded-lg shadow hover:from-red-700 hover:to-red-800 transition">
                            <img src="{{ asset('assets/logo1.png') }}" alt="Logo" class="h-10">
                            Checkout Barang
                        </a>
                    </div>
                    <div class="overflow-x-auto rounded-md">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="py-2 px-4">Tanggal</th>
                                    <th class="py-2 px-4">Barang</th>
                                    <th class="py-2 px-4 text-center">Tipe</th>
                                    <th class="py-2 px-4 text-right">Jumlah</th>
                                    <th class="py-2 px-4 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse (
                                    \App\Models\StokTransaksi::with('barang')
                                        ->where('tipe', 'keluar')
                                        ->where('creator_id', auth()->id())
                                        ->where('creator_type', \App\Models\User::class)
                                        ->latest()
                                        ->limit(5)
                                        ->get() as $transaksi
                                )                                
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-2 px-4">{{ date('d/m/Y', strtotime($transaksi->tanggal_transaksi)) }}</td>
                                        <td class="py-2 px-4">{{ $transaksi->barang->nama_barang }}</td>
                                        <td class="py-2 px-4 text-center">
                                            <span class="inline-block px-2 py-1 rounded text-xs font-medium text-white {{ $transaksi->tipe == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ ucfirst($transaksi->tipe) }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 text-right">{{ $transaksi->jumlah }}</td>
                                        <td class="py-2 px-4 text-right">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-6 px-4 text-center text-gray-500">Belum ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- "Lihat Semua" moved to bottom left --}}
                    <div class="mt-4">
                        <a href="{{ route('stok-transaksi.index') }}"
                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            ← Lihat Semua Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
