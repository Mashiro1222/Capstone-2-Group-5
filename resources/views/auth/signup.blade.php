<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h1>Signup</h1>
    <form method="POST" action="{{ route('signup') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required><br>
        @error('name') <span>{{ $message }}</span><br> @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        @error('email') <span>{{ $message }}</span><br> @enderror

        <input type="password" name="password" placeholder="Password" required><br>
        @error('password') <span>{{ $message }}</span><br> @enderror

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>

        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
