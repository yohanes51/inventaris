<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HASA - Welcome</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                background-image: url('assets/bg1.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
            
            /* Custom shadow for better text visibility */
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }
            
            /* Backdrop blur for better readability */
            .backdrop-overlay {
                backdrop-filter: blur(2px);
                background: rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="flex flex-col items-center justify-center min-h-screen p-6 lg:p-8 transition-colors duration-300">

        <!-- Header / Navbar -->
        <header class="fixed top-4 right-4 z-50 w-auto text-sm not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-5 py-2 text-white bg-slate-700 hover:bg-slate-600 border border-slate-600 hover:border-slate-500 rounded-lg transition-all duration-200 shadow-lg"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2 text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600 rounded-lg transition-all duration-200 shadow-lg"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-5 py-2 text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600 rounded-lg transition-all duration-200 shadow-lg">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main class="flex flex-col items-center justify-center text-center gap-8 w-full max-w-4xl px-2">
            <!-- Background overlay for better text readability -->
            <div class="backdrop-overlay rounded-2xl p-8 lg:p-12 w-full">
                <!-- Icon or Illustration -->
                <div class="w-36 h-36 lg:w-48 lg:h-48 mx-auto mb-2">
                    <img src="https://picsum.photos/seed/warehouse/400/400" alt="Warehouse Illustration" class="w-full h-full object-contain rounded-lg">
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-0 text-shadow">
                    <span class="text-slate-800">Welcome to </span>
                    <span class="text-red-600">HASA</span>
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg lg:text-xl max-w-2xl text-slate-700 font-medium text-shadow">
                    Monitor your stock, quantity, and prices easily with HASA.
                </p>
            </div>
            
            <!-- Features Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-0 w-full">
                <div class="backdrop-overlay rounded-xl p-6 text-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Stock Monitoring</h3>
                    <p class="text-slate-700">Track your inventory levels in real-time</p>
                </div>
                
                <div class="backdrop-overlay rounded-xl p-6 text-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Quantity Control</h3>
                    <p class="text-slate-700">Manage quantities with precision</p>
                </div>
                
                <div class="backdrop-overlay rounded-xl p-6 text-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-2">Price Management</h3>
                    <p class="text-slate-700">Monitor and adjust prices easily</p>
                </div>
            </div>
        </main>
    </body>
</html>