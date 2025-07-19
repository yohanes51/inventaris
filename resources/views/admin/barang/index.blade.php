<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Barang') }}
            </h2>
            <a href="{{ route('admin.barang.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Barang
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left">No</th>
                                    <th class="py-3 px-4 text-left">Kode</th>
                                    <th class="py-3 px-4 text-left">Nama Barang</th>
                                    <th class="py-3 px-4 text-left">Kategori</th>
                                    <th class="py-3 px-4 text-right">Stok</th>
                                    <th class="py-3 px-4 text-right">Stok Min</th>
                                    <th class="py-3 px-4 text-right">Harga Beli</th>
                                    <th class="py-3 px-4 text-right">Harga Jual</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $index => $barang)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $barang->kode_barang }}</td>
                                        <td class="py-3 px-4">{{ $barang->nama_barang }}</td>
                                        <td class="py-3 px-4">{{ $barang->kategori->nama_kategori }}</td>
                                        <td class="py-3 px-4 text-right">
                                            <span class="{{ $barang->stok_sekarang <= $barang->stok_minimum ? 'text-red-600 font-bold' : '' }}">
                                                {{ number_format($barang->stok_sekarang) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right">{{ number_format($barang->stok_minimum) }}</td>
                                        <td class="py-3 px-4 text-right">Rp {{ number_format($barang->harga_beli) }}</td>
                                        <td class="py-3 px-4 text-right">Rp {{ number_format($barang->harga_jual) }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="flex justify-center">
                                                <a href="{{ route('admin.barang.show', $barang->id) }}" class="text-blue-600 hover:text-blue-900 mx-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.barang.edit', $barang->id) }}" class="text-yellow-600 hover:text-yellow-900 mx-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form class="inline-block mx-1" action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-6 px-4 text-center text-gray-500">Tidak ada data barang</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>