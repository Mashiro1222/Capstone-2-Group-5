<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleAllergens(userId) {
            let allergensRow = document.getElementById('allergens-' + userId);
            if (allergensRow.style.display === 'none') {
                allergensRow.style.display = 'table-row';
            } else {
                allergensRow.style.display = 'none';
            }
        }
    </script>
    <style>
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background-color: #f4f7f9;
            padding: 20px;
        }

        .container {
            max-width: 90%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        table thead {
            background-color: #f1f1f1;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            font-size: 0.875rem;
        }

        table th {
            color: #555;
            font-weight: bold;
        }

        table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:last-child {
            border-bottom: none;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .form-inline {
            display: inline-block;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table th,
            table td {
                padding: 10px;
                font-size: 0.8rem;
            }

            .btn-edit,
            .btn-delete {
                padding: 5px 10px;
                font-size: 0.75rem;
            }

            .back-btn {
                padding: 8px 15px;
                font-size: 0.875rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            table {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead tr {
                display: none;
            }

            tbody tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                font-size: 0.875rem;
            }

            td:before {
                content: attr(data-label);
                font-weight: bold;
                flex: 1;
                text-align: left;
            }
            
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">Back</a>
        <h1>All Users</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="ID">{{ $user->id }}</td>
                        <td data-label="Name">{{ $user->name }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="Role">{{ $user->role }}</td>
                        <td data-label="Actions">
                            <button class="btn-allergens" onclick="toggleAllergens({{ $user->id }})">Allergens</button>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">Edit Role</a>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="form-inline" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="allergens-{{ $user->id }}" style="display: none;">
                        <td colspan="5" style="background-color: #f8f9fa; padding: 10px;">
                            <strong>Allergens:</strong> 
                            @php
                                $allergens = json_decode($user->allergens, true);
                            @endphp
                            @if(is_array($allergens))
                                {{ implode(', ', array_map(fn($a) => $a['allergen_name'], $allergens)) }}
                            @else
                                {{ $user->allergens ?? 'No allergens added' }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
