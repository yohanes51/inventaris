<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Transaksi Stok') }}
            </h2>
            <a href="{{ route('stok-transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold">
                                    {{ $stokTransaksi->tipe == 'masuk' ? 'Stok Masuk' : 'Stok Keluar' }}
                                </h1>
                                <p class="text-gray-600">
                                    ID Transaksi: #{{ $stokTransaksi->id }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="{{ $stokTransaksi->tipe == 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-sm font-medium px-3 py-1 rounded-full">
                                    {{ $stokTransaksi->tipe == 'masuk' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Tanggal Transaksi</p>
                                <p class="font-medium">{{ date('d F Y', strtotime($stokTransaksi->tanggal_transaksi)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Barang</p>
                                <p class="font-medium">{{ $stokTransaksi->barang->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Jumlah</p>
                                <p class="font-medium">{{ number_format($stokTransaksi->jumlah) }} unit</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Harga per Unit</p>
                                <p class="font-medium">Rp {{ number_format($stokTransaksi->harga) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Harga</p>
                                <p class="font-bold">Rp {{ number_format($stokTransaksi->total) }}</p>
                            </div>
                        </div>
                    </div>

                    @if($stokTransaksi->keterangan)
                        <div class="border-t border-gray-200 py-4">
                            <p class="text-sm text-gray-600 mb-1">Keterangan</p>
                            <p>{{ $stokTransaksi->keterangan }}</p>
                        </div>
                    @endif

                    <div class="border-t border-gray-200 py-4">
                        <p class="text-sm text-gray-600 mb-1">Info Barang</p>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Nama Barang</p>
                                    <p class="font-medium">{{ $stokTransaksi->barang->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Kode Barang</p>
                                    <p class="font-medium">{{ $stokTransaksi->barang->kode ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Kategori</p>
                                    <p class="font-medium">{{ $stokTransaksi->barang->kategori->nama ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Stok Saat Ini</p>
                                    <p class="font-medium">{{ number_format($stokTransaksi->barang->stok_sekarang) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('stok-transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>