<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            background-color: rgb(117, 117, 116);
            font-family: 'Made Outer Sans', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            position: relative; /* Added for back button positioning */
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
            transition: box-shadow 0.3s, border-color 0.3s;
        }
        .btn-primary {
            background-color: rgb(6, 42, 201);
            width: auto;
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            text-align: center;
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(4, 129, 25);
        }
        .alert {
            text-align: center;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 30px;
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="{{ route('admin.users') }}" class="back-btn">Back</a> <!-- Added back button -->
        <h1>Edit User</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="text-muted">Leave blank if you don’t want to change the password.</small>
            </div>
            <button type="submit" class="btn-primary">Update User</button>
        </form>
    </div>
</body>
</html>
