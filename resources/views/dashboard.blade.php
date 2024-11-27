<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-4">
                        <a href="{{ route('export.pdf') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Download PDF</a>
                        <a href="{{ route('export.csv') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Download CSV</a>
                    </div>
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ $user->name }}</h3>

                    <h3 class="text-lg font-semibold mb-4">Recent Sentiment Analyses</h3>

                    <div class="overflow-x-auto">
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
                                @if ($user->role === 'admin')
                                    @foreach($histories as $history) <!-- Admin sees all -->
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
                                @else
                                    @foreach($histories as $history) <!-- Regular user sees their own -->
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
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Chart for User and Sentiment Analysis Counts -->
                    <h3 class="text-lg font-semibold mb-4 mt-6">User and Sentiment Analysis Counts</h3>
                    <div class="mb-6">
                        <canvas id="dashboardChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Chart.js script -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                        const ctx = document.getElementById('dashboardChart').getContext('2d');
                        const dashboardChart = new Chart(ctx, {
                            type: 'bar', // Bar chart type
                            data: {
                                labels: ['Total Users', 'Total Sentiment Analyses'],
                                datasets: [{
                                    label: 'Counts',
                                    data: [{{ $totalUsers }}, {{ $totalSentimentAnalyses }}],
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(255, 99, 132, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Count'
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @media (max-width: 640px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        thead {
            display: none;
        }
        tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #e5e7eb;
        }
        td {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        td::before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
        }
    }
</style>

<script>
// Add data-label attributes for mobile responsiveness
document.querySelectorAll('tbody tr').forEach(row => {
    row.querySelectorAll('td').forEach((cell, index) => {
        const headers = ['Text', 'Sentiment', 'Positive Score', 'Negative Score', 'Neutral Score', 'Compound Score', 'Date'];
        cell.setAttribute('data-label', headers[index]);
    });
});
</script>
