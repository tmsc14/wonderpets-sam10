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

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="delete-history-form" method="POST" action="{{ route('sentiment.history.delete') }}">
                        @csrf
                        @method('DELETE')

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-4">
                                <thead>
                                    <tr>
                                        <th class="border px-4 py-2">
                                            <input type="checkbox" id="select-all" />
                                        </th>
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
                                            <td class="border px-4 py-2">
                                                <input type="checkbox" name="history_ids[]" value="{{ $history->id }}" />
                                            </td>
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

                        <div class="mt-4 flex space-x-4">
                            <button type="submit" name="action" value="delete_selected" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Selected
                            </button>
                            @if(Auth::user()->role === 'admin')
                                <button type="submit" name="action" value="delete_all" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete All
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select All checkbox functionality
        document.getElementById('select-all').addEventListener('change', function (e) {
            const checkboxes = document.querySelectorAll('input[name="history_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    </script>
</x-app-layout>
