<x-admin-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left">No</th>
                                    <th class="py-3 px-4 text-left">Kode</th>
                                    <th class="py-3 px-4 text-left">Nama Barang</th>
                                    <th class="py-3 px-4 text-left">Kategori</th>
                                    <th class="py-3 px-4 text-right">Stok</th>
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