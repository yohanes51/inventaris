<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Laporan Stok Bulanan</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.laporan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition">
                                Kembali
                            </a>
                            <button onclick="window.print()" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition">
                                Cetak
                            </button>
                        </div>
                    </div>
    
                    <!-- Form Filter -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg print:hidden">
                        <form action="{{ route('admin.laporan.stok-bulanan') }}" method="GET" class="flex items-end space-x-4">
                            <div class="flex-1">
                                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                                <input type="month" name="bulan" id="bulan" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ $bulan }}" required>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>
    
                    <!-- Print Header (Only visible when printing) -->
                    <div class="hidden print:block mb-6">
                        <h2 class="text-xl font-bold text-center">Laporan Stok Bulanan</h2>
                        <p class="text-center">Bulan: {{ date('F Y', strtotime($bulan.'-01')) }}</p>
                    </div>
    
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="text-lg font-medium text-blue-800">Total Barang Masuk</h3>
                            <p class="text-2xl font-bold">Rp {{ number_format($summary['total_masuk'], 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                            <h3 class="text-lg font-medium text-red-800">Total Barang Keluar</h3>
                            <p class="text-2xl font-bold">Rp {{ number_format($summary['total_keluar'], 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h3 class="text-lg font-medium text-gray-800">Jumlah Hari Dengan Transaksi</h3>
                            <p class="text-2xl font-bold">{{ $summary['jumlah_hari'] }}</p>
                        </div>
                    </div>
    
                    <!-- Data Table -->
                    @if($transaksis->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-3 px-4 border-b text-left">No</th>
                                    <th class="py-3 px-4 border-b text-left">Tanggal</th>
                                    <th class="py-3 px-4 border-b text-left">Jumlah Barang Masuk</th>
                                    <th class="py-3 px-4 border-b text-left">Nilai Barang Masuk</th>
                                    <th class="py-3 px-4 border-b text-left">Jumlah Barang Keluar</th>
                                    <th class="py-3 px-4 border-b text-left">Nilai Barang Keluar</th>
                                    <th class="py-3 px-4 border-b text-left">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksis as $index => $transaksi)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 border-b">{{ date('d F Y', strtotime($transaksi->tanggal)) }}</td>
                                    <td class="py-2 px-4 border-b">{{ $transaksi->total_masuk }}</td>
                                    <td class="py-2 px-4 border-b">Rp {{ number_format($transaksi->nilai_masuk, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-b">{{ $transaksi->total_keluar }}</td>
                                    <td class="py-2 px-4 border-b">Rp {{ number_format($transaksi->nilai_keluar, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-b print:hidden">
                                        <a href="{{ route('admin.laporan.stok-harian', ['tanggal' => $transaksi->tanggal]) }}" class="text-blue-500 hover:text-blue-700">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 font-semibold">
                                <tr>
                                    <td class="py-2 px-4 border-b" colspan="2">Total</td>
                                    <td class="py-2 px-4 border-b">{{ $transaksis->sum('total_masuk') }}</td>
                                    <td class="py-2 px-4 border-b">Rp {{ number_format($transaksis->sum('nilai_masuk'), 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-b">{{ $transaksis->sum('total_keluar') }}</td>
                                    <td class="py-2 px-4 border-b">Rp {{ number_format($transaksis->sum('nilai_keluar'), 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-b"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Tidak ada data transaksi pada bulan ini.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print\:block {
            display: block !important;
        }
        .print\:hidden {
            display: none !important;
        }
        #app, #app * {
            visibility: visible;
        }
        .shadow-sm, .shadow-md, .shadow-lg, .shadow {
            box-shadow: none !important;
        }
        .max-w-7xl {
            max-width: 100% !important;
        }
        .sm\:px-6, .lg\:px-8, .px-4, .py-2, .p-6, .p-4 {
            padding: 8px !important;
        }
        .border-gray-200 {
            border-color: #ccc !important;
        }
        table {
            width: 100% !important;
            font-size: 12px !important;
        }
    }
    </style>
</x-admin-app-layout>