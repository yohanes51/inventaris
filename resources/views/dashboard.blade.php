<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <!-- Menu Cepat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Menu Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        
                        
                        <a href="{{ route('stok-transaksi.create', ['tipe' => 'keluar']) }}" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white p-6 rounded-lg text-center shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                            </svg>
                            <div class="font-semibold">Checkout</div>
                        </a>
                    </div>
                </div>
            </div>
</x-app-layout>