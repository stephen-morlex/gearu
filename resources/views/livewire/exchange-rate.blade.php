<div class="flex flex-col md:flex-row gap-4">
    <!-- Left Column: Chart (60%) -->
    <div class="flex-1 basis-3/5 min-w-0 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Daily Exchange Rate Chart (vs SSP)</h2>
        <canvas id="exchangeRateChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('exchangeRateChart').getContext('2d');
                const chartData = @json($chartData);
                const currencies = @json($currencies->pluck('code'));
                const labels = Object.values(chartData)[0] ? Object.values(chartData)[0].map(r => r.date) : [];
                const datasets = [];
                currencies.forEach(code => {
                    if (chartData[code]) {
                        datasets.push({
                            label: code + ' Buying',
                            data: Object.values(chartData[code]).map(r => r.buying_rate),
                            borderColor: 'rgba(54,162,235,1)',
                            backgroundColor: 'rgba(54,162,235,0.1)',
                            tension: 0.3,
                        });
                        datasets.push({
                            label: code + ' Selling',
                            data: Object.values(chartData[code]).map(r => r.selling_rate),
                            borderColor: 'rgba(255,99,132,1)',
                            backgroundColor: 'rgba(255,99,132,0.1)',
                            borderDash: [5,5],
                            tension: 0.3,
                        });
                    }
                });
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets,
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' },
                            title: { display: false },
                        },
                        scales: {
                            y: { beginAtZero: false, title: { display: true, text: 'Rate' } },
                            x: { title: { display: true, text: 'Date' } }
                        }
                    }
                });
            });
        </script>
    </div>
    <!-- Right Column: Table (40%) -->
    <div class="flex-1 basis-2/5 min-w-0 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Today's Exchange Rates (vs SSP)</h2>
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="text-left font-semibold px-4 py-2">Currency</th>
                    <th class="text-left font-semibold px-4 py-2">Buying Rate</th>
                    <th class="text-left font-semibold px-4 py-2">Selling Rate</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($tableData as $row)
                    <tr>
                        <td class="px-4 py-2 flex items-center gap-2">
                            @if(!empty($row['currency']->emoji))<span>{{ $row['currency']->emoji }}</span>@endif
                            <span>{{ $row['currency']->code }}</span>
                        </td>
                        <td class="px-4 py-2">{{ $row['buying_rate'] }}</td>
                        <td class="px-4 py-2">{{ $row['selling_rate'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

