<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        @error('email') <span>{{ $message }}</span><br> @enderror

        <input type="password" name="password" placeholder="Password" required><br>
        @error('password') <span>{{ $message }}</span><br> @enderror

        <button type="submit">Login</button>
    </form>
</body>
</html>
