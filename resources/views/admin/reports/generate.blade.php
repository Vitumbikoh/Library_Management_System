<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->name }}</title>
</head>
<body>
    <h1>{{ $report->name }}</h1>
    <p>Date Generated: {{ $report->created_at->format('Y-m-d') }}</p>
    <p>Report Content: {{ $report->content }}</p> <!-- Example: Add dynamic report content -->
</body>
</html>
