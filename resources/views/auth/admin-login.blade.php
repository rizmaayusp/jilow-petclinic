<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .container img {
            width: 100px;
            margin-bottom: 20px;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .container label {
            text-align: left;
            display: block;
            margin-bottom: 5px;
        }
        .container input[type="email"],
        .container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container input[type="checkbox"] {
            margin-bottom: 20px;
        }
        .container input[type="submit"] {
            padding: 10px 20px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background: #0056b3;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="{{ asset('images/navbar/logo-jilow.png') }}" alt="Logo">
    <h2>Login Admin</h2>
    <form method="post" action="{{ route('admin.login.submit') }}">
        @csrf
        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif
        <label>Email:</label>
        <input type="email" name="email" required value="{{ old('email') }}">
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me<br>
        <input type="submit" name="login" value="Login">
    </form>
</div>

</body>
</html>
