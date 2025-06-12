<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Laporan Stok Barang</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('laporan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition">
                                Kembali
                            </a>
                            <button onclick="window.print()" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition">
                                Cetak
                            </button>
                        </div>
                    </div>
    
                    <!-- Print Header (Only visible when printing) -->
                    <div class="hidden print:block mb-6">
                        <h2 class="text-xl font-bold text-center">Laporan Stok Barang</h2>
                        <p class="text-center">Tanggal: {{ date('d F Y') }}</p>
                    </div>
    
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h3 class="text-lg font-medium text-blue-800">Total Jenis Barang</h3>
                            <p class="text-2xl font-bold">{{ $barangs->count() }}</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                            <h3 class="text-lg font-medium text-red-800">Barang Stok Kritis</h3>
                            <p class="text-2xl font-bold">{{ $stokKritis->count() }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h3 class="text-lg font-medium text-gray-800">Total Nilai Persediaan</h3>
                            <p class="text-2xl font-bold">Rp {{ number_format($barangs->sum(function($item) { return $item->stok_sekarang * $item->harga; }), 0, ',', '.') }}</p>
                        </div>
                    </div>
    
                    <!-- Tab Navigation -->
                    <div class="mb-6 border-b border-gray-200 print:hidden">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="tabs">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-blue-500 rounded-t-lg active" id="semua-tab" onclick="changeTab('semua')" type="button">
                                    Semua Barang
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:border-gray-300" id="kritis-tab" onclick="changeTab('kritis')" type="button">
                                    Stok Kritis
                                </button>
                            </li>
                        </ul>
                    </div>
    
                    <!-- Data Table for All Items -->
                    <div id="semua-content" class="tab-content">
                        @if($barangs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-3 px-4 border-b text-left">No</th>
                                        <th class="py-3 px-4 border-b text-left">Kode Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Nama Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Kategori</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Minimum</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Sekarang</th>
                                        <th class="py-3 px-4 border-b text-left">Harga</th>
                                        <th class="py-3 px-4 border-b text-left">Nilai Total</th>
                                        <th class="py-3 px-4 border-b text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $index => $barang)
                                    <tr class="{{ $barang->stok_sekarang <= $barang->stok_minimum ? 'bg-red-50' : '' }}">
                                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kode_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kategori->nama_kategori }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->stok_minimum }}</td>
                                        <td class="py-2 px-4 border-b font-medium {{ $barang->stok_sekarang <= $barang->stok_minimum ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $barang->stok_sekarang }}
                                        </td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($barang->stok_sekarang * $barang->harga, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            @if($barang->stok_sekarang <= $barang->stok_minimum)
                                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                    Stok Kritis
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                    Stok Aman
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Tidak ada data barang.</p>
                        </div>
                        @endif
                    </div>
    
                    <!-- Data Table for Critical Stock Items -->
                    <div id="kritis-content" class="tab-content hidden">
                        @if($stokKritis->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-3 px-4 border-b text-left">No</th>
                                        <th class="py-3 px-4 border-b text-left">Kode Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Nama Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Kategori</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Minimum</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Sekarang</th>
                                        <th class="py-3 px-4 border-b text-left">Selisih</th>
                                        <th class="py-3 px-4 border-b text-left">Harga</th>
                                        <th class="py-3 px-4 border-b text-left">Nilai Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stokKritis as $index => $barang)
                                    <tr class="bg-red-50">
                                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kode_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kategori->nama_kategori }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->stok_minimum }}</td>
                                        <td class="py-2 px-4 border-b font-medium text-red-600">
                                            {{ $barang->stok_sekarang }}
                                        </td>
                                        <td class="py-2 px-4 border-b font-medium text-red-600">
                                            {{ $barang->stok_minimum - $barang->stok_sekarang }}
                                        </td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($barang->stok_sekarang * $barang->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Tidak ada barang dengan stok kritis.</p>
                        </div>
                        @endif
                    </div>
    
                    <!-- Print-only version showing both tables -->
                    <div class="hidden print:block mt-8">
                        <h3 class="text-lg font-bold mb-4">Daftar Barang dengan Stok Kritis</h3>
                        @if($stokKritis->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-3 px-4 border-b text-left">No</th>
                                        <th class="py-3 px-4 border-b text-left">Kode Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Nama Barang</th>
                                        <th class="py-3 px-4 border-b text-left">Kategori</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Minimum</th>
                                        <th class="py-3 px-4 border-b text-left">Stok Sekarang</th>
                                        <th class="py-3 px-4 border-b text-left">Selisih</th>
                                        <th class="py-3 px-4 border-b text-left">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stokKritis as $index => $barang)
                                    <tr class="bg-red-50">
                                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kode_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->kategori->nama_kategori }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->stok_minimum }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->stok_sekarang }}</td>
                                        <td class="py-2 px-4 border-b">{{ $barang->stok_minimum - $barang->stok_sekarang }}</td>
                                        <td class="py-2 px-4 border-b">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <p class="text-gray-500">Tidak ada barang dengan stok kritis.</p>
                        </div>
                        @endif
                    </div>
    
                    <!-- Print footer -->
                    <div class="hidden print:block mt-8">
                        <div class="text-right">
                            <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
                        </div>
                    </div>
    
                    <!-- JavaScript for Tab Navigation -->
                    <script>
                        function changeTab(tabId) {
                            // Hide all tab contents
                            document.querySelectorAll('.tab-content').forEach(content => {
                                content.classList.add('hidden');
                            });
    
                            // Remove active class from all tabs
                            document.querySelectorAll('#tabs button').forEach(tab => {
                                tab.classList.remove('active', 'border-blue-500');
                                tab.classList.add('border-transparent');
                            });
    
                            // Show selected tab content
                            document.getElementById(tabId + '-content').classList.remove('hidden');
    
                            // Add active class to selected tab
                            document.getElementById(tabId + '-tab').classList.add('active', 'border-blue-500');
                            document.getElementById(tabId + '-tab').classList.remove('border-transparent');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>