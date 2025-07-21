<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Detail Barang</h2>
                        <div>
                            <a href="{{ route('barang.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Kembali
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Kode Barang</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $barang->kode_barang }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Nama Barang</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $barang->nama_barang }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $barang->kategori->nama_kategori }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Stok Minimum</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $barang->stok_minimum }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Harga Beli</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <h3 class="text-sm font-medium text-gray-500">Harga Jual</h3>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Riwayat Transaksi Stok</h3>
                            @if($barang->stokTransaksis && $barang->stokTransaksis->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Tanggal
                                                </th>
                                                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Tipe
                                                </th>
                                                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Jumlah
                                                </th>
                                                <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Keterangan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($barang->stokTransaksis as $transaksi)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                    {{ $transaksi->tanggal->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $transaksi->tipe === 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ ucfirst($transaksi->tipe) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                                    {{ $transaksi->jumlah }}
                                                </td>
                                                <td class="px-6 py-4 border-b border-gray-200">
                                                    {{ $transaksi->keterangan }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500 italic">Belum ada transaksi stok untuk barang ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>