<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admindashboard</title>

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
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: #32353c;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo a {
            font-size: 25px;
            font-weight: 600;
            color: #ffffff;
            text-transform: uppercase;
        }

        .navbar .logo a:hover {
            color: #ff8c00;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar h3 {
            font-size: 24px;
            color: #fff;
            margin: 0;
            display: inline-block;
        }

        .navbar span {
            font-size: 18px;
            color: #fff;
            font-weight: 500;
            margin-left: 5px;
            /* Reduced margin to make them closer */
            display: inline-block;
            padding-left: 800px;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
        }

        .logout-button {
            background-color: red;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: darkred;
        }

        .logout-button:focus {
            outline: none;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <a href="#">Home Service Provider</a>
        </div>

        <span>👤{{ Auth::user()->name }}</span>
        <div class="nav-links">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>

        </div>
    </nav>

</body>

</html>