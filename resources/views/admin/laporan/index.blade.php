<x-admin-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Laporan Inventaris</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Laporan Stok Harian Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
                            <h2 class="text-xl font-semibold mb-4">Laporan Stok Harian</h2>
                            <p class="text-gray-600 mb-6">Laporan transaksi stok barang per hari</p>
                            
                            <form action="{{ route('admin.laporan.stok-harian') }}" method="GET" class="mb-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required value="{{ date('Y-m-d') }}">
                                </div>
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition">
                                    Lihat Laporan
                                </button>
                            </form>
                        </div>
                        
                        <!-- Laporan Stok Bulanan Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
                            <h2 class="text-xl font-semibold mb-4">Laporan Stok Bulanan</h2>
                            <p class="text-gray-600 mb-6">Laporan transaksi stok barang per bulan</p>
                            
                            <form action="{{ route('admin.laporan.stok-bulanan') }}" method="GET" class="mb-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bulan</label>
                                    <input type="month" name="bulan" id="bulan" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required value="{{ date('Y-m') }}">
                                </div>
                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition">
                                    Lihat Laporan
                                </button>
                            </form>
                        </div>
                        
                        <!-- Laporan Stok Barang Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition">
                            <h2 class="text-xl font-semibold mb-4">Laporan Stok Barang</h2>
                            <p class="text-gray-600 mb-6">Laporan stok barang saat ini dan barang dengan stok kritis</p>
                            
                            <a href="{{ route('admin.laporan.stok-barang') }}" class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-md text-center transition">
                                Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>