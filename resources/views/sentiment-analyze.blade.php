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
                    <h3 class="text-lg font-semibold mb-4">Analyze Text Sentiment</h3>

                    @if(session('result'))
                        <div class="bg-blue-500 text-white p-4 rounded mb-4">
                            <strong>Sentiment:</strong> {{ session('result')['sentiment'] }}<br>
                            <strong>Positive Words:</strong> {{ session('result')['positiveCount'] }}<br>
                            <strong>Negative Words:</strong> {{ session('result')['negativeCount'] }}
                        </div>
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
