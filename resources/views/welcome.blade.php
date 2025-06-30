<x-layouts.app title="Welcome to Gearu">
    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-7xl mx-auto">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-10 gap-8">
                    <!-- Left Column (30%) - Header and Cards -->
                    <div class="lg:col-span-3 flex items-center justify-center">
                        <div class="max-w-sm w-full">
                            <!-- Header Section -->
                            <div class="text-center mb-6">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mb-3">
                                    Welcome to Gearu
                                </h1>
                                <p class="text-base lg:text-lg text-gray-600 dark:text-gray-400">
                                    Exchange Rate Management System
                                </p>
                            </div>

                            <!-- Feature Cards -->
                            <div class="space-y-3">
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-2">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Currency Management</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Manage currencies and their exchange rates with ease.</p>
                                </div>

                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-3">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-2">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Real-time Rates</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Get up-to-date exchange rates and historical data.</p>
                                </div>

                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-3">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-2">
                                        <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">User Management</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Manage users and their permissions efficiently.</p>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="text-center mt-4">
                                <a href="/admin" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 text-xs">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Access Admin Panel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (70%) - Full Image -->
                    <div class="lg:col-span-7">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 h-full overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                 alt="Currency Exchange"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
