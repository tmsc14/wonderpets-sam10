<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sentiment Analysis History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Sentiment Analyses</h3>

                    <div class="overflow-x-auto"> <!-- Enable horizontal scrolling on small screens -->
                        <table class="min-w-full bg-white border border-gray-300 mt-4">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Text</th>
                                    <th class="border px-4 py-2">Sentiment</th>
                                    <th class="border px-4 py-2">Positive Score</th>
                                    <th class="border px-4 py-2">Negative Score</th>
                                    <th class="border px-4 py-2">Neutral Score</th>
                                    <th class="border px-4 py-2">Compound Score</th>
                                    <th class="border px-4 py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $history)
                                    <tr>
                                        <td class="border px-4 py-2">{{ Str::limit($history->text, 50) }}</td>
                                        <td class="border px-4 py-2">{{ $history->sentiment }}</td>
                                        <td class="border px-4 py-2">{{ $history->positive_score }}%</td>
                                        <td class="border px-4 py-2">{{ $history->negative_score }}%</td>
                                        <td class="border px-4 py-2">{{ $history->neutral_score }}%</td>
                                        <td class="border px-4 py-2">{{ $history->compound_score }}%</td>
                                        <td class="border px-4 py-2">{{ $history->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Link back to the main analysis page -->
                    <div class="mt-6">
                        <a href="{{ route('sentiment.analyze') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Analyze Text</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 640px) {
            table {
                display: block;
                overflow-x: auto; /* Allow horizontal scrolling */
                white-space: nowrap; /* Prevent text wrapping */
            }
            thead {
                display: none; /* Hide the header on small screens */
            }
            tr {
                display: block;
                margin-bottom: 1rem; /* Space between rows */
                border: 1px solid #e5e7eb; /* Border for each row */
            }
            td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem;
                border-bottom: 1px solid #e5e7eb; /* Bottom border for cells */
            }
            td::before {
                content: attr(data-label); /* Use data-label for headers */
                font-weight: bold;
                margin-right: 1rem; /* Space between label and value */
            }
        }
    </style>

    <script>
        document.querySelectorAll('tbody tr').forEach(row => {
            row.querySelectorAll('td').forEach((cell, index) => {
                const headers = ['Text', 'Sentiment', 'Positive Score', 'Negative Score', 'Neutral Score', 'Compound Score', 'Date'];
                cell.setAttribute('data-label', headers[index]); // Add data-label attribute for mobile view
            });
        });
    </script>

</x-app-layout>