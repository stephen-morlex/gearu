<div class="max-w-full mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
    <h2 class="text-2xl font-bold mb-1 text-gray-800 dark:text-gray-100">SSP Exchange Rate Matrix (7-Day Trend)</h2>
    <p class="mb-4 text-gray-600 dark:text-gray-300 text-sm">This table displays a 7-day trend of buying and selling exchange rates of SSP against all available currencies. Each cell shows the daily direction (up, down, or same) for both buying and selling rates. Hover over each indicator for the exact date and rate values.</p>
    <div class="mb-4 flex gap-2">
        <button wire:click="toggleType('both')" class="px-3 py-1 rounded text-sm font-semibold border focus:outline-none {{ $showType === 'both' ? 'bg-red-900 text-white' : 'bg-white border-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}">Both</button>
        <button wire:click="toggleType('buying')" class="px-3 py-1 rounded text-sm font-semibold border focus:outline-none {{ $showType === 'buying' ? 'bg-red-900 text-white' : 'bg-white border-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}">Buying</button>
        <button wire:click="toggleType('selling')" class="px-3 py-1 rounded text-sm font-semibold border focus:outline-none {{ $showType === 'selling' ? 'bg-red-900 text-white' : 'bg-white border-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}">Selling</button>
    </div>
    <table class="min-w-full text-sm">
        <thead>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th class="text-left font-semibold text-gray-700 dark:text-gray-200 px-4 py-2"> </th>
                @foreach($currencies as $currency)
                    <th class="text-left font-semibold text-gray-700 dark:text-gray-200 px-4 py-2">
                        <span class="mr-1">{{ $currency->emoji }}</span> {{ $currency->code }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($currencies as $from)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                    <td class="px-4 py-3 font-medium text-gray-700 dark:text-gray-200">SSP</td>
                    @foreach($currencies as $to)
                        @php
                            $history = $matrix[$from->id][$to->id] ?? [];
                        @endphp
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-1">
                              @foreach($history as $day)
                                    @php
                                        $show = $showType;
                                        $dir = $show === 'buying' ? $day['buying_direction'] : ($show === 'selling' ? $day['selling_direction'] : null);
                                        $val = $show === 'buying' ? $day['buying'] : ($show === 'selling' ? $day['selling'] : null);
                                        $color = $dir === 'up' ? 'text-green-600 dark:text-green-400' : ($dir === 'down' ? 'text-red-600 dark:text-red-400' : 'text-gray-400');
                                        $arrow = $dir === 'up' ? '▲' : ($dir === 'down' ? '▼' : '●');
                                        $tooltip = $show === 'both'
                                            ? ($day['buying'] !== null || $day['selling'] !== null
                                                ? ($day['date'] . "\nBuying: " . ($day['buying'] !== null ? number_format($day['buying'], 5) : '-') . " (" . ($day['buying_direction'] === 'up' ? '▲' : ($day['buying_direction'] === 'down' ? '▼' : '●')) . ")\nSelling: " . ($day['selling'] !== null ? number_format($day['selling'], 5) : '-') . " (" . ($day['selling_direction'] === 'up' ? '▲' : ($day['selling_direction'] === 'down' ? '▼' : '●')) . ")")
                                                : $day['date'] . "\nNo data")
                                            : ($day['date'] . "\n" . ucfirst($show) . ": " . ($val !== null ? number_format($val, 5) : '-') . " (" . $arrow . ")");
                                    @endphp
                                    <span class="inline-block cursor-pointer {{ $color }}" title="{{ $tooltip }}">
                                        @if($show === 'both')
                                            <span class="flex flex-col items-center">
                                                <span class="{{ $day['buying_direction'] === 'up' ? 'text-green-600 dark:text-green-400' : ($day['buying_direction'] === 'down' ? 'text-red-600 dark:text-red-400' : 'text-gray-400') }}" style="font-size: 0.9em;">
                                                    {{ $day['buying_direction'] === 'up' ? '▲' : ($day['buying_direction'] === 'down' ? '▼' : '●') }}
                                                </span>
                                                <span class="{{ $day['selling_direction'] === 'up' ? 'text-green-600 dark:text-green-400' : ($day['selling_direction'] === 'down' ? 'text-red-600 dark:text-red-400' : 'text-gray-400') }}" style="font-size: 0.9em;">
                                                    {{ $day['selling_direction'] === 'up' ? '▲' : ($day['selling_direction'] === 'down' ? '▼' : '●') }}
                                                </span>
                                            </span>
                                        @else
                                            <span style="font-size: 1.1em;">{{ $arrow }}</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
