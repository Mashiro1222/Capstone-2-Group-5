<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style> 
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #343a40;
            color: #ffffff;
        }

        td {
            font-size: 1.2rem;
        }

        .btn-secondary {
            font-size: 1.2rem;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-bottom: 10px;">Back</a>
        
        <!-- Title -->
        <h1>User Feedback</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Feedback Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Accuracy</th>
                    <th>Ease</th>
                    <th>Helpfulness</th>
                    <th>Design</th>
                    <th>Recommend</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->user->name ?? 'Unknown User' }}</td>
                        <td>{{ $feedback->accuracy }}</td>
                        <td>{{ $feedback->ease }}</td>
                        <td>{{ $feedback->info_helpfulness }}</td>
                        <td>{{ $feedback->design }}</td>
                        <td>{{ $feedback->recommend }}</td>
                        <td>{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
