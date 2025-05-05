<!DOCTYPE html>
<html lang="en">
<head>
    @include('header.adminheader')
    @include('sidebar.adminsidebar.asidebar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* General Page Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #333;
        }

        /* Content Wrapper */
        .content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px);
            transition: all 0.3s ease-in-out;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        /* Profile Image */
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1);
        }

        /* Buttons */
        button ,a.review-btn{
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .review-btn {
            background-color: #007bff;
            color: white;
        }

        .review-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #a71d2a;
        }

        /* Responsive Table */
        @media screen and (max-width: 768px) {
            .content {
                margin: 20px;
                width: calc(100% - 40px);
            }

            table {
                display: block;
                width: 100%;
                overflow-x: auto;
            }

            th, td {
                display: block;
                text-align: left;
                padding: 10px;
            }

            td:before {
                content: attr(data-label);
                font-weight: 600;
                display: block;
                margin-bottom: 5px;
                color: #555;
            }
        }
    </style>
</head>
<body>

    <div class="content">
        <h2>Service Providers</h2>

        <table>
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Provider Id</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                    <td data-label="Picture">
                        <img src="{{ Storage::url($provider->photo) }}" alt="Provider Image">
                    </td>
                    <td data-label="Name">{{ $provider->name }}</td>
                    <td data-label="id">{{ $provider->id }}</td>
                    <td data-label="Actions">
                        <!-- Using a link for the review button -->
                        <a href="{{ route('admin.review', $provider->id) }}" class="review-btn">See Review</a>

                        <!-- Using a form for the delete button -->
                        <form action="{{ route('admin.delete', $provider->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
