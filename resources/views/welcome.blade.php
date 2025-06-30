<x-layouts.app title="Welcome to Gearu">
    <!-- Screenshot-accurate Hero Section -->
    <div class="min-h-[70vh] flex items-center justify-center bg-white dark:bg-gray-900 px-4">
        <div class="w-full max-w-7xl mx-auto flex flex-col lg:flex-row items-center lg:items-start gap-12">
            <!-- Left Column -->
            <div class="flex-1 flex flex-col items-start justify-center max-w-xl w-full pt-8 lg:pt-24">
                <!-- Simple Circle Logo -->
                <div class="mb-8">
                    <span class="inline-block w-8 h-8 rounded-full bg-red-900"></span>
                </div>
                <!-- Badge and Version -->
                {{-- <div class="flex items-center gap-4 mb-6">
                    <span class="bg-red-900 text-red-900 text-sm font-semibold px-4 py-1 rounded-full">What's new</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Just shipped v0.1.0 &rarr;</span>
                </div> --}}
                <!-- Headline -->
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight" style="line-height:1.1">
                    SSP Exchange Rate<br />Analytics
                </h1>
                <!-- Subheadline -->
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-lg">
                    South Sudan pounds daily exchange rate tracker and analysis to show SSP currency inflation, including loss or gain for future prediction and investment with a real-time notification.
                </p>
                <!-- Buttons -->
                <div class="flex flex-row gap-4">
                    <a href="/admin" class="inline-flex items-center justify-center px-6 py-3 bg-red-900 text-white font-semibold rounded-lg text-base hover:bg-red-900 transition shadow">
                        Get Started
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white font-semibold rounded-lg text-base hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Browse Daily Exchange Rates
                    </a>
                </div>
            </div>
            <!-- Right Column: Full Image -->
            <div class="flex-1 flex items-center justify-center w-full max-w-xl h-full">
                <img src="/images/pound.webp" alt="Currency Exchange" class="w-full h-[400px] lg:h-[500px] object-fit rounded-2xl" />
            </div>
        </div>
    </div>

    <!-- Currency Matrix Table Livewire Component -->
    <div class="container mx-auto px-4 py-4">
        <livewire:currency-matrix-table />
    </div>
</x-layouts.app>
