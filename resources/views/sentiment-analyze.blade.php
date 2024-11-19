<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sentiment Analysis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Analyze Text Sentiment</h3>
                        <a href="{{ route('sentiment.history') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Sentiment History</a>
                    </div>

                    @if(session('result'))
                        <div class="bg-blue-500 text-white p-4 rounded mb-4">
                            <strong>Sentiment:</strong> {{ session('result')['sentiment'] }}<br>
                            <strong>Positive Score:</strong> {{ session('result')['positiveScore'] }}%<br>
                            <strong>Negative Score:</strong> {{ session('result')['negativeScore'] }}%<br>
                            <strong>Neutral Score:</strong> {{ session('result')['neutralScore'] }}%<br>
                            <strong>Compound Score:</strong> {{ session('result')['compoundScore'] }}%
                        </div>

                        <!-- Chart Container -->
                        <canvas id="sentimentChart" width="400" height="200"></canvas>

                        <script>
                            const ctx = document.getElementById('sentimentChart').getContext('2d');
                            const sentimentData = {
                                labels: ['Positive', 'Negative', 'Neutral'],
                                datasets: [{
                                    label: 'Sentiment Scores',
                                    data: [
                                        {{ session('result')['scores']['Positive'] }},
                                        {{ session('result')['scores']['Negative'] }},
                                        {{ session('result')['scores']['Neutral'] }}
                                    ],
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(255, 206, 86, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(255, 206, 86, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            const sentimentChart = new Chart(ctx, {
                                type: 'bar', // Change this to 'pie', 'line', etc., if desired
                                data: sentimentData,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Score (%)'
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    @endif

                    <form action="{{ route('sentiment.analyze') }}" method="POST">
                        @csrf
                        <textarea name="text" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 mb-4" placeholder="Enter text to analyze..."></textarea>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Analyze Sentiment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>