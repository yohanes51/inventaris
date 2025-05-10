<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('kategori.index') }}" class="text-blue-500 hover:text-blue-700">
                            &larr; Kembali ke Daftar Kategori
                        </a>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-1">Nama Kategori</h3>
                            <p>{{ $kategori->nama_kategori }}</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-1">Deskripsi</h3>
                            <p>{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-1">Dibuat Pada</h3>
                            <p>{{ $kategori->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-1">Terakhir Diperbarui</h3>
                            <p>{{ $kategori->updated_at->format('d M Y, H:i') }}</p>
                        </div>

                        @if($kategori->barangs->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-3">Daftar Barang dalam Kategori Ini</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="py-2 px-4 border-b">No</th>
                                            <th class="py-2 px-4 border-b">Nama Barang</th>
                                            <th class="py-2 px-4 border-b">Stok</th>
                                            <th class="py-2 px-4 border-b">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategori->barangs as $index => $barang)
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                            <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                                            <td class="py-2 px-4 border-b">{{ $barang->stok }}</td>
                                            <td class="py-2 px-4 border-b">
                                                <a href="{{ route('barang.show', $barang->id) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @else
                        <div class="mt-8 p-4 bg-gray-100 rounded">
                            <p>Tidak ada barang dalam kategori ini.</p>
                        </div>
                        @endif

                        <div class="mt-8 flex space-x-3">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Edit Kategori</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Hapus Kategori</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>