<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    @include('header.pheader')
    @include('sidebar.providersidebar.ssidebar')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex; /* Enable Flexbox for the body */
            background-color: #e9ecef;
            color: #333;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1e1e2f;
            color: white;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            transition: width 0.3s ease;
            z-index: 100; /* Ensure sidebar is above other content if needed */
        }

        /* Create a wrapper for the main content */
        .main-content {
            flex-grow: 1; /* Allow the content to take up remaining space */
            margin-left: 250px; /* Push the wrapper to the right of the sidebar */
            padding: 20px;
            margin-top: 70px; /* Adjust based on your header's height */
            background-color: #f8f9fa;
            box-sizing: border-box;
            min-height: calc(100vh - 70px); /* Adjust based on header height */
        }

        /* Style for the heading */
        .main-content h1 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 500;
            text-transform: uppercase;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .table td:last-child { /* Target the last column (Actions) */
            display: flex;
            align-items: center; /* Vertically align items in the center */
            gap: 5px; /* Add some space between the buttons */
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-right: 0; /* Remove default right margin as we're using gap */
            margin-bottom: 2px; /* Add a little bottom margin for better spacing if they wrap */
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        .btn-info {
            background-color: #17a2b8;
        }
        .btn-info:hover{
            background-color: #138496;
        }

        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545; /* Red color for reject button */
        }
        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.8rem;
            font-weight: bold;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        /* Improved Modal Styles */
        #requestServiceModal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0, 0, 0, 0.4); /* Slightly less opaque */
            justify-content: center;
            align-items: center;
            padding: 20px; /* Add some padding for smaller screens */
        }

        .request-modal-content {
            background-color: #fff;
            margin: 1.5rem auto; /* More modern margin */
            padding: 30px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 500px;
            border-radius: 12px; /* More rounded modal */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation-name: slide-down;
            animation-duration: 0.3s;
            position: relative;
        }

        @keyframes slide-down {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        .request-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .request-modal-header h3 {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }

        .request-modal-close-btn {
            color: #aaa;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            margin-left: 15px;
            opacity: 0.7;
            transition: opacity 0.2s ease-in-out;
        }

        .request-modal-close-btn:hover,
        .request-modal-close-btn:focus {
            color: #000;
            text-decoration: none;
            opacity: 1;
        }

        .request-modal-content label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        .request-modal-content input[type=text],
        .request-modal-content input[type=datetime-local],
        .request-modal-content textarea {
            width: calc(100% - 24px);
            padding: 12px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .request-modal-content textarea {
            resize: vertical;
            min-height: 120px;
        }

        .request-modal-content button[type=submit] {
            background-color: #007bff; /* Primary blue color */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.2s ease-in-out;
            width: 100%; /* Make it a block-level button */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .request-modal-content button[type=submit]:hover {
            background-color: #0056b3; /* Darker shade of blue */
        }

        .request-modal-content > *:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    @include('sidebar.providersidebar.ssidebar')

    <div class="main-content">
        <h1>Service Requests</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($serviceRequests->isEmpty())
            <p>No service requests yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>User</th>
                        <th>Service Details</th>
                        <th>Preferred Time</th>
                        <th>Contact Info</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviceRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td>{{ $request->service_details }}</td>
                            <td>{{ $request->preferred_time ?? 'Not specified' }}</td>
                            <td>{{ $request->contact_info }}</td>
                            <td>{{ $request->status }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('provider.requests.show', $request->id) }}" class="btn btn-sm btn-info">View</a>
                                @if ($request->status === 'pending')
                                    <form action="{{ route('provider.requests.accept', $request->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                    </form>
                                    <form action="{{ route('provider.requests.reject', $request->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @elseif ($request->status === 'accepted')
                                    <a href="{{ route('chat.show', $request->id) }}" class="btn btn-sm btn-primary">Chat</a>
                                @elseif ($request->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div id="requestServiceModal" class="modal">
            <div class="request-modal-content">
                <div class="request-modal-header">
                    <h3>Request Service</h3>
                    <button type="button" class="request-modal-close-btn" onclick="closeRequestForm()">&times;</button>
                </div>
                <form action="{{ route('service.request.submit', $provider->id) }}" method="POST">
                    @csrf

                    <label for="service_details">Service Details:</label><br>
                    <textarea id="service_details" name="service_details" rows="5" placeholder="Describe the service you need..." required></textarea><br>

                    <label for="preferred_time">Preferred Time (Optional):</label><br>
                    <input type="datetime-local" id="preferred_time" name="preferred_time"><br>

                    <label for="contact_info">Your Contact Information:</label><br>
                    <input type="text" id="contact_info" name="contact_info" placeholder="Your phone number or other contact details" required><br>

                    <button type="submit" class="feedback-btn">Submit Request</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRequestForm() {
            document.getElementById("requestServiceModal").style.display = "flex";
        }

        function closeRequestForm() {
            document.getElementById("requestServiceModal").style.display = "none";
        }
    </script>
</body>
</html>