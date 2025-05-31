<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }



        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9ff;
        }

        .form-actions {
            margin-top: 15px;
        }

        .form-actions button {
            background-color: #3c4858;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-actions button:hover {
            background-color: #2e3b47;
        }

        .form-footer {
            margin-top: 15px;
            font-size: 14px;
        }

        .form-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .name {
            font-size: 40px;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            color: #00509e;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
            background: linear-gradient(to right, #00509e, #00aaff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            margin: 10px 0;
            text-align: center;
        }

        .text-danger {
            color: red;
        }

        .form-control.is-invalid {
            border: 1px solid red;
            background-color: #ffe6e6;
            /* Optional: light red background for emphasis */
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <a href="/">
            <div class="name">Home Service Provider</div>
        </a>

        <form action="{{ route('loguser') }}" method="POST">
            @csrf
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror">
                <span class="text-danger">
                    @error('email')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control @error('password') is-invalid @enderror">
                <span class="text-danger">
                    @error('password')
                    {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-actions">
                <button type="submit">LOG IN</button>
            </div>

            <div class="form-footer">
                Not registered yet? <a href="/register">Register here</a>
            </div>
        </form>
    </div>
</body>

</html>