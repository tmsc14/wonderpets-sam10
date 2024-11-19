<!DOCTYPE html>
<html>
<head>
    <title>Sentiment History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Sentiment Analysis History</h1>
    <table>
        <thead>
            <tr>
                <th>Text</th>
                <th>Sentiment</th>
                <th>Positive Score</th>
                <th>Negative Score</th>
                <th>Neutral Score</th>
                <th>Compound Score</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
                <tr>
                    <td>{{ $history->text }}</td>
                    <td>{{ $history->sentiment }}</td>
                    <td>{{ $history->positive_score }}%</td>
                    <td>{{ $history->negative_score }}%</td>
                    <td>{{ $history->neutral_score }}%</td>
                    <td>{{ $history->compound_score }}%</td>
                    <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>