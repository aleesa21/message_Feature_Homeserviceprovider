<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Details</title>
    @include('header.pheader')
    @include('sidebar.providersidebar.ssidebar')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f6f8;
            color: #333;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 250px; /* Adjust based on your sidebar width */
            padding: 30px;
            margin-top: 70px; /* Adjust based on your header height */
            box-sizing: border-box;
        }

        .detail-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .detail-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-header h2 {
            font-size: 2rem;
            color: #007bff;
            margin: 0;
        }

        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.2s ease-in-out;
        }

        .back-link:hover {
            color: #0056b3;
        }

        .detail-item {
            margin-bottom: 25px;
        }

        .detail-item label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        .detail-item p {
            font-size: 1.1rem;
            color: #495057;
            line-height: 1.6;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .detail-item .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .status-accepted {
            background-color: #28a745;
            color: #fff;
        }

        .status-rejected {
            background-color: #dc3545;
            color: #fff;
        }

        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .action-buttons form {
            display: inline;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545;
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
    </style>
</head>
<body>
    @include('sidebar.providersidebar.ssidebar')

    <div class="main-content">
        <div class="detail-container">
            <div class="detail-header">
                <h2>Service Request Details</h2>
                <a href="{{ route('provider.requests.index') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Requests</a>
            </div>

            <div class="detail-item">
                <label for="request_id">Request ID:</label>
                <p id="request_id">{{ $serviceRequest->id }}</p>
            </div>

            <div class="detail-item">
                <label for="requested_by">Requested By:</label>
                <p id="requested_by">{{ $serviceRequest->user->name }} ({{ $serviceRequest->user->email }})</p>
            </div>

            <div class="detail-item">
                <label for="service_details">Service Details:</label>
                <p id="service_details">{{ $serviceRequest->service_details }}</p>
            </div>

            @if ($serviceRequest->preferred_time)
                <div class="detail-item">
                    <label for="preferred_time">Preferred Time:</label>
                    <p id="preferred_time">{{ $serviceRequest->preferred_time }}</p>
                </div>
            @endif

            <div class="detail-item">
                <label for="contact_info">Contact Information:</label>
                <p id="contact_info">{{ $serviceRequest->contact_info }}</p>
            </div>

            <div class="detail-item">
                <label for="status">Status:</label>
                <p id="status" class="status status-{{ strtolower($serviceRequest->status) }}">{{ $serviceRequest->status }}</p>
            </div>

            <div class="action-buttons">
                @if ($serviceRequest->status === 'pending')
                    <form action="{{ route('provider.requests.accept', $serviceRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>
                    <form action="{{ route('provider.requests.reject', $serviceRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @elseif ($serviceRequest->status === 'accepted')
                    <a href="{{ route('chat.show', $serviceRequest->id) }}" class="btn btn-primary">Chat</a>
                @endif
            </div>
        </div>
    </div>

</body>
</html>