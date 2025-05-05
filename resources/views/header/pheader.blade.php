<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Calibri, sans-serif;
        }

        body {
            padding-top: 60px;
        }

        * {
            text-decoration: none;
            box-sizing: border-box;
        }

        .navbar {
            position: fixed !important;
            top: 0 !important;
            width: 100% !important;
            z-index: 1000 !important;
            background: #32353c !important;
            padding: 15px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
        }

        .logo a {
            font-size: 25px;
            font-weight: 600;
            color: #ffffff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-button {
            background-color: red !important;
            color: white !important;
            font-size: 16px !important;
            font-weight: bold !important;
            padding: 8px 16px !important;
            border: none !important;
            border-radius: 5px !important;
            cursor: pointer !important;
        }

        .logout-button:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <a href="/">Home Service Provider</a>
        </div>

        <div class="nav-links">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>

        </div>
    </nav>

</body>

</html>