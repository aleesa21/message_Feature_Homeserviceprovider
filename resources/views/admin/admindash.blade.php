<!DOCTYPE html>
<html lang="en">
<head>
    @include('header.adminheader')
    @include('sidebar.adminsidebar.asidebar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .content {
            margin-left: 250px; /* Adjust according to your sidebar width */
            margin-top: 70px;  /* Adjust based on navbar height */
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            min-height: 80vh;
            
        }

        h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            min-width: 300px;
            max-width: 250px;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card .count {
            font-size: 40px;
            font-weight: bold;
            color: #007bff;
        }

        .card .icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 15px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 100%;
                max-width: 300px;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>

    <div class="content">
        <h2>Welcome to Admin Dashboard</h2>
        

        <!-- Stats Section -->
        <div class="row">
            <div class="card">
                <div class="icon"><i class="fa fa-users"></i></div>
                <h3>Total Admins</h3>
                <div class="count">{{ $totalAdmins }}</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fa fa-briefcase"></i></div>
                <h3>Total Providers</h3>
                <div class="count">{{ $totalProviders }}</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fa fa-users"></i></div>
                <h3>Total Users</h3>
                <div class="count">{{ $totalUsers }}</div>
            </div>
            <div class="card">
                <div class="icon"><i class="fa fa-cogs"></i></div>
                <h3>Total Services</h3>
                <div class="count">{{ $totalServices }}</div>
            </div>
        </div>

    </div>

</body>
</html>
