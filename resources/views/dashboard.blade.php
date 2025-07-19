<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-blue-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0v10a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2h4l10 5c.6.3 1 .9 1 1.5zm-8 4l-8-4m16 0l-8 4m8-4v10a2 2 0 01-2 2h-3" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500">Total Kategori</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Kategori::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-green-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500">Total Barang</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Barang::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-yellow-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500">Transaksi Hari Ini</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\StokTransaksi::whereDate('tanggal_transaksi', date('Y-m-d'))->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-red-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-500 text-white mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-1 text-sm font-medium text-gray-500">Stok Kritis</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Barang::whereRaw('stok_sekarang <= stok_minimum')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barang dengan Stok Kritis -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Barang dengan Stok Kritis</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">Kode</th>
                                    <th class="py-2 px-4 border-b text-left">Nama Barang</th>
                                    <th class="py-2 px-4 border-b text-left">Kategori</th>
                                    <th class="py-2 px-4 border-b text-center">Stok Minimum</th>
                                    <th class="py-2 px-4 border-b text-center">Stok Sekarang</th>
                                    <th class="py-2 px-4 border-b text-center">Status</th>
                                    <th class="py-2 px-4 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stokKritis = \App\Models\Barang::with('kategori')
                                        ->whereRaw('stok_sekarang <= stok_minimum')
                                        ->limit(5)
                                        ->get();
                                @endphp

                                @forelse($stokKritis as $barang)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $barang->kode_barang }}</td>
                                    <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                                    <td class="py-2 px-4 border-b">{{ $barang->kategori->nama_kategori }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $barang->stok_minimum }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $barang->stok_sekarang }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        @if($barang->stok_sekarang == 0)
                                            <span class="px-2 py-1 bg-red-500 text-white text-xs rounded-full">Habis</span>
                                        @else
                                            <span class="px-2 py-1 bg-yellow-500 text-white text-xs rounded-full">Kritis</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <a href="{{ route('stok-transaksi.create') }}?barang_id={{ $barang->id }}&tipe=masuk" class="inline-flex bg-blue-500 hover:bg-blue-700 text-white text-xs py-1 px-2 rounded">
                                            Tambah Stok
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-6 px-4 border-b text-center text-gray-500" colspan="7">Tidak ada barang dengan stok kritis</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($stokKritis) > 0)
                        <div class="mt-4">
                            <a href="{{ route('admin.laporan.stok-barang') }}" class="text-blue-500 hover:text-blue-700">
                                Lihat semua stok kritis →
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Menu Cepat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Menu Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.stok-transaksi.create', ['tipe' => 'masuk']) }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white p-6 rounded-lg text-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                            <div class="font-semibold">Stok Masuk</div>
                        </a>
                        
                        <a href="{{ route('admin.stok-transaksi.create', ['tipe' => 'keluar']) }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white p-6 rounded-lg text-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                            </svg>
                            <div class="font-semibold">Stok Keluar</div>
                        </a>
                        
                        <a href="{{ route('admin.barang.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-6 rounded-lg text-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <div class="font-semibold">Tambah Barang</div>
                        </a>
                        
                        <a href="{{ route('admin.laporan.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-6 rounded-lg text-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div class="font-semibold">Laporan</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru dan Ringkasan -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Transaksi Terbaru -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Transaksi Terbaru</h3>
                                <a href="{{ route('admin.stok-transaksi.index') }}" class="text-blue-500 hover:text-blue-700 text-sm">
                                    Lihat Semua
                                </a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 border-b text-left">Tanggal</th>
                                            <th class="py-2 px-4 border-b text-left">Barang</th>
                                            <th class="py-2 px-4 border-b text-center">Tipe</th>
                                            <th class="py-2 px-4 border-b text-right">Jumlah</th>
                                            <th class="py-2 px-4 border-b text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(\App\Models\StokTransaksi::with('barang')->latest()->limit(5)->get() as $transaksi)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ date('d/m/Y', strtotime($transaksi->tanggal_transaksi)) }}</td>
                                            <td class="py-2 px-4 border-b">{{ $transaksi->barang->nama_barang }}</td>
                                            <td class="py-2 px-4 border-b text-center">
                                                <span class="px-2 py-1 rounded text-xs text-white {{ $transaksi->tipe == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ ucfirst($transaksi->tipe) }}
                                                </span>
                                            </td>
                                            <td class="py-2 px-4 border-b text-right">{{ $transaksi->jumlah }}</td>
                                            <td class="py-2 px-4 border-b text-right">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="py-6 px-4 border-b text-center text-gray-500" colspan="5">Belum ada transaksi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Kategori -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Kategori</h3>
                            
                            @php
                                $kategoris = \App\Models\Kategori::withCount('barangs')->get();
                                $totalBarang = \App\Models\Barang::count();
                                $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-red-500', 'bg-indigo-500', 'bg-pink-500'];
                            @endphp
                            
                            @forelse($kategoris as $index => $kategori)
                                @php
                                    $percentage = $totalBarang > 0 ? round(($kategori->barangs_count / $totalBarang) * 100) : 0;
                                    $color = $colors[$index % count($colors)];
                                @endphp
                                <div class="mb-4">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $kategori->nama_kategori }}</span>
                                        <span class="text-sm font-medium text-gray-700">{{ $kategori->barangs_count }} barang</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="{{ $color }} h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-center text-gray-500">Belum ada kategori</div>
                            @endforelse
                            
                            <div class="mt-4">
                                <a href="{{ route('admin.kategori.index') }}" class="text-blue-500 hover:text-blue-700">
                                    Kelola kategori →
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistik Hari Ini -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik Hari Ini</h3>
                            
                            @php
                                $hariIni = \App\Models\StokTransaksi::whereDate('tanggal_transaksi', date('Y-m-d'))->get();
                                $totalMasuk = $hariIni->where('tipe', 'masuk')->sum('total');
                                $totalKeluar = $hariIni->where('tipe', 'keluar')->sum('total');
                                $jumlahMasuk = $hariIni->where('tipe', 'masuk')->sum('jumlah');
                                $jumlahKeluar = $hariIni->where('tipe', 'keluar')->sum('jumlah');
                            @endphp
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-green-50 p-4 rounded">
                                    <p class="text-sm text-gray-500 mb-1">Barang Masuk</p>
                                    <p class="font-semibold">{{ $jumlahMasuk }} item</p>
                                    <p class="text-green-600 text-sm mt-1">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="bg-red-50 p-4 rounded">
                                    <p class="text-sm text-gray-500 mb-1">Barang Keluar</p>
                                    <p class="font-semibold">{{ $jumlahKeluar }} item</p>
                                    <p class="text-red-600 text-sm mt-1">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('admin.laporan.stok-harian') }}?tanggal={{ date('Y-m-d') }}" class="text-blue-500 hover:text-blue-700">
                                    Laporan hari ini →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>